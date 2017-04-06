<?php

namespace CookieNotice;

use Pimcore\API\Plugin as PluginLib;

class Plugin extends PluginLib\AbstractPlugin implements PluginLib\PluginInterface
{
    const SAMPLE_CONFIG_XML = "/CookieNotice/cookienotice.json";
    const CONFIG_XML = '/var/config/cookienotice.json';

    public function init()
    {
        parent::init();

        // register your events here

        // using anonymous function
        \Pimcore::getEventManager()->attach("frontend.controller.postInit", function ($event) {
            // do something
            $event->getTarget()->view->headLink()->appendStylesheet('/plugins/CookieNotice/static/css/cookieNotice.css');
            $event->getTarget()->view->headLink()->appendStylesheet('/plugin/CookieNotice/index/css');
            $event->getTarget()->view->headScript()->appendFile('/plugin/CookieNotice/index/js');
            $event->getTarget()->view->headScript()->appendFile('/plugins/CookieNotice/static/js/cookieNotice.js');

        });
    }

    public function handleDocument($event) {}

    public static function install()
    {
        if (!file_exists(self::getConfigName())) {
            $defaultContent = file_get_contents(PIMCORE_PLUGINS_PATH . self::SAMPLE_CONFIG_XML);
            file_put_contents(self::getConfigName(), $defaultContent);
            //copy(PIMCORE_PLUGINS_PATH . self::SAMPLE_CONFIG_XML, self::getConfigName())
            /*$defaultConfig = self::getDefaultConfigXML();
            $configWriter = new \Zend_Config_Writer_Xml();
            $configWriter->setConfig($defaultConfig);
            $configWriter->write(self::getConfigName());*/
        }
    }

    public static function uninstall() {
        if (file_exists(self::getConfigName())) {
            unlink(self::getConfigName());
        }
    }

    public static function isInstalled()
    {
        return file_exists(self::getConfigName());
    }

    private static function getConfigName()
    {
        return PIMCORE_WEBSITE_PATH . self::CONFIG_XML;
    }

    private static function getDefaultConfigXML()
    {
        return new \Zend_Config_Xml(PIMCORE_PLUGINS_PATH . self::SAMPLE_CONFIG_XML);
    }

    private static function getConfigXML()
    {
        return new \Zend_Config_Xml(self::getConfigName());
    }
}
