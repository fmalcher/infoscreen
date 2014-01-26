<?php

class StationMonitor{
	private $data = array();
	private $stationID;
	
	public function __construct($stationID){
		$this->stationID = $stationID;
		$useragent = "easy.GO Client Android v4.0.3_easyGO_4.0.7 Mozilla/5.0 (Linux; Android 4.4.2; Nexus 4 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36;";
		$requestURI = "http://hn1.the-agent-factory.de/easygo2/rest/regions/MDV/modules/stationmonitor?con10=1&con01=1&sm10=0&sm01=0&source=HISTORY&cStyle=0&transportFilter=00011111&hafasID=".$stationID."&mode=DEP&sm01=0&sm10=0&con01=1&con10=1&cStyle=0";
	
		$clientID = $this->createClientID();
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
	    	CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $requestURI,
			CURLOPT_USERAGENT => $useragent,
			CURLOPT_HTTPHEADER => array("EasyGO-Client-ID: ".$clientID, "Accept: application/json"),
		));
		$resp = curl_exec($curl);
		curl_close($curl);
		$this->data = json_decode($resp);
	}
	
	public function getJourneys(){
		return $this->data->journeys;
	}
	
	public function getStationName(){
		$name = $this->data->stationName;
		
		//cut away "Leipzig" from the beginning of the label
		if(substr($name, 0, 9) == "Leipzig, "){
			$name = substr($name, 9);
		}
		
		return $name;
	}
	
	private function createClientID(){
		$out = null;
		
		for($i = 0; $i < 23; $i++){
			$out .= rand(0,9);
		}
		
		return $out;
	}
	
	
}

?>