<?php

declare(strict_types=1);
// SPDX-FileCopyrightText: errol <err0l@qq.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\CustomingDownloadUrls\Controller;

use OCA\CustomingDownloadUrls\AppInfo\Application;
use OCP\AppFramework\Controller;
use OCP\IRequest;

use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\TemplateResponse;
use OCA\CustomingDownloadUrls\Service\CustomUrlService;

class CustomingDownloadUrlsController extends Controller {

	private $customUrlService;

	public function __construct(IRequest $request, CustomUrlService $customUrlService) {
		parent::__construct(Application::APP_ID, $request);
		$this->customUrlService = $customUrlService;
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function index(): TemplateResponse {
		return new TemplateResponse(Application::APP_ID, 'index', [
			'url' => $this->customUrlService->getUrl(),
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
				'url' => $this->customUrlService->getUrl(),
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
		$this->customUrlService->saveUrl($array['url']);
		return new DataResponse([
			'message' => 'ok'
		]);
	}
}
