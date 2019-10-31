<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1 { text-align: center; font-size : 600%; font-family: Chiller; font-weight: bold; color: silver;}
		body { background-image: src("../../assets/images/main-back.jpg"); }
		p.comp {color:silver; font-family: Ravie; font-size:150%;}
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
   <p class="comp">Update Competitor Status:</p>
   <form action="<?php echo site_url('main/CompStatus')?>"method="post">
      <select name = "RegIDBox">
        <option value="">Choose Competitor</option>
        <?php
        $result = mysql_query("SELECT RegistrationID,Name,Surname FROM competitor");
        $regsID = Array();
        $names = Array();
        $surnames = Array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
          $regsID[] =  $row['RegistrationID'];
          $names[] =  $row['Name']; 
          $surnames[] =  $row['Surname'];   
        }
        for ($i = 0; $i<count($regsID); $i++){
        ?>
        <option value="<?php echo strtolower($regsID[$i]); ?>"><?php echo $regsID[$i] . " - " . $names[$i] . " " . $surnames[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <select name = "CStatusBox">
        <option value="">Choose Competitor Status</option>
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
    <input type="date" name = "ExpireCardBox"placeholder="ExpireCardDate"/>
   <button type="submit">Update Status</button>
   </form>
   
   <p class="comp">Add Competitor(s):</p>
   <form action="<?php echo site_url('main/AddCompetitor')?>"method="post">
   <div>
   <input type="text" maxlength=45 name = "CNameBox"placeholder="Name"/>
   <input type="text" maxlength=45 name = "CSurnameBox"placeholder="Surname"/>
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
    <input type="date" name = "SDBox"placeholder="Start Date"/>
    </div>
   
   <div>
   <input type="text" maxlength=45 name = "CNameBox2"placeholder="Name"/>
   <input type="text" maxlength=45 name = "CSurnameBox2"placeholder="Surname"/>
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
    <input type="date" name = "SDBox2"placeholder="Start Date"/>
    </div>
   
   <div>
   <input type="text" maxlength=45 name = "CNameBox3"placeholder="Name"/>
   <input type="text" maxlength=45 name = "CSurnameBox3"placeholder="Surname"/>
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
    <input type="date" name = "SDBox3"placeholder="Start Date"/>
    </div>
   
   <div>
   <input type="text" maxlength=45 name = "CNameBox4"placeholder="Name"/>
   <input type="text" maxlength=45 name = "CSurnameBox4"placeholder="Surname"/>
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
    <input type="date" name = "SDBox4"placeholder="Start Date"/>
    </div>
   
   <div>
   <input type="text" maxlength=45 name = "CNameBox5"placeholder="Name"/>
   <input type="text" maxlength=45 name = "CSurnameBox5"placeholder="Surname"/>
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
    <input type="date" name = "SDBox5"placeholder="Start Date"/>
    </div>

	 <div style ="position:absolute; top:280px; left:900px;">
   <input type="text" maxlength=45 name = "CNameBox6"placeholder="Name"/>
   <input type="text" maxlength=45 name = "CSurnameBox6"placeholder="Surname"/>
   <select name = "CountryBox6">
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
    <select name = "TitleBox6">
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
    <select name = "RoleBox6">
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
    <input type="date" name = "SDBox6"placeholder="Start Date"/>
    </div>
   
   <div style ="position:absolute; top:306px; left:900px;">
   <input type="text" maxlength=45 name = "CNameBox7"placeholder="Name"/>
   <input type="text" maxlength=45 name = "CSurnameBox7"placeholder="Surname"/>
   <select name = "CountryBox7">
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
    <select name = "TitleBox7">
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
    <select name = "RoleBox7">
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
    <input type="date" name = "SDBox7"placeholder="Start Date"/>
    </div>
   
   <div style ="position:absolute; top:332px; left:900px;">
   <input type="text" maxlength=45 name = "CNameBox8"placeholder="Name"/>
   <input type="text" maxlength=45 name = "CSurnameBox8"placeholder="Surname"/>
   <select name = "CountryBox8">
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
    <select name = "TitleBox8">
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
    <select name = "RoleBox8">
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
    <input type="date" name = "SDBox8"placeholder="Start Date"/>
    </div>
   
   <div style ="position:absolute; top:358px; left:900px;">
   <input type="text" maxlength=45 name = "CNameBox9"placeholder="Name"/>
   <input type="text" maxlength=45 name = "CSurnameBox9"placeholder="Surname"/>
   <select name = "CountryBox9">
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
    <select name = "TitleBox9">
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
    <select name = "RoleBox9">
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
    <input type="date" name = "SDBox9"placeholder="Start Date"/>
    </div>
   
   <div style ="position:absolute; top:384px; left:900px;">
   <input type="text" maxlength=45 name = "CNameBox10"placeholder="Name"/>
   <input type="text" maxlength=45 name = "CSurnameBox10"placeholder="Surname"/>
   <select name = "CountryBox10">
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
    <select name = "TitleBox10">
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
    <select name = "RoleBox10">
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
    <input type="date" name = "SDBox10"placeholder="Start Date"/>
    </div>
   <p></p>
   <button type="submit">Add Competitor(s)</button>
   </form>
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
