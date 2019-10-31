<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1 { text-align: center; font-size : 600%; font-family: Chiller; font-weight: bold; color: silver; }
		body { background-image: src("../../assets/images/main-back.jpg"); }
		p.addentry {color:silver; font-family: Ravie; font-size:150%;}
		
	</style>
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
</head>
<body>
	
        
<h1>EntryLogs</h1>
    <p class="addentry">Add Entry:</p>
    <form action="<?php echo site_url('main/InsertEntry')?>"method="post">
	<select name = "CardIDBox">
        <option value="">Choose Card ID</option>
        <?php
        $result = mysql_query("SELECT r.CardID CardID, c.RegistrationID RegistrationID, c.Name Name, c.Surname Surname FROM card r, competitor c WHERE c.RegistrationID = r.CRegistrationID");
        $cardsID = Array();
        $regsID = Array();
        $names = Array();
        $surnames = Array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$cardsID[] = $row['CardID'];
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
    <select name = "VenueIDBox">
        <option value="">Choose a Venue ID</option>
        <?php
        $result = mysql_query("SELECT VenueID, VenueName FROM venue");
        $venuesID = Array();
        $venuenames = Array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $venuesID[] =  $row['VenueID'];
        $venuenames[] =  $row['VenueName'];
        }
        for ($i = 0; $i<count($venuesID); $i++){
        ?>
        <option value="<?php echo strtolower($venuesID[$i]); ?>"><?php echo $venuesID[$i] . " - " . $venuenames[$i]; ?></option>
        <?php
        }
        ?>
    </select>
	<input type="date" name = "DateBox"placeholder="Enter Date"/>
    <button type="submit">Add Entry</button>
	</form>
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
