<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1 { text-align: center; font-size : 600%; font-family: Chiller; font-weight: bold; color: silver; }
		body { background-image: src("../../assets/images/main-back.jpg"); }
		p.card {color:silver; font-family: Ravie; font-size:150%;}
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

<h1>Cards</h1>
  <!-- <p class="card">Update Card State:</p>
   <form action="<?php echo site_url('main/ChangeCardStatus')?>"method="post">
   <select name = "CardIDBox">
        <option value="">Choose Card ID</option>
        <?php
        $result1 = mysql_query("SELECT CardID FROM card WHERE CSCardStateID != 3");
        $cardsID = Array();
        while ($row = mysql_fetch_array($result1, MYSQL_ASSOC)) {
        $cardsID[] =  $row['CardID'];
        }
        for ($i = 0; $i<count($cardsID); $i++){
        ?>
        <option value="<?php echo strtolower($cardsID[$i]); ?>"><?php echo $cardsID[$i]; ?></option>
        <?php
        }
        ?>
   </select>
   <select name = "CardStatusBox">
        <option value="">Choose Card State</option>
        <?php
        $result = mysql_query("SELECT CardStateID,Validity FROM card_state");
        $cardsSID = Array();
        $cardsS = Array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $cardsSID[] =  $row['CardStateID'];
        $cardsS[] =  $row['Validity'];
        }
        for ($i = 0; $i<count($cardsSID); $i++){
        ?>
        <option value="<?php echo strtolower($cardsSID[$i]); ?>"><?php echo $cardsS[$i]; ?></option>
        <?php
        }
        ?>
   </select>
   <button type="submit">Update Card Status</button>
   </form>
   -->
   <form action="<?php echo site_url('main/AddCard')?>"method="post">
   <div>
   <p class="card">Add Card:</p>
   <select name = "RegIDBox">
        <option value="">Choose a Registration ID</option>
        <?php
        $result = mysql_query("SELECT RegistrationID, Name, Surname FROM competitor");
        $RegsID = Array();
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
    <!--<input type="date" name = "IssueDateBox"placeholder="Issue Date"/> -->
    <input type="text" maxlength=45 name = "RRBox"placeholder="Replacement Reason"/>
    <input type="date" name = "SDBox"placeholder="Start Date"/>
    <button type="submit">Add Card</button>
    </form>
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
