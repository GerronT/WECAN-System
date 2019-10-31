<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1 { text-align: center; font-size : 600%; font-family: Chiller; font-weight: bold; color: silver; }
		body { background-image: src("../../assets/images/main-back.jpg"); }
		p.authorise {color:silver; font-family: Ravie; font-size:150%;}
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

<h1>Authorisations</h1>
   
  
   <p class="authorise">Add Authorisation:</p>
   <form action="<?php echo site_url('main/AddAuthorisation')?>"method="post">
   <select name = "CardIDBox2">
        <option value="">Choose Card ID</option>
        <?php
        $result1 = mysql_query("SELECT CardID,CRegistrationID FROM card WHERE CSCardStateID = 1");
        $cardsID = Array();
        $cregsID = Array();
        while ($row = mysql_fetch_array($result1, MYSQL_ASSOC)) {
        $cardsID[] =  $row['CardID'];
        $cregsID[] =  $row['CRegistrationID'];  
        }
        for ($i = 0; $i<count($cregsID); $i++){
        ?>
        <option value="<?php echo strtolower($cardsID[$i]); ?>"><?php echo $cardsID[$i] . " - " . $cregsID[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "MatchIDBox2">
        <option value="">Choose Match ID</option>
        <?php
        $result1 = mysql_query("SELECT MatchID, TeamCountry1,TeamCountry2 FROM battle");
        $matchID = Array();
        $teams1 = Array();
        $teams2 = Array();
        while ($row = mysql_fetch_array($result1, MYSQL_ASSOC)) {
        $matchID[] =  $row['MatchID'];
        $teams1[] =  $row['TeamCountry1'];
        $teams2[] =  $row['TeamCountry2'];    
        }
        for ($i = 0; $i<count($matchID); $i++){
        ?>
        <option value="<?php echo strtolower($matchID[$i]); ?>"><?php echo $matchID[$i] . " - " . $teams1[$i] . " vs " . $teams2[$i]; ?></option>
        <?php
        }
        ?>
    </select>
   <button type="submit">Add Authorisation</button>
   </form>
   
 <!--
   <p>Delete Authorisation:</p>
   <form action="<?php echo site_url('main/DeleteAuthorisation')?>"method="post">
   
<select name = "CardIDBox">
        <option value="">Choose Card ID</option>
        <?php
        $result1 = mysql_query("SELECT CardID,CRegistrationID FROM card");
        $cardsID = Array();
        $cregsID = Array();
        while ($row = mysql_fetch_array($result1, MYSQL_ASSOC)) {
        $cardsID[] =  $row['CardID'];
        $cregsID[] =  $row['CRegistrationID'];  
        }
        for ($i = 0; $i<count($cregsID); $i++){
        ?>
        <option value="<?php echo strtolower($cardsID[$i]); ?>"><?php echo $cardsID[$i] . " - " . $cregsID[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "MatchIDBox">
        <option value="">Choose Match ID</option>
        <?php
        $result1 = mysql_query("SELECT MatchID, MatchName FROM battle");
        $matchID = Array();
        $matchname = Array();
        while ($row = mysql_fetch_array($result1, MYSQL_ASSOC)) {
        $matchID[] =  $row['MatchID'];
        $matchnames[] =  $row['MatchName'];  
        }
        for ($i = 0; $i<count($matchID); $i++){
        ?>
        <option value="<?php echo strtolower($matchID[$i]); ?>"><?php echo $matchID[$i] . " - " . $matchnames[$i]; ?></option>
        <?php
        }
        ?>
    </select>
   <button type="submit">Delete Authorisation</button>
   
   </form>
   
   -->
   
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
