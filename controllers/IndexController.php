<?php


class CookieNotice_IndexController extends \Pimcore\Controller\Action\Admin
{
    public function indexAction()
    {

    }

    public function jsAction()
    {
        $this->disableViewAutoRender();
        $this->getResponse()->setHeader("Content-Type", "application/javascript");
        $config = $this->getConfig();
        echo "var COOKIE_NOTICE_TEXT = '" . str_replace("'", "\'", $config->text) . "';\n";
        echo "var COOKIE_NOTICE_BUTTON = '" . str_replace("'", "\'", $config->buttonLabel) . "';\n";
        echo "var COOKIE_NOTICE_DAYS = " . doubleval($config->cookieLifetimeDays) . ";\n";
    }

    public function cssAction()
    {
        $this->disableViewAutoRender();
        $this->getResponse()->setHeader("Content-Type", "text/css");
        $config = $this->getConfig();
        echo $config->css;
    }

    private function getConfig() {
        $fileContent = file_get_contents(PIMCORE_WEBSITE_PATH . '/var/config/cookienotice.json');
        return json_decode(str_replace("\n", "", $fileContent));
    }
}
