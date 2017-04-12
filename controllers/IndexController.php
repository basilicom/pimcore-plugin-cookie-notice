<?php


	class CookieNotice_IndexController extends \Website\Controller\Action
	{
		public function indexAction()
		{

		}

		public function jsAction()
		{
			$this->disableViewAutoRender();
			$this->getResponse()->setHeader("Content-Type", "application/javascript");
			$config = $this->getPluginConfig();
			echo "var COOKIE_NOTICE_TEXT = '" . str_replace("'", "\'", $this->view->translate('cookie-notice-plugin_text')) . "';\n";
			echo "var COOKIE_NOTICE_BUTTON = '" . str_replace("'", "\'", $this->view->translate('cookie-notice-plugin_button-label')) . "';\n";
			echo "var COOKIE_NOTICE_DAYS = " . doubleval($config->cookieLifetimeDays) . ";\n";
		}

		public function cssAction()
		{
			$this->disableViewAutoRender();
			$this->getResponse()->setHeader("Content-Type", "text/css");
			$config = $this->getPluginConfig();
			echo $config->css;
		}

		private function getPluginConfig() {
			$fileContent = file_get_contents(PIMCORE_WEBSITE_PATH . '/var/config/cookienotice.json');
			return json_decode(str_replace("\n", "", $fileContent));
		}
	}
