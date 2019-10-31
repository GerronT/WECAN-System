<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1, h2 { text-align: center; font-family: Calibri; }
		table.mytable {border-collapse: collapse;}
		table.mytable td, th {border: 1px solid grey; padding: 5px 15px 2px 7px;}
		th {background-color: #f2e4d5;}		
	</style>
</head>
<body>

<h1>Queries</h1>
<div align='center'>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query1')?>'">Competitors Authorisation Search</button>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query2')?>'">Ranked items by sales</button>
</div>
<h2>Competitors Authorisation Search</h2>
<div align='center'>
	
	
    <form action="<?php echo site_url('main/RegIDSearch')?>"method="post">
    <p>Registration ID:</p>
    <input type="text" name = "RegIDSearchBox"placeholder="Enter Registration ID"/>
    <p>Venue Name:</p>
    <input type="text" name = "VenIDSearchBox"placeholder="Enter Venue ID"/> 
    <p>Date:</p>
    <input type="text" name = "DateSearchBox"placeholder="YYYY-MM-DD"/>
    <p>""</p>  
    <button type="submit">Search</button>

   </form>


</div>
</body>
</html>
