<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1 {text-align: center; font-size : 600%; font-family: Chiller; font-weight: bold; color: silver;}
		body { background-image: src("../../assets/images/main-back.jpg"); }
	</style>
</head>
<body>

<h1>Queries</h1>
<div align='center'>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query5')?>'">Authorisations Specified Search</button>
	<!--<button type="submit" onclick="location.href='<?php echo site_url('main/query1')?>'">Authorisations for a Competitor</button>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query2')?>'">Authorisations for a Venue</button>-->
	<button type="submit" onclick="location.href='<?php echo site_url('main/query3')?>'">Log Entries Search</button>
	<!--<button type="submit" onclick="location.href='<?php echo site_url('main/query4')?>'">Log Entries For a Competitor</button>-->
	<button type="submit" onclick="location.href='<?php echo site_url('main/sample')?>'">Sample Data</button>
</div>
    
</body>
</html>
