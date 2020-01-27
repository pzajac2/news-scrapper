<?php
namespace App\Utility;

use Cake\Core\Configure;
use Cake\Cache\Cache;
use Cake\I18n\Time;
use Cake\Http\Client;

abstract class WebsiteParser implements WebsiteParserInterface {
	
    /**
     * Protocol and domain of website
     * Could be used for testing proposes
     * (without ending slash!)
     *
     * @var String
     */
    protected $websiteDomain = 'http://f1wm.pl';

    protected $documentHtml = null;

    protected $httpClient = null;

    protected $models = [];


    public function __construct() {
    	// creating CakePHP HTTP client
    	$this->httpClient = new Client();
    }

    /**
     * Setter for $this->websiteDomain
     */
	public function setWebsiteDomain($domain) {
		$this->websiteDomain = $domain;
	}
    /**
     * Getter for $this->websiteDomain
     */
	public function getWebsiteDomain() {
		return $this->websiteDomain;
	}

    /**
     * Getter for $this->documentHtml
     */
	public function getHtml() {
		return $this->documentHtml;
	}

    /**
     * Getter for $this->documentHtml
     */
	public function html() {
		return $this->documentHtml;
	}

	public function bindModel($name, $objectRef) {
		$this->models[$name] = $objectRef;
	}

	protected function getDocumentObjectModel($url) {

		// making http get request
		$response = $this->httpClient->get($url);

		// if not correct http response (<>200)
		if (!$response->isOk()) {
		    throw new \Exception(__(
		        'URL {0} couldn\'t be downloaded, httpCode: {1}',
		        $url, 
		        $response->getStatusCode()
		    ));
		}

		// Converting response to utf8
		$body = $response->body();
		$documentHtml = $body;
		$body = iconv('iso-8859-2', 'utf-8', $body);

		// creating DOM parser
		$dom = new \PHPHtmlParser\Dom;
		$dom->loadStr($body, [
		    'enforceEncoding' => 'utf8'
		]);

		return $dom;

	} // build DOM

} // class WebsiteParser

