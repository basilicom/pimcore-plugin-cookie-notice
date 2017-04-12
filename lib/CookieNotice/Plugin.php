<?php

	namespace CookieNotice;

	use Pimcore\API\Plugin as PluginLib;
	use Pimcore\Db;

	class Plugin extends PluginLib\AbstractPlugin implements PluginLib\PluginInterface
	{
		const COOKIE_NOTICE_CONFIG_DEFAULT_CSS = '/CookieNotice/static/css/cookienotice.sample.css';
		const COOKIE_NOTICE_CONFIG_CUSTOM_CSS = '/var/config/cookienotice.css';
		const COOKIE_NOTICE_CONFIG_JS = '/CookieNotice/static/js/cookienotice.js';
		const COOKIE_NOTICE_CONFIG_LIFETIME = 'cookieNoticeLifetime';
		const COOKIE_NOTICE_CONFIG_LIFETIME_DEFAULT = '30';
		const DB_TABLE_WEBSITE_SETTINGS = 'website_settings';

		public function init()
		{
			parent::init();

			\Pimcore::getEventManager()->attach("frontend.controller.postInit", function ($event) {
				$event->getTarget()->view->headLink()->appendStylesheet('/plugin/CookieNotice/index/css');
				$event->getTarget()->view->headScript()->appendFile('/plugin/CookieNotice/index/js');
			});
		}

		public function handleDocument($event)
		{
		}

		public static function install()
		{
			$database = Db::get();

			$database->insert(self::DB_TABLE_WEBSITE_SETTINGS, [
				'name' => self::COOKIE_NOTICE_CONFIG_LIFETIME,
				'type' => 'text',
				'data' => self::COOKIE_NOTICE_CONFIG_LIFETIME_DEFAULT
			]);

			if (!file_exists(self::getCustomConfigCss())) {
				$defaultContent = file_get_contents(self::getDefaultConfigCss());
				file_put_contents(self::getCustomConfigCss(), $defaultContent);
			}
		}

		public static function uninstall()
		{
			if (file_exists(self::getCustomConfigCss())) {
				unlink(self::getCustomConfigCss());
			}
		}

		public static function isInstalled()
		{
			return file_exists(self::getCustomConfigCss());
		}

		private static function getCustomConfigCss()
		{
			return PIMCORE_WEBSITE_PATH . self::COOKIE_NOTICE_CONFIG_CUSTOM_CSS;
		}

		private static function getDefaultConfigCss()
		{
			return PIMCORE_PLUGINS_PATH . self::COOKIE_NOTICE_CONFIG_DEFAULT_CSS;
		}

	}
