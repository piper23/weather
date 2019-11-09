<?php 




class API{

private $apiKey="145645e544e640a0adb7aafa03d4e61d";
public $apiURL =  "https://api.weatherbit.io/v2.0/forecast/daily?";

public $date,$at,$long,$cityName = "";



function getForeCast(){
$str="city=".$this->city;
if(isset($this->lat) && isset($this->long)){
	$str="lat=".$this->lat."&lon=".$this->long;
}


  $callingURL = $this->apiURL.$str."&key=".$this->apiKey;

	$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$callingURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$output=curl_exec($ch);
curl_close($ch);
return json_decode( $output,true);
}


}



print_r(json_encode($_POST));

//$m = new API();

// $m->lat = "18.377986";
// $m->long = "75.987924";
// $m->city = "Mumbai";
// echo("<pre>");

// print_r($m->getForeCast());
//curl_setopt($ch,CURLOPT_HEADER, true); //if you want headers
?>