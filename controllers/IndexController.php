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
			
			$text = $this->view->translate('cookie-notice-plugin_text');
			$label = $this->view->translate('cookie-notice-plugin_button-label');
			$lifetime = \Pimcore\Config::getWebsiteConfig()->get('cookieNoticeLifetime', 30);
			
			if($text == '' || $text == 'cookie-notice-plugin_text'){
				$text = 'Diese Internetseite verwendet Cookies, um die Nutzererfahrung zu verbessern und den Benutzern bestimmte Dienste und Funktionen bereitzustellen.';
			}
			
			if($label  == '' || $label == 'cookie-notice-plugin_button-label') {
				$label = 'Akzeptieren';
			}

			$js =  file_get_contents(PIMCORE_PLUGINS_PATH . \CookieNotice\Plugin::COOKIE_NOTICE_CONFIG_JS) . PHP_EOL;
			$js .= 'new CookieNotice("' . $text . '", "' . $label . '", "' . $lifetime . '");';
			
			echo $js;
		}

		public function cssAction()
		{
			$this->disableViewAutoRender();
			$this->getResponse()->setHeader("Content-Type", "text/css");

			$css = file_get_contents(PIMCORE_WEBSITE_PATH . \CookieNotice\Plugin::COOKIE_NOTICE_CONFIG_CUSTOM_CSS);
			
			echo $css;
		}
	}
