<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1 { text-align: center; font-size : 600%; font-family: Chiller; font-weight: bold; color: silver; }
		body { background-image: src("../../assets/images/main-back.jpg"); }
		p.addvenue {color:silver; font-family: Ravie; font-size:150%;}
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

<h1>Venues</h1>
   <p class="addvenue">Add a Venue:</p>
   <form action="<?php echo site_url('main/AddVenue')?>"method="post">
   <div>
   <input type="text" maxlength=45 name = "VenNameBox"placeholder="Venue Name"/>
   <input type="text" maxlength=45 name = "StadiumBox"placeholder="Stadium"/>
   <button type="submit">Add Venue</button>
   </form>
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
