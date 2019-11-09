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
		<h1>WEATHER APP</h1>
	</header>
	<article >
		<section class="search-field">
			 <div class="inputs-types">
			<button type="" id="get-loc"><img src="assets/img/loc.png"></button>
			</div>
			 <div class="inputs-types mg-left">
			 <input type="text" name="search" id="searchQuery" autocomplete="off" value="" placeholder="Enter City">
			<button type="submit" class="search" id="search">Search</button>
			 </div>
			 <div class="inputs-types">
			 	<label for="farcheck">
			 		<input type="checkbox" name="Far" id="farcheck" value="F">	Farenheight
			 	</label>
			 	
			 </div>
		</section>
		<section class="middle-section">
			<div class="c-15">
				<div id="date-time">
					<div id="dayofweek"></div>
					<div id="date">11-09-2019 : 7:30 PM</div>
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
	</article>
<script type="text/javascript">
var cityDefault = "Mumbai";


document.getElementById('searchQuery').addEventListener('keyup', (e)=>{
	city = document.getElementById('searchQuery').value
});

var printTemp = (temp)=>{
	console.log(temp)
return (c==true)?temp+"&#176;C":fConvert(temp)+"&#176;F"
}



function fConvert(temps){

		return (parseFloat(temps) * 1.8 + 32).toFixed(2)
}
	

var getDayofWeek = (date) =>{
var weekdays = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];


var dt = new Date(date);

return weekdays[dt.getDay()];

}




document.getElementById("search").addEventListener("click", ()=>{
if(city.length==""){
	alert('City Field cannot be blank')
	return false;	
}

 fetchData(city)
});

function fetchData(payload){
	var data = new FormData();
data.append( "json", JSON.stringify( payload) );

fetch("api.php",
{
    method: "POST",
    body: data
})
.then(function(res){ return res.json(); })
.then(function(data){ console.log(data) })
}


var farcheck = document.getElementById("farcheck");

farcheck.addEventListener("change", function(){ 
	if(this.checked) {
        c=false;
    } else {
       c=true;
    }
    renderTemp()
});


var city="";
var c = true;

    const state = {
      todaysTemp: '28',
      thigh:"29",
      tlow:"21",
      city: 'Mumbai',
      date:"11-9-2019 20:15"
    };


var renderTemp=()=>{
document.getElementById("tempbind").innerHTML  =  printTemp(state.todaysTemp)
document.getElementById("highbind").innerHTML  =  printTemp(state.thigh) 
document.getElementById("lowbind").innerHTML  =  printTemp(state.tlow)  	
}


var  renderData = ()=>{
	document.getElementById("dayofweek").innerHTML = getDayofWeek(state.date);
document.getElementById("date").innerHTML = state.date;

document.getElementById("locatbind").innerHTML  =  state.city 
renderTemp();
}


renderData();
</script>
</body>
</html>