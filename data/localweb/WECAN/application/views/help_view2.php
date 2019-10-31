<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1 { text-align: center; 	font-family: Chiller; color: silver; }
		#addcard {position:absolute; top: 900px; left:50px;}
		p.add-card{font-size:150%; color: white; position: absolute; top: 900px; left:720px; font-family: Times New Roman;}
		p.add-cardnl{font-size:150%; color: white; position: absolute; top: 990px; left:2px; font-family: Times New Roman;}
		
		#addauthor {position:absolute; top: 1050px; right:50px;}
		p.add-author{font-size:150%; color: white; position: absolute; top: 1060px; left:2px; font-family: Times New Roman;}
		
		#addentry {position:absolute; top: 1200px; left:50px;}
		p.add-entry{font-size:150%; color: white; position: absolute; top: 1200px; left:730px; font-family: Times New Roman;}
		
		#addmatch {position:absolute; top: 1320px; right:35px;}
		p.add-match{font-size:150%; color: white; position: absolute; top: 1320px; left:2px; font-family: Times New Roman;}
		
		#changedate {position:absolute; top: 1470px; left:35px;}
		p.change-date{font-size:150%; color: white; position: absolute; top: 1470px; left:510px; font-family: Times New Roman;}
		#changeven {position:absolute; top: 1570px; left:35px;}
		p.change-ven{font-size:150%; color: white; position: absolute; top: 1570px; left:440px; font-family: Times New Roman;}
		#updateteams {position:absolute; top: 1690px; left:35px;}
		p.update-teams{font-size:150%; color: white; position: absolute; top: 1690px; left:630px; font-family: Times New Roman;}
		#addven {position:absolute; top: 1470px; right:35px;}
		p.add-ven{font-size:150%; color: white; position: absolute; top: 1570px; left:1500px; font-family: Times New Roman;}
			
	</style>
</head>
<body>

<h1>Help Guide 2</h1>

<div align="left">
	<img id="addcard" src="../../assets/images/addcard.png" alt="add team" height="91" width="647">
</div>
<p class="add-card">Adding a card is usually a function that is only used when replacing a card that has been lost/stolen. When a Replacement card is issued to a Competitor, their
previous card will be set to 'Cancelled' unable to be further updated. 'Issue Number' is auto-generated depending on the Issue Number of their previous card and the 'Issue Date' will be set to the current 
System's date. A new 'Start Date' for the card will be asked with </p>
<p class="add-cardnl">the End Date being set to the default "August 6 2017". A 'Replacement Reason' will also be asked but is not required. The new issued card 
will gain validity and authorisations given that their team hasn't yet been eliminated. However, this function can also be used to issue an initial card in case the automatic issued card has been accidentally deleted.</p>

<div align="right">
	<img id="addauthor" src="../../assets/images/addauthor.png" alt="add team" height="96" width="467">
</div>
<p class="add-author">Even though most Authorisations are usually added through various other functions, the system still enables Authorisation to be manually added. The Authorisation is the joined<br/> table
between 'Cards' and 'Matches'. Because authorisations can easily be reverted back in the other tables, this function will most likely be only used
through special exceptions <br/>and occassions (For instance, authorising certain competitors through certain matches that they normally wouldn't have authorisation to). </p>

<div align="left">
	<img id="addentry" src="../../assets/images/addentry.png" alt="add team" height="99" width="659">	
</div>
<p class="add-entry">Entry Logs enables the users of the System to check whether a certain card belonging to a certain competitor should be able to enter a specified venue during a specific date.
It uses the 'Authorisation' table, to check whether the given 'entry' exists and replies with 'Access Accepted' if they do and 'Access Denied' if otherwise.</p>

<div align="right">
	<img id="addmatch" src="../../assets/images/addmatch.png" alt="add team" height="92" width="894">
</div>
<p class="add-match">Adding a match to the Competition requires a Match ID/Number to be inputted by the user. The teams that will go against each<br/>
other for this particular match will also be asked but is not initially compulsory. This enables teams to advance to further<br/> stages of the
competition giving their cards automatic authorisations without having to wait for the other team that they will go<br/> against with. Finally, a Venue and Date
for the Match will also be required.</p>

<img id="changedate" src="../../assets/images/changedate.png" alt="add team" height="86" width="449">
<p class="change-date">Changing the date for a match will require the 'Match ID' and the 'Date' to be changed into.<br/> This will also update the relevant authorisations' Valid Date
to match the corresponding changes.</p>
<img id="changeven" src="../../assets/images/changeven.png" alt="add team" height="79" width="389">
<p class="change-ven">Changing the Venue of a match will require the 'Match ID' and the 'Venue'<br/> to be changed into. Authorisations to the changed venue should automatically
be changed.</p>
<img id="updateteams" src="../../assets/images/updateteams.png" alt="add team" height="80" width="583">
<p class="update-teams">Because teams doesn't have to be initially added at the creation stage of the match,<br/> it is possible to update the teams for each match through this function.</p>
<img id="addven" src="../../assets/images/addven.png" alt="add team" height="96" width="467">
<p class="add-ven">Adding a venue will only ask for the 'Venue Name' and 'Stadium'. A unique identifier is automatically generated for every venue added.</p>
    
</body>
</html>

	<!--
	<img id="addteam" src="../../assets/images/addcard.png" alt="add team" height="91" width="647">
	<img id="addteam" src="../../assets/images/addauthor.png" alt="add team" height="96" width="467">
	<img id="addteam" src="../../assets/images/addentry.png" alt="add team" height="99" width="659">
	<img id="addteam" src="../../assets/images/addmatch.png" alt="add team" height="92" width="894">
	
	<img id="addteam" src="../../assets/images/changedate.png" alt="add team" height="86" width="894">
	<img id="addteam" src="../../assets/images/changeven.png" alt="add team" height="79" width="895">
	<img id="addteam" src="../../assets/images/updateteams.png" alt="add team" height="80" width="896">
	<img id="addteam" src="../../assets/images/addven.png" alt="add team" height="96" width="467"> -->
