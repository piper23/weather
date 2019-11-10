<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Weather</title>
<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<header>
		<h1 class=header-title>WEATHER APP</h1>
	</header>
	<article >
		<div class="container-flex">
				<section class="search-field">
						<div class="inputs-types">
					   <button type="" id="get-loc" style="display: none"><img src="assets/img/loc.png"></button>
					   </div>
						<div class="inputs-types mg-left">
						<input type="text" name="search" id="searchQuery" autocomplete="off" value="" placeholder="Enter City">
					   <button type="submit" class="search" id="search">Search</button>
						</div>
						<div class="inputs-types">
							<label for="farcheck">
								<input type="checkbox" name="Far" id="farcheck" value="F">	Fahrenheit
							</label>
							
						</div>
				   </section>
				   <section class="middle-section">
					   <div class="c-15">
						   <div id="date-time">
							   <div id="dayofweek"></div>
							   <div id="date"></div>
						   </div>
					   </div>
					   <div class="c-70">
						   <div class="temp">
							   <h1 id="tempbind"></h1>
						   </div>
						   <div class="otherData">
						   <h3>High: <span id="highbind"></span> / Low: <span id="lowbind"></span></h3>
						   </div>
					   </div>
					   <div class="c-15">
						   <div id="location">
							   <h3 id="locatbind"></h3>
						   </div>
					   </div>	
				   </section>
				   <section class="forecast" id="forecast">
			

				   </section>
		</div>

	</article>
<script type="text/javascript">
var cityDefault = "Mumbai";
var city="Mumbai";

document.getElementById('searchQuery').addEventListener('keyup', (e)=>{
	city = document.getElementById('searchQuery').value
});

//Print Temp checks for Farenheight Toggle
var printTemp = (temp)=>{
return (c==true)?temp+"&#176;C":fConvert(temp)+"&#176;F"
}
function fConvert(temps){
		return (parseFloat(temps) * 1.8 + 32).toFixed(2)
}
//Farenheight Toggle
var farcheck = document.getElementById("farcheck");
farcheck.addEventListener("change", function(){ 
	if(this.checked) {
        c=false;
    } else {
       c=true;
    }
    renderTemp()
});



	
//Code to get Day Of Week
var getDayofWeek = (date) =>{
var weekdays = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
var dt = new Date(date);
return weekdays[dt.getDay()];
}


///Search

document.getElementById("search").addEventListener("click", ()=>{
if(city==""){
	alert('City Field cannot be blank')
	return false;	
}
 city=document.getElementById("searchQuery").value;

 fetchData(city);
});



//Ajax Function
var fetchData = (payload,def=1) =>{
	
var	passkey="city";
	if(def==2)
		passkey="coordinates";
	var data = new FormData();
data.append(passkey, JSON.stringify( payload) );
fetch("api.php",
{
    method: "POST",
    body: data
})
.then(function(res){ return res.json(); })
.then(function(data){ 
	if(data == null){
		alert("Weather not Found")
		return false;
	}
	var wei = data.data
	console.log(data)
	state.todaysTemp = wei[0].temp
	state.thigh = wei[0].high_temp
	state.tlow = wei[0].low_temp
	state.date= wei[0].valid_date
	state.city= data.city_name
	state.forecast = wei.slice(1,7)
	console.log(state)
	renderData();
 })
}


// geo Functionality////////////
if ("geolocation" in navigator) {
var geoL = document.getElementById("get-loc")
geoL.style.display = "block";
geoL.addEventListener("click", ()=>{
	navigator.geolocation.getCurrentPosition(function(position) {
	let	coordinates = {'lat':position.coords.latitude,'long':position.coords.longitude}
		fetchData(coordinates,2)

});
})


}


//Render Codes
var c = true;

    const state = {
      todaysTemp: '',
      thigh:"",
      tlow:"",
      city: 'Mumbai',
      date:"",
      forecast:[]
    };



 var renderForecast = ()=>{
var divAppend = document.getElementById("forecast")
divAppend.innerHTML = "";
	let futrueData = state.forecast;
	futrueData.forEach(function(element) {
	const div = document.createElement('div');
	div.className = "forecast-card";
	div.innerHTML = `<h4>${getDayofWeek(element.valid_date)}</h4><p class="temp">${printTemp(element.temp)}</p></div>`;
	divAppend.appendChild(div)
});

 		
 }
var renderTemp=()=>{
document.getElementById("tempbind").innerHTML  =  printTemp(state.todaysTemp)
document.getElementById("highbind").innerHTML  =  printTemp(state.thigh) 
document.getElementById("lowbind").innerHTML  =  printTemp(state.tlow) 
 renderForecast() 	
}


var  renderData = ()=>{
	document.getElementById("dayofweek").innerHTML = getDayofWeek(state.date);
document.getElementById("date").innerHTML = state.date;

document.getElementById("locatbind").innerHTML  =  state.city 
renderTemp();
}



 fetchData(city);


</script>
</body>
</html>