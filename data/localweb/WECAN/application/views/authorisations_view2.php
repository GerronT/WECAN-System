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

<h1>Authorisations</h1>

   <p>Add Validation Date:</p>
   <form action="<?php echo site_url('main/AuthoriseTeam')?>"method="post">
   
   <input type="text" name = "MatchIDBox"placeholder="Enter a Match ID"/>
   <input type="text" name = "DateBox"placeholder="YYYY-MM-DD"/>
   <button type="submit">Add Valid Date</button>
   
   </form>
   
   <p>Add Expiration Date:</p>
   <form action="<?php echo site_url('main/ExpireTeam')?>"method="post">
   
   <input type="text" name = "EMatchIDBox"placeholder="Enter a Match ID"/>
   <input type="text" name = "EDateBox"placeholder="YYYY-MM-DD"/>
   <button type="submit">Add Expiry Date</button>
   
   </form>
   
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
