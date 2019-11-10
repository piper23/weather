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
					
						<input type="checkbox" name="Far" id="farcheck" value="F">	
						<label for="farcheck">&#176;F</label>

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
<script type="text/javascript" src="assets/js/script.js" ></script>
</body>
</html>