<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1 { text-align: center; font-size : 600%; font-family: Chiller; font-weight: bold; color: silver; }
		h2 { text-align: center; font-family: Ravie; font-size:200%; color: black;}
		table.mytable {border-collapse: collapse; background-color: white;
    color: black;}
		table.mytable td, th {border: 1px solid grey; padding: 5px 15px 2px 7px;}
		th {background-color: #f2e4d5;}	
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
<h2>Sample Data</h2>
<div align='center'>
<?php
	$tmpl = array ('table_open' => '<table class="mytable">');
	$this->table->set_template($tmpl); 
	$getcardID3 = Array(1,24,2,7,3,4,20);
	$country = "Scotland";
	$matchID = 8;
	$regID = 170007;
	$maxcardid = Array(57);
	
	$this->db->query('drop table if exists temp');
	$this->db->query('create temporary table temp as 
	   (SELECT TSTeamStatusID FROM team WHERE Country = "'.$country.'")');
	$query = $this->db->query('select * from temp;');
	echo $this->table->generate($query);
?>
</div>
</body>
</html>
