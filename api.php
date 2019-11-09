<?php 




class API{


public $apiURL =  "https://api.darksky.net/forecast/9e1cd7150620a49c044da25ce40a4d56/";

public $date,$at,$long = "";



function getForeCast(){
	$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$this->apiURL.$this->lat.",".$this->long."?exclude=hourly");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$output=curl_exec($ch);
curl_close($ch);
return json_decode( $output,true);
}


}

$m = new API();

$m->date = date("Y-m-d\Th:i:s");
$m->lat = "18.377986";
$m->long = "75.987924";
echo("<pre>");

print_r($m->getForeCast());
//curl_setopt($ch,CURLOPT_HEADER, true); //if you want headers
?>