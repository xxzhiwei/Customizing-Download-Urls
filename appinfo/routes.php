<?php

declare(strict_types=1);
// SPDX-FileCopyrightText: errol <err0l@qq.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\ExtraUrlMaker\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
return [
	'routes' => [
		// name对应的是控制器的方法，url对应请求路径
		['name' => 'FilesCustomUrlPlugin#index', 'url' => '/', 'verb' => 'GET'],
		['name' => 'FilesCustomUrlPlugin#getUrl', 'url' => '/getUrl', 'verb' => 'GET'],
		['name' => 'FilesCustomUrlPlugin#saveUrl', 'url' => '/saveUrl', 'verb' => 'POST'],
	],
];
