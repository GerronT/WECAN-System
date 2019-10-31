<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1 { text-align: center; font-size : 600%; font-family: Chiller; font-weight: bold; color: silver; }
		body { background-image: src("../../assets/images/main-back.jpg"); }
		p.addmatch {color:silver; font-family: Ravie; font-size:150%;}
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

<h1>Matches</h1>
<p class="addmatch">Change Validation Date:</p>
   <form action="<?php echo site_url('main/ChangeMatchDate')?>"method="post">
   
   <select name = "MatchIDBox">
        <option value="">Choose Match ID</option>
        <?php
        $result1 = mysql_query("SELECT MatchID FROM battle");
        $matchID = Array();
        while ($row = mysql_fetch_array($result1, MYSQL_ASSOC)) {
        $matchID[] =  $row['MatchID'];
        }
        for ($i = 0; $i<count($matchID); $i++){
        ?>
        <option value="<?php echo strtolower($matchID[$i]); ?>"><?php echo $matchID[$i]; ?></option>
        <?php
        }
        ?>
   </select>
   <input type="date" name = "DateBox"placeholder="YYYY-MM-DD"/>
   <button type="submit">Change Valid Date</button> 
   </form>
   <p class="addmatch">Change Match Venue:</p>
   <form action="<?php echo site_url('main/ChangeMatchVenue')?>"method="post">
   
   <select name = "MatchIDBox">
        <option value="">Choose Match ID</option>
        <?php
        $result1 = mysql_query("SELECT MatchID FROM battle");
        $matchID = Array();
        while ($row = mysql_fetch_array($result1, MYSQL_ASSOC)) {
        $matchID[] =  $row['MatchID'];
        }
        for ($i = 0; $i<count($matchID); $i++){
        ?>
        <option value="<?php echo strtolower($matchID[$i]); ?>"><?php echo $matchID[$i]; ?></option>
        <?php
        }
        ?>
   </select>
   <select name = "VenueBox">
        <option value="">Choose Venue</option>
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
        <option value="<?php echo strtolower($venuesID[$i]); ?>"><?php echo $venuenames[$i]; ?></option>
        <?php
        }
        ?>
    </select>
   <button type="submit">Change Venue</button> 
   </form>
   
   <p class="addmatch">Update Teams:</p>
   <form action="<?php echo site_url('main/UpdateTeams')?>"method="post">
        <select name = "MatchIDTBox">
        <option value="">Choose Match ID</option>
        <?php
        $result1 = mysql_query("SELECT MatchID FROM battle");
        $matchID = Array();
        while ($row = mysql_fetch_array($result1, MYSQL_ASSOC)) {
        $matchID[] =  $row['MatchID'];
        }
        for ($i = 0; $i<count($matchID); $i++){
        ?>
        <option value="<?php echo strtolower($matchID[$i]); ?>"><?php echo $matchID[$i]; ?></option>
        <?php
        }
        ?>
   </select>
       <select name = "Team1TBox">
        <option value="">Choose First Team</option>
        <?php
        $result = mysql_query("SELECT Country FROM team");
        $countries = Array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $countries[] = $row['Country'];  
        }
        for ($i = 0; $i<count($countries); $i++){
        ?>
        <option value="<?php echo strtolower($countries[$i]); ?>"><?php echo $countries[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "Team2TBox">
        <option value="">Choose Second Team</option>
        <?php
        $result = mysql_query("SELECT Country FROM team");
        $countries = Array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $countries[] = $row['Country'];  
        }
        for ($i = 0; $i<count($countries); $i++){
        ?>
        <option value="<?php echo strtolower($countries[$i]); ?>"><?php echo $countries[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <button type="submit">Update Teams</button> 
    </form>

   <p class="addmatch">Add a Match:</p>
   <form action="<?php echo site_url('main/AddMatch')?>"method="post">
   <div>
   <input type="text" name = "MatchIDBox"placeholder="Match ID"/>
    <select name = "Team1Box">
        <option value="">Choose First Team</option>
        <?php
        $result = mysql_query("SELECT Country FROM team");
        $countries = Array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $countries[] = $row['Country'];  
        }
        for ($i = 0; $i<count($countries); $i++){
        ?>
        <option value="<?php echo strtolower($countries[$i]); ?>"><?php echo $countries[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "Team2Box">
        <option value="">Choose Second Team</option>
        <?php
        $result = mysql_query("SELECT Country FROM team");
        $countries = Array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $countries[] = $row['Country'];  
        }
        for ($i = 0; $i<count($countries); $i++){
        ?>
        <option value="<?php echo strtolower($countries[$i]); ?>"><?php echo $countries[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "VenueBox">
        <option value="">Choose Venue</option>
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
        <option value="<?php echo strtolower($venuesID[$i]); ?>"><?php echo $venuenames[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <input type="date" name = "MatchDateBox"placeholder="Date (YYYY-MM-DD)"/>
    <button type="submit">Add Match</button>
    </div>
    </form>
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
