<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>WECAN</title>
   	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		h1 { text-align: center; font-weight: bold; font-family: Chiller; color: silver; font-size:400%;  }	
		#userimage { display: block; padding-top: 20px; margin-left: auto; margin-right: auto; }	
		body { background-image: url("http://i.imgur.com/q78WfpO.jpg"); }
	</style>
 </head>
 <body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style = "font-size:200%; font-family:AR CENA; color: gold; font-weight: bold;">WECAN SYSTEM</a>
    </div>
    </div>
    </nav>
   <h1>WELCOME TO THE WECAN SYSTEM</h1>
   <?php echo validation_errors(); ?>
   <?php echo form_open('verifylogin'); ?>
   
   <div style="position: absolute; left: 800px; top: 420px; color: silver; font-weight: bold;">
	<label class="left">Username:</label>
    <input type="text" style="color: black;" size="20" id="username" name="username"/>
   </div>
   
   <div style="position: absolute; left: 801px; top: 450px; color: silver; font-weight: bold;">
	<label class="left">Password:</label>
    <input type="password" style="color: black;" size="20" id="passowrd" name="password"/>
   </div>
   
   <div style="position: absolute; left: 930px; top: 490px; color: black;">
    <input type="submit" value="Login"/>
   </div>
   
   <div align="center">
	<img id="userimage" src="http://philipsenphilips.nl/wp-content/uploads/2017/01/Profile-Example-Pic.png" alt="user picture" height="260" width="250">
	<!--Image credits: http://www.wallpaperdecor.com.au/murals/scandinavian-wallpaper-decor/typography-collection/cogs-gears-e21324/ -->
</div>

     
   </form>
 </body>
</html>
