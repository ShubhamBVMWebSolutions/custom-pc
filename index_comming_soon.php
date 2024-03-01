<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Coming Soon</title>
	<style>
	body, html {
	  height: 100%;
	  margin: 0;
	}
	.bgimg {
	  background:#dfe8eb;
	  height: 100%;
	  background-position: center;
	  background-size: cover;
	  position: relative;
	  color:#000;
	  font-family: "Courier New", Courier, monospace;
	  font-size: 25px;
	}
	.topleft {
	  position: absolute;
	  top: 0;
	  left: 16px;
	}
	.bottomleft {
	  position: absolute;
	  bottom: 0;
	  left: 16px;
	}
	.middle {
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  text-align: center;
	}
	#demo span {
	    margin-right: 23px;
	    margin-left: 5px;
	    text-transform: capitalize;
	}
	hr {
	  margin: auto;
	  width: 40%;
	}	
	</style>
</head>
<body>
<div class="bgimg">
  <div class="middle">
  	<div class="text-center">
  		<img src="https://bvmprojects.org/custom_pc/public/img/1667890373.png" style="height:125px;">
  	</div>
    <h1>COMING SOON</h1>
    <hr>
    <p id="demo" style="font-size:30px;font-weight:800;"></p>
  </div>
</div>
<script>
// Set the date we're counting down to
var countDownDate = new Date("Jan 25, 2023 18:00:00").getTime();

// Update the count down every 1 second
var countdownfunction = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();
  
  // Find the distance between now an the count down date
  var distance = countDownDate - now;
  
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "<span>day</span>" + hours + "<span>hours</span>"
  + minutes + "<span>minutes</span>" + seconds + "<span>seconds</span>";
  
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(countdownfunction);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
</body>
</html>
