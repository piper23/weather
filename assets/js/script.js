	//Default Data and State
		var city="Mumbai";
		var c = true;
		const state = {
			todaysTemp: '',
			thigh:"",
			tlow:"",
			city: '',
			date:"",
			forecast:[]
		};

		document.getElementById('searchQuery').addEventListener('keyup', (e)=>{
			if (e.keyCode === 13) {
				fetchData(city);
			}
			city = document.getElementById('searchQuery').value
		});

//Print Temp checks for Farenheight Toggle
var printTemp = (temp)=>{
	return (c==true)?temp+"&#176;C":fConvert(temp)+"&#176;F"
}
//Function to convert Temp
var fConvert=(temps)=>{
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


///Search button handler
document.getElementById("search").addEventListener("click", ()=>{

	city=document.getElementById("searchQuery").value;

	fetchData(city);
});



//Ajax Function
var fetchData = (payload,def=1) =>{
	if(city==""){
		alert('City Field cannot be blank')
		return false;	
	}
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


//Render Codes..........
//render Temps///////
//render Forecast block
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
///end render Temps


//Render All Data
var  renderData = ()=>{
	document.getElementById("dayofweek").innerHTML = getDayofWeek(state.date);
	document.getElementById("date").innerHTML = state.date;

	document.getElementById("locatbind").innerHTML  =  state.city 
	renderTemp();
}



fetchData(city);