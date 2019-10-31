<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1 { text-align: center; 	font-family: Chiller; color: silver; }
		#addteam {position:absolute; top: 160px; left:50px;}
		p.add-team{font-size:150%; color: white; position: absolute; top: 160px; left:880px; font-family: Times New Roman;}
		#updateteam {position:absolute; top: 300px; right:50px;}
		p.update-team{font-size:150%; color: white; position: absolute; top: 280px; left:2px; font-family: Times New Roman;}
		#addcomp {position:absolute; top: 430px; left:50px;}
		p.add-comp{font-size:150%; color: white; position: absolute; top: 430px; left:955px; font-family: Times New Roman;}
		p.add-compnl{font-size:150%; color: white; position: absolute; top: 670px; left:2pxpx; font-family: Times New Roman;}
		#updatecomp {position:absolute; top: 720px; right:35px;}
		p.update-comp{font-size:150%; color: white; position: absolute; top: 720px; left:2px; font-family: Times New Roman;}
			
	</style>
</head>
<body>

<h1>Help Guide</h1>

<div align="left">
	<img id="addteam" src="../../assets/images/addteam.png" alt="add team" height="100" width="822">	
</div>
<p class="add-team">Adding a Team requires the 'Country Name', their 'National Football Association', its 'Acronym' and their 'Nickname'. Note that 
'Nickname' is optional and that it is possible to add a team without them. All other fields are required for the creation to succeed. When
a team is successfully created, their status is automatically set to 'In-Game'.</p>

<div align="right">
	<img id="updateteam" src="../../assets/images/updateteam.png" alt="add team" height="88" width="583">	
</div>
<p class="update-team">'Team Status' can have three different states (In-Game, Eliminated, Disqualified). When a team's status is 
changed into 'Eliminated' or 'Disqualified', a <br/>'Date' to expire their cards with will be required. In effect, this will update all the 
Competitors' status belonging to that team to also be changed<br/> respectively, and at the same time, their currently active cards will
be set to 'Expired' updating their 'End Date' and also cancelling their Authorisations.<br/> It is also possible to change a team's status back to 'In-Game' which will enable 
them to gain their authorisations back.</p>

<div align="left">
	<img id="addcomp" src="../../assets/images/addcomp.png" alt="add team" height="234" width="899">	
</div>
<p class="add-comp">Adding a Competitor to the Competition will require their 'First Name', 'Last Name', 'Country', 'Title' and their 'Role' which are all declared as
required fields. When a Competitor is successfully registered, a Registration ID will be assigned and generated for them and their details will be added to the database. The 'Competitor Status' field
will reflect their Team's current status thus a user input isn't required. A Card will also be automatically issued to them. A Unique 'Card ID' will be generated, with its 'Issue Number' being set to '1' 
by default. The 'Start Date' and the 'End Date' of their card are set to "July 6 2017" and "August 6 2017" respectively (Duration of the Competition). Similar to the 'Competitor Status,
their 'Card Status' will reflect the state that their team is currently in. When a competitor joins halfway through the competiton, the 'Date' field will have to be filled in so the  </p>
<p class="add-compnl">'Start Date' of their Card will reflect this. Finally, 'Authorisations' to Matches that they should be authorised to will also be automatically added given that their team hasn't yet been eliminated from the Competition.</p>

<div align="right">
	<img id="updatecomp" src="../../assets/images/updatecomp.png" alt="add team" height="91" width="688">	
</div>
<p class="update-comp">'Competitor Status' works very similarly to 'Team Status'. However, changes and updates are only made to a specified Competitor. A <br/>Competitor Status also have more
states (In-Game, Eliminated, Disqualified, Sanction, Injured). Updating a Competitor's Status to anything<br/> but 'In-Game' will expire their card on the date given cancelling their current
authorisations. Similar to 'Team Status', this change is reversible.</p>
    
</body>
</html>

	<!--<img id="addteam" src="../../assets/images/updateteam.png" alt="add team" height="86" width="820">
	<img id="addteam" src="../../assets/images/addcomp.png" alt="add team" height="234" width="899">
	<img id="addteam" src="../../assets/images/updatecomp.png" alt="add team" height="91" width="897">
	<img id="addteam" src="../../assets/images/addcard.png" alt="add team" height="91" width="647">
	<img id="addteam" src="../../assets/images/addauthor.png" alt="add team" height="96" width="467">
	<img id="addteam" src="../../assets/images/addentry.png" alt="add team" height="99" width="659">
	<img id="addteam" src="../../assets/images/addmatch.png" alt="add team" height="92" width="894">
	<img id="addteam" src="../../assets/images/changedate.png" alt="add team" height="86" width="894">
	<img id="addteam" src="../../assets/images/changeven.png" alt="add team" height="79" width="895">
	<img id="addteam" src="../../assets/images/updateteams.png" alt="add team" height="80" width="896">
	<img id="addteam" src="../../assets/images/addven.png" alt="add team" height="96" width="467"> -->
