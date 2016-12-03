<?php
namespace ResumeParser;

require_once 'class.parserclient.php';

class ParserService {
	
	public $wsdl;
	
	private static $instance = null;
	
	private $key;
	private $subUserId;
	private $version;

	public function __construct($key, $subUserId, $wsdl, $version = "6.0.0") {
		$this->wsdl = $wsdl;
		$this->key = $key;
		$this->subUserId = $subUserId;
		$this->verison = $version;
	}
	
	public function getHRXMLPublicUrl($url) {
		$client = new \ParserClient($this->wsdl, [
			'key' => $this->key,
			'subUserId' => $this->subUserId,
		]);
		return $client->getHRXMLPublicUrl($url);
	}
	
	public function getHRXMLBinary($encode64, $type) {
		$client = new \ParserClient($this->wsdl, [
			'key' => $this->key,
			'subUserId' => $this->subUserId,
		]);
		return $client->getHRXMLBinary($encode64, $type, [
			'key' => $this->key,
			'subUserId' => $this->subUserId,
		]);
		
	}
}
