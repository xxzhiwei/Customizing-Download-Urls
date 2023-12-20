<?php

declare(strict_types=1);
// SPDX-FileCopyrightText: errol <err0l@qq.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\FilesCustomUrlPlugin\AppInfo;

use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\EventDispatcher\IEventDispatcher;
use OCA\Files\Event\LoadAdditionalScriptsEvent;
use OCP\Util;

class Application extends App implements IBootstrap {
	public const APP_ID = 'files_custom_url_plugin';

	public function __construct() {
		parent::__construct(self::APP_ID);
		// this runs every time Nextcloud loads a page if this app is enabled
		$container = $this->getContainer();
		$eventDispatcher = $container->get(IEventDispatcher::class);
		
		// load files plugin script when the Files app triggers the LoadAdditionalScriptsEvent event
		$eventDispatcher->addListener(LoadAdditionalScriptsEvent::class, function () {
			// this loads the js/filesplugin.js script once the Files app has done loading its scripts
			Util::addscript(self::APP_ID, 'main', 'files');
		});
	}


	public function register(IRegistrationContext $context): void {
		/*
		 * For further information about the app bootstrapping, please refer to our documentation:
		 * https://docs.nextcloud.com/server/latest/developer_manual/app_development/bootstrap.html
		 */
		// Register your services, event listeners, etc.
	}

	public function boot(IBootContext $context): void {
		/*
		 * For further information about the app bootstrapping, please refer to our documentation:
		 * https://docs.nextcloud.com/server/latest/developer_manual/app_development/bootstrap.html
		 */
		// Prepare your app.
	}
}
