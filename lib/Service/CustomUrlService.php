<?php
namespace OCA\CustomingDownloadUrls\Service;

class CustomUrlService {
	private $url;
	private $filePath;
	private $urlBaseRoute;
	private $baseRouteFilePath;

	public function __construct() {
		$dir = dirname(__FILE__);

		$this->filePath = $dir . "/../../custom_url.txt";
		$this->url = file_get_contents($this->filePath);
		$this->baseRouteFilePath = $dir . "/../../custom_url_base_route.txt";
		$this->urlBaseRoute = file_get_contents($this->baseRouteFilePath);
	}

    public function getUrl(): string {
        return $this->url;
    }

    public function saveUrl(string $url): void {
        $this->url = $url;
		$file = fopen($this->filePath, "w");

		fwrite($file, $url);
		fclose($file);
    }

	public function getUrlBaseRoute(): string {
        return $this->urlBaseRoute;
    }
}