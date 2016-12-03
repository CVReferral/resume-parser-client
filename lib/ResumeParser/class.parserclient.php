<?php

class ParserClient {
	
	public $wsdl;
	
	public function __construct($wsdl, $secret) {
		$this->wsdl = $wsdl;
		$this->secret = $secret;
	}
	
	public function getHRXMLPublicUrl($url) {
		$hrxml	= [];
		$client = new SoapClient($this->wsdl, array( "trace" => 1 ) );
		$version = "6.0.0";
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
		$version = "6.0.0";
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