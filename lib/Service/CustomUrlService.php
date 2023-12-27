<?php
namespace OCA\CustomingDownloadUrls\Service;

class CustomUrlService {
	private $url;
	private $filePath;

	public function __construct() {
		$dir = dirname(__FILE__);

		$this->filePath = $dir . "/../../custom_url.txt";
		$this->url = file_get_contents($this->filePath);
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
}