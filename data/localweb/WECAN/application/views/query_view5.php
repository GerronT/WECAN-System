<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1{ font-size : 600%; font-family: Chiller; font-weight: bold; color: silver; }
		h2 { text-align: center; font-family: Ravie; font-size:200%; color: black;}
		table.mytable {border-collapse: collapse;}
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
<h2>Authorisation (Specified Search)</h2>
<div align='center'>
<form action="<?php echo site_url('main/query5_1')?>"method="post">
    <select name = "CardIDBox">
        <option value="">Choose a Card/RegistrationID</option>
        <?php
        $result = mysql_query("SELECT r.CardID, c.RegistrationID, c.Name, c.Surname FROM competitor c, card r WHERE c.RegistrationID = r.CRegistrationID ");
        $cardsID = Array();
        $regsID = Array();
        $names = Array();
        $surnames = Array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $cardsID[] =  $row['CardID'];
        $regsID[] =  $row['RegistrationID'];
        $names[] =  $row['Name'];
        $surnames[] =  $row['Surname'];    
        }
        for ($i = 0; $i<count($cardsID); $i++){
        ?>
        <option value="<?php echo strtolower($cardsID[$i]); ?>"><?php echo $cardsID[$i] . " - " . $regsID[$i] . " - " . $names[$i] . " " . $surnames[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "VenIDBox">
        <option value="">Choose a Venue</option>
        <?php
        $result = mysql_query("SELECT VenueID,VenueName FROM venue");
        $vensID = Array();
        $vens = Array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $vensID[] =  $row['VenueID'];
        $vens[] =  $row['VenueName'];   
        }
        for ($i = 0; $i<count($vensID); $i++){
        ?>
        <option value="<?php echo strtolower($vensID[$i]); ?>"><?php echo $vensID[$i] . " - " . $vens[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <input type="date" name = "DateBox"placeholder="Start Date"/>
   <button type="submit">Search Entry Logs</button>
</form>
<?php

?>
</div>
</body>
</html>
