<?php

class ParserClient {
	
	public $wsdl;
	public $version;
	
	public function __construct($wsdl, $secret, $version = "6.0.0") {
		$this->wsdl = $wsdl;
		$this->secret = $secret;
		$this->version = $version;
	}
	
	public function getHRXMLPublicUrl($url) {
		$hrxml	= [];
		$client = new SoapClient($this->wsdl, array( "trace" => 1 ) );
		$hrxml = $client->parseResume(array(
			"url" 			=> $url, 
			"userkey" 	=> $this->secret['key'], 
			"version" 	=> $this->version, 
			"subUserId" => $this->secret['subUserId']
		));
		
		$parseXml = $hrxml->return;
		
		return $parseXml;
	}
	
	public function getHRXMLBinary($encode64, $type , $secret) {
		$encode64 = base64_encode($encode64);
		$hrxml	= array();
		$client = new SoapClient($this->wsdl,array( "trace" => 1 ) );
		$hrxml = $client->parseResumeBinary(array(
			"filedata"=>$encode64, 
			"fileName"=>$type, 
			"userkey" 	=> $this->secret['key'], 
			"version" 	=> $this->version, 
			"subUserId" => $this->secret['subUserId']
		));
		$parseXml = $hrxml->return;
		return $parseXml;
	}
}
?>
