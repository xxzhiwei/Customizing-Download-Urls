<?php

declare(strict_types=1);
// SPDX-FileCopyrightText: errol <err0l@qq.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\FilesCustomUrlPlugin\Controller;

use OCA\FilesCustomUrlPlugin\AppInfo\Application;
use OCP\AppFramework\Controller;
use OCP\IRequest;

use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\TemplateResponse;
use OCA\FilesCustomUrlPlugin\Service\FilesCustomUrlService;

class FilesCustomUrlPluginController extends Controller {

	private $filesCustomUrlService;

	public function __construct(IRequest $request, FilesCustomUrlService $filesCustomUrlService) {
		parent::__construct(Application::APP_ID, $request);
		$this->filesCustomUrlService = $filesCustomUrlService;
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function index(): TemplateResponse {
		return new TemplateResponse(Application::APP_ID, 'index', [
			'url' => $this->filesCustomUrlService->getUrl(),
		]);
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function getUrl(): DataResponse {
		return new DataResponse([
			'message' => 'ok',
			'data' => [
				'url' => $this->filesCustomUrlService->getUrl(),
			]
		]);
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function saveUrl(): DataResponse {

		$input = file_get_contents('php://input');
		$array = json_decode($input, true);
		$this->filesCustomUrlService->saveUrl($array['url']);
		return new DataResponse([
			'message' => 'ok'
		]);
	}
}
