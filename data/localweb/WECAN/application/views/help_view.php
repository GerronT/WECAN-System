<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1 { text-align: center; 	font-family: Chiller; color: silver; }
		#addteam {position:absolute; top: 160px; left:50px;}
		p.add-team{font-size:150%; color: white; position: absolute; top: 160px; left:880px; font-family: Times New Roman;}
		
		#updateteam {position:absolute; top: 280px; right:40px;}
		p.update-team{font-size:150%; color: white; position: absolute; top: 280px; left:2px; font-family: Times New Roman;}
		
		#addcomp {position:absolute; top: 430px; left:50px;}
		p.add-comp{font-size:150%; color: white; position: absolute; top: 430px; left:955px; font-family: Times New Roman;}
		p.add-compnl{font-size:150%; color: white; position: absolute; top: 670px; left:2pxpx; font-family: Times New Roman;}
		
		#updatecomp {position:absolute; top: 740px; right:15px;}
		p.update-comp{font-size:150%; color: white; position: absolute; top: 740px; left:2px; font-family: Times New Roman;}
		
		#addcard {position:absolute; top: 870px; left:50px;}
		p.add-card{font-size:150%; color: white; position: absolute; top: 870px; left:720px; font-family: Times New Roman;}
		p.add-cardnl{font-size:150%; color: white; position: absolute; top: 960px; left:2px; font-family: Times New Roman;}
		
		#addauthor {position:absolute; top: 1040px; right:50px;}
		p.add-author{font-size:150%; color: white; position: absolute; top: 1040px; left:2px; font-family: Times New Roman;}
		
		#addentry {position:absolute; top: 1160px; left:50px;}
		p.add-entry{font-size:150%; color: white; position: absolute; top: 1160px; left:730px; font-family: Times New Roman;}
		
		#addmatch {position:absolute; top: 1300px; right:35px;}
		p.add-match{font-size:150%; color: white; position: absolute; top: 1290px; left:2px; font-family: Times New Roman;}
		
		#changedate {position:absolute; top: 1440px; left:35px;}
		p.change-date{font-size:150%; color: white; position: absolute; top: 1440px; left:500px; font-family: Times New Roman;}
		
		#changeven {position:absolute; top: 1540px; right:830px;}
		p.change-ven{font-size:150%; color: white; position: absolute; top: 1540px; left:25px; font-family: Times New Roman;}
		
		#updateteams {position:absolute; top: 1645px; left:35px;}
		p.update-teams{font-size:150%; color: white; position: absolute; top: 1645px; left:630px; font-family: Times New Roman;}
		
		#addven {position:absolute; top: 1420px; right:35px;}
		p.add-ven{font-size:150%; color: white; position: absolute; top: 1520px; left:1400px; font-family: Times New Roman;}
		
		#authorsearch {position:absolute; top: 1745px; right:35px;}
		p.author-search{font-size:150%; color: white; position: absolute; top: 1745px; left:30px; font-family: Times New Roman;}
		#entrysearch {position:absolute; top: 1860px; left:35px;}
		p.entry-search{font-size:150%; color: white; position: absolute; top: 1860px; left:510px; font-family: Times New Roman;}
		
		body {background-image: src("../../assets/images/main-back2.jpg")
		}
			
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
their 'Card Status' will reflect the state that their team is currently in. When a competitor joins halfway through the competiton, the 'Date' field will have to be filled in so</p>
<p class="add-compnl">the 'Start Date' of their Card will reflect this. Finally, 'Authorisations' to Matches that they should be authorised to will also be automatically added given that their 
team hasn't yet been eliminated from the Competition. Adding Multiple Competitors at the same time is also made possible to increase workflow.</p>

<div align="right">
	<img id="updatecomp" src="../../assets/images/updatecomp.png" alt="add team" height="91" width="688">	
</div>
<p class="update-comp">'Competitor Status' works very similarly to 'Team Status'. However, changes and updates are only made to a specified Competitor. A <br/>Competitor Status also have more
states (In-Game, Eliminated, Disqualified, Sanction, Injured). Updating a Competitor's Status to anything<br/> but 'In-Game' will expire their card on the date given cancelling their current
authorisations. Similar to 'Team Status', this change is reversible.</p>

<div align="left">
	<img id="addcard" src="../../assets/images/addcard.png" alt="add team" height="91" width="647">
</div>
<p class="add-card">Adding a card is usually a function that is only used when replacing a card that has been lost/stolen. When a Replacement card is issued to a Competitor, their
previous card will be set to 'Cancelled' unable to be further updated. 'Issue Number' is auto-generated depending on the Issue Number of their previous card and the 'Issue Date' will be set to the current 
System's date. A new 'Start Date' for the card will be asked</p>
<p class="add-cardnl">with the End Date being set to the default "August 6 2017". A 'Replacement Reason' will also be asked but is not required. The new issued card 
will gain validity and authorisations given that their team hasn't yet been eliminated. However, this function can also be used to issue an initial card in case the automatic issued card has been accidentally deleted.</p>

<div align="right">
	<img id="addauthor" src="../../assets/images/addauthor.png" alt="add team" height="96" width="467">
</div>
<p class="add-author">Even though most Authorisations are usually added through various other functions, the system still enables Authorisation to be manually added. The Authorisation <br/>is the joined table
between 'Cards' and 'Matches'. Because authorisations can easily be reverted back in the other tables, this function will most likely be only used<br/>
through special exceptions and occassions (For instance, authorising certain competitors through certain matches that they normally wouldn't have authorisation to). </p>

<div align="left">
	<img id="addentry" src="../../assets/images/addentry.png" alt="add team" height="99" width="659">	
</div>
<p class="add-entry">Entry Logs enables the users of the System to check whether a certain card belonging to a certain competitor should be able to enter a specified venue during a specific date.
It uses the 'Authorisation' table, to check whether the given 'entry' exists and replies with 'Access Accepted' if they do and 'Access Denied' if otherwise.</p>

<div align="right">
	<img id="addmatch" src="../../assets/images/addmatch.png" alt="add team" height="92" width="894">
</div>
<p class="add-match">Adding a match to the Competition requires a Match ID/Number to be inputted by the user. The teams that will <br/>go against each
other for this particular match will also be asked but is not initially compulsory. This enables teams<br/> to advance to further stages of the
competition giving their cards automatic authorisations without having to wait<br/> for the other team that they will go against with. Finally, a Venue and Date
for the Match will also be required.</p>

<img id="changedate" src="../../assets/images/changedate.png" alt="add team" height="86" width="449">
<p class="change-date">Changing the date for a match will require the 'Match ID' and the 'Date' to be changed into.<br/> This will also update the relevant authorisations' Valid Date
to match the corresponding changes.</p>
<img id="changeven" src="../../assets/images/changeven.png" alt="add team" height="79" width="389">
<p class="change-ven">Changing the Venue of a match will require the 'Match ID' and the 'Venue'<br/> to be changed into. Authorisations to the changed venue should automatically<br/>
be changed.</p>
<img id="updateteams" src="../../assets/images/updateteams.png" alt="add team" height="80" width="583">
<p class="update-teams">Because teams doesn't have to be initially added at the creation stage of the match,<br/> it is possible to update the teams for each match through this function.</p>
<img id="addven" src="../../assets/images/addven.png" alt="add team" height="96" width="467">
<p class="add-ven">Adding a venue will only ask for the 'Venue Name' and 'Stadium'. A unique identifier is automatically generated for every venue added.</p>
  
<img id="authorsearch" src="../../assets/images/authorsearch.png" alt="add team" height="98" width="652">
<p class="author-search">The Authorisation Query made it possible to search by 'Card ID', 'Venue' and 'Date' to check for relevant authorisations. All three fields are<br/> not compulsory so it possible
to search with only specific fields filled in. For example, changing the 'Venue' field to 'Tilburg' will show all <br/>authorisations to that venue for all competitors and for all dates if the 
competitor and date field is left empty.</p>
<img id="entrysearch" src="../../assets/images/entrysearch.png" alt="add team" height="98" width="454">
<p class="entry-search">The Entry Log search enables users of the system to narrow down the search for the log entries that has been recorded by the system through Card ID and Venue. Similar
to the 'Authorisation Search', both fields doesn't have to be filled in at the same time.</p>

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
