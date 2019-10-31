<!DOCTYPE html>
<html lang="en">
<head>
  <title>WECAN SYSTEM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <style>
		h1 { text-align: center; font-size: 500%;	font-family: Chiller; color:black; font-weight:bold; }
		p.p-centre { text-align: center; font-family: Arial; color: black; }
		#homepic { display: block; padding-top: 20px; margin-left: auto; margin-right: auto; }	
		body { background-image: url("https://wallpaperbrowse.com/media/images/background-18.jpg"); }	
		a{}
  </style>
</head>
<body>
	
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style = "font-size:200%; font-family:AR CENA; color: gold; font-weight: bold;">WECAN SYSTEM</a>
    </div>
    <ul class="nav navbar-nav">
      	<li><a href='<?php echo site_url('main/index')?>'style ="font-family:Chiller; font-size: 200%; font-weight: bold;">Home</a></li>
		<li><a href='<?php echo site_url('main/teams')?>'style ="font-family:Chiller; font-size: 200%; font-weight: bold;">Teams</a></li>
		<li><a href='<?php echo site_url('main/competitors')?>'style ="font-family:Chiller; font-size: 200%; font-weight: bold;">Competitors</a></li>
		<li><a href='<?php echo site_url('main/cards')?>'style ="font-family:Chiller; font-size: 200%; font-weight: bold;">Cards</a></li>
		<li><a href='<?php echo site_url('main/authorisations')?>'style ="font-family:Chiller; font-size: 200%; font-weight: bold;">Authorisations</a></li>
		<li><a href='<?php echo site_url('main/entrylogs')?>'style ="font-family:Chiller; font-size: 200%; font-weight: bold;">EntryLogs</a></li>
		<li><a href='<?php echo site_url('main/matches')?>'style ="font-family:Chiller; font-size: 200%; font-weight: bold;">Matches</a></li>
		<li><a href='<?php echo site_url('main/venues')?>'style ="font-family:Chiller; font-size: 200%; font-weight: bold;">Venues</a></li>
		<li><a href='<?php echo site_url('main/help')?>'style ="font-family:Chiller; font-size: 200%; font-weight: bold;">Help</a></li>

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
      <li><a href='<?php echo site_url('main/querynav')?>'style ="font-family:Chiller; font-size: 200%; font-weight: bold;">Queries</a></li>
      <li><a href='<?php echo site_url('home/logout')?>'style ="font-family:Chiller; font-size: 200%; font-weight: bold;"</span> Logout</a></li>
    </ul>
  </div>
</nav>
  

</body>
</html>
