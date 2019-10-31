<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1 { text-align: center; font-size : 600%; font-family: Chiller; font-weight: bold; color: silver;}
		body { background-image: src("../../assets/images/main-back.jpg"); }
		p.team {color:silver; font-family: Ravie; font-size:150%;}
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

<h1>Teams</h1>
   <p class="team">Update Team Status:</p>
   <form action="<?php echo site_url('main/TeamStatus')?>"method="post">
      <select name = "CountryBox">
        <option value="">Choose Country</option>
        <?php
        $result1 = mysql_query("SELECT Country FROM team");
        $countries = Array();
        while ($row = mysql_fetch_array($result1, MYSQL_ASSOC)) {
          $countries[] =  $row['Country'];  
        }
        foreach($countries as $country){
        ?>
        <option value="<?php echo strtolower($country); ?>"><?php echo $country; ?></option>
        <?php
        }
        ?>
    </select>

    <select name = "TStatusBox">
        <option value="">Choose Team Status</option>
        <?php
        $result = mysql_query("SELECT TeamStatusID, TeamStatus FROM team_status");
        $teamSID = Array();
        $teamstats = Array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $teamSID[] =  $row['TeamStatusID'];
        $teamstats[] =  $row['TeamStatus'];
        }
        for ($i = 0; $i<count($teamSID); $i++){
        ?>
        <option value="<?php echo strtolower($teamSID[$i]); ?>"><?php echo $teamstats[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <input type="date" name = "ExpireCardBox"placeholder="ExpireCardDate"/>
   <button type="submit">Update Status</button>
   </form>
   <p class="team">Add a Team:</p>
   <form action="<?php echo site_url('main/AddTeam')?>"method="post">
   <div>
   <input type="text" maxlength=30 name = "CountryBox"placeholder="Country"/>
   <input type="text" maxlength=60 name = "NFABox"placeholder="NFA"/>
   <input type="text" maxlength=10 name = "AcronymBox"placeholder="Acronym"/>
   <input type="text" maxlength=30 name = "NicknameBox"placeholder="Nickname"/>
   <button type="submit">Add Team</button>
   </form>
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
