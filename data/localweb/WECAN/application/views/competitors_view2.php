<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1 { text-align: center; 	font-family: Calibri; }
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

<h1>Competitors</h1>
   <p>Update Competitor Status By Country:</p>
   <form action="<?php echo site_url('main/CompStatus')?>"method="post">
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

    <select name = "CStatusBox">
        <option value="">Choose Card State</option>
        <?php
        $result = mysql_query("SELECT CompetitorStatusID, CompetitorStatus FROM competitor_status");
        $compSID = Array();
        $compstats = Array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $compSID[] =  $row['CompetitorStatusID'];
        $compstats[] =  $row['CompetitorStatus'];
        }
        for ($i = 0; $i<count($compSID); $i++){
        ?>
        <option value="<?php echo strtolower($compSID[$i]); ?>"><?php echo $compstats[$i]; ?></option>
        <?php
        }
        ?>
    </select>
   <button type="submit">Update Status</button>
   </form>
   
   <p>Add Competitors:</p>
   <form action="<?php echo site_url('main/AddCompetitor')?>"method="post">
   <div>
   <input type="text" name = "RegIDBox"placeholder="Registration ID"/>
   <input type="text" name = "CNameBox"placeholder="Name"/>
   <input type="text" name = "CSurnameBox"placeholder="Surname"/>
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
    <select name = "TitleBox">
        <option value="">Choose Title</option>
        <?php
        $result2 = mysql_query("SELECT TitleID, Title FROM title");
        $titlesID = Array();
        $titles = Array();
        while ($row = mysql_fetch_array($result2, MYSQL_ASSOC)) {
        $titlesID[] =  $row['TitleID'];
        $titles[] =  $row['Title'];
        }
        for ($i = 0; $i<count($titles); $i++){
        ?>
        <option value="<?php echo strtolower($titlesID[$i]); ?>"><?php echo $titles[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "CompSBox">
        <option value="">Choose Competitor Status</option>
        <?php
        $result3 = mysql_query("SELECT CompetitorStatusID, CompetitorStatus FROM competitor_status");
        $competitorstatus = Array();
        $competitorstatusID = Array();
        while ($row = mysql_fetch_array($result3, MYSQL_ASSOC)) {
        $competitorstatusID[] = $row['CompetitorStatusID'];
        $competitorstatus[] = $row['CompetitorStatus'];    
        }
        for ($i = 0; $i<count($competitorstatus); $i++){
        ?>
        <option value="<?php echo strtolower($competitorstatusID[$i]); ?>"><?php echo $competitorstatus[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "RoleBox">
        <option value="">Choose Role</option>
        <?php
        $result4 = mysql_query("SELECT RoleID, Role FROM role");
        $rolesID = Array();
        $roles = Array();
        while ($row = mysql_fetch_array($result4, MYSQL_ASSOC)) {
        $rolesID[] =  $row['RoleID'];
        $roles[] =  $row['Role'];  
        }
        for ($i = 0; $i<count($roles); $i++){
        ?>
        <option value="<?php echo strtolower($rolesID[$i]); ?>"><?php echo $roles[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    </div>
   
   <div>
   <input type="text" name = "RegIDBox2"placeholder="Registration ID"/>
   <input type="text" name = "CNameBox2"placeholder="Name"/>
   <input type="text" name = "CSurnameBox2"placeholder="Surname"/>
   <select name = "CountryBox2">
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
    <select name = "TitleBox2">
        <option value="">Choose Title</option>
        <?php
        $result2 = mysql_query("SELECT TitleID, Title FROM title");
        $titlesID = Array();
        $titles = Array();
        while ($row = mysql_fetch_array($result2, MYSQL_ASSOC)) {
        $titlesID[] =  $row['TitleID'];
        $titles[] =  $row['Title'];
        }
        for ($i = 0; $i<count($titles); $i++){
        ?>
        <option value="<?php echo strtolower($titlesID[$i]); ?>"><?php echo $titles[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "CompSBox2">
        <option value="">Choose Competitor Status</option>
        <?php
        $result3 = mysql_query("SELECT CompetitorStatusID, CompetitorStatus FROM competitor_status");
        $competitorstatus = Array();
        $competitorstatusID = Array();
        while ($row = mysql_fetch_array($result3, MYSQL_ASSOC)) {
        $competitorstatusID[] = $row['CompetitorStatusID'];
        $competitorstatus[] = $row['CompetitorStatus'];    
        }
        for ($i = 0; $i<count($competitorstatus); $i++){
        ?>
        <option value="<?php echo strtolower($competitorstatusID[$i]); ?>"><?php echo $competitorstatus[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "RoleBox2">
        <option value="">Choose Role</option>
        <?php
        $result4 = mysql_query("SELECT RoleID, Role FROM role");
        $rolesID = Array();
        $roles = Array();
        while ($row = mysql_fetch_array($result4, MYSQL_ASSOC)) {
        $rolesID[] =  $row['RoleID'];
        $roles[] =  $row['Role'];  
        }
        for ($i = 0; $i<count($roles); $i++){
        ?>
        <option value="<?php echo strtolower($rolesID[$i]); ?>"><?php echo $roles[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    </div>
   
   <div>
   <input type="text" name = "RegIDBox3"placeholder="Registration ID"/>
   <input type="text" name = "CNameBox3"placeholder="Name"/>
   <input type="text" name = "CSurnameBox3"placeholder="Surname"/>
   <select name = "CountryBox3">
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
    <select name = "TitleBox3">
        <option value="">Choose Title</option>
        <?php
        $result2 = mysql_query("SELECT TitleID, Title FROM title");
        $titlesID = Array();
        $titles = Array();
        while ($row = mysql_fetch_array($result2, MYSQL_ASSOC)) {
        $titlesID[] =  $row['TitleID'];
        $titles[] =  $row['Title'];
        }
        for ($i = 0; $i<count($titles); $i++){
        ?>
        <option value="<?php echo strtolower($titlesID[$i]); ?>"><?php echo $titles[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "CompSBox3">
        <option value="">Choose Competitor Status</option>
        <?php
        $result3 = mysql_query("SELECT CompetitorStatusID, CompetitorStatus FROM competitor_status");
        $competitorstatus = Array();
        $competitorstatusID = Array();
        while ($row = mysql_fetch_array($result3, MYSQL_ASSOC)) {
        $competitorstatusID[] = $row['CompetitorStatusID'];
        $competitorstatus[] = $row['CompetitorStatus'];    
        }
        for ($i = 0; $i<count($competitorstatus); $i++){
        ?>
        <option value="<?php echo strtolower($competitorstatusID[$i]); ?>"><?php echo $competitorstatus[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "RoleBox3">
        <option value="">Choose Role</option>
        <?php
        $result4 = mysql_query("SELECT RoleID, Role FROM role");
        $rolesID = Array();
        $roles = Array();
        while ($row = mysql_fetch_array($result4, MYSQL_ASSOC)) {
        $rolesID[] =  $row['RoleID'];
        $roles[] =  $row['Role'];  
        }
        for ($i = 0; $i<count($roles); $i++){
        ?>
        <option value="<?php echo strtolower($rolesID[$i]); ?>"><?php echo $roles[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    </div>
   
   <div>
   <input type="text" name = "RegIDBox4"placeholder="Registration ID"/>
   <input type="text" name = "CNameBox4"placeholder="Name"/>
   <input type="text" name = "CSurnameBox4"placeholder="Surname"/>
   <select name = "CountryBox4">
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
    <select name = "TitleBox4">
        <option value="">Choose Title</option>
        <?php
        $result2 = mysql_query("SELECT TitleID, Title FROM title");
        $titlesID = Array();
        $titles = Array();
        while ($row = mysql_fetch_array($result2, MYSQL_ASSOC)) {
        $titlesID[] =  $row['TitleID'];
        $titles[] =  $row['Title'];
        }
        for ($i = 0; $i<count($titles); $i++){
        ?>
        <option value="<?php echo strtolower($titlesID[$i]); ?>"><?php echo $titles[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "CompSBox4">
        <option value="">Choose Competitor Status</option>
        <?php
        $result3 = mysql_query("SELECT CompetitorStatusID, CompetitorStatus FROM competitor_status");
        $competitorstatus = Array();
        $competitorstatusID = Array();
        while ($row = mysql_fetch_array($result3, MYSQL_ASSOC)) {
        $competitorstatusID[] = $row['CompetitorStatusID'];
        $competitorstatus[] = $row['CompetitorStatus'];    
        }
        for ($i = 0; $i<count($competitorstatus); $i++){
        ?>
        <option value="<?php echo strtolower($competitorstatusID[$i]); ?>"><?php echo $competitorstatus[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "RoleBox4">
        <option value="">Choose Role</option>
        <?php
        $result4 = mysql_query("SELECT RoleID, Role FROM role");
        $rolesID = Array();
        $roles = Array();
        while ($row = mysql_fetch_array($result4, MYSQL_ASSOC)) {
        $rolesID[] =  $row['RoleID'];
        $roles[] =  $row['Role'];  
        }
        for ($i = 0; $i<count($roles); $i++){
        ?>
        <option value="<?php echo strtolower($rolesID[$i]); ?>"><?php echo $roles[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    </div>
   
   <div>
   <input type="text" name = "RegIDBox5"placeholder="Registration ID"/>
   <input type="text" name = "CNameBox5"placeholder="Name"/>
   <input type="text" name = "CSurnameBox5"placeholder="Surname"/>
   <select name = "CountryBox5">
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
    <select name = "TitleBox5">
        <option value="">Choose Title</option>
        <?php
        $result2 = mysql_query("SELECT TitleID, Title FROM title");
        $titlesID = Array();
        $titles = Array();
        while ($row = mysql_fetch_array($result2, MYSQL_ASSOC)) {
        $titlesID[] =  $row['TitleID'];
        $titles[] =  $row['Title'];
        }
        for ($i = 0; $i<count($titles); $i++){
        ?>
        <option value="<?php echo strtolower($titlesID[$i]); ?>"><?php echo $titles[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "CompSBox5">
        <option value="">Choose Competitor Status</option>
        <?php
        $result3 = mysql_query("SELECT CompetitorStatusID, CompetitorStatus FROM competitor_status");
        $competitorstatus = Array();
        $competitorstatusID = Array();
        while ($row = mysql_fetch_array($result3, MYSQL_ASSOC)) {
        $competitorstatusID[] = $row['CompetitorStatusID'];
        $competitorstatus[] = $row['CompetitorStatus'];    
        }
        for ($i = 0; $i<count($competitorstatus); $i++){
        ?>
        <option value="<?php echo strtolower($competitorstatusID[$i]); ?>"><?php echo $competitorstatus[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "RoleBox5">
        <option value="">Choose Role</option>
        <?php
        $result4 = mysql_query("SELECT RoleID, Role FROM role");
        $rolesID = Array();
        $roles = Array();
        while ($row = mysql_fetch_array($result4, MYSQL_ASSOC)) {
        $rolesID[] =  $row['RoleID'];
        $roles[] =  $row['Role'];  
        }
        for ($i = 0; $i<count($roles); $i++){
        ?>
        <option value="<?php echo strtolower($rolesID[$i]); ?>"><?php echo $roles[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    </div>
   <p></p>
   <button type="submit">Add Competitor(s)</button>
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
