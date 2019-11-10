<?php 




class API{

	private $apiKey="145645e544e640a0adb7aafa03d4e61d";
	public $apiURL =  "https://api.weatherbit.io/v2.0/forecast/daily?";

	public $date,$lat,$long,$cityName = "";



	function getForeCast(){
		$str="";
		if(isset($this->city))
			$str="city=".urlencode($this->city);
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

$apiCall = new API();



if(isset($_POST['coordinates'])){
	$cord=json_decode($_POST['coordinates'],true);

	$apiCall->lat = $cord['lat'];
	$apiCall->long =$cord['long'];

}

if(isset($_POST['city'])){
	$apiCall->city = $_POST['city'];
}
echo json_encode($apiCall->getForeCast());


?>