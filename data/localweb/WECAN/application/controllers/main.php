<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	 
	function __construct()
	{
		parent::__construct();	 
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library('table');
	}
	
	public function index()
	{	
		$this->load->view('header');
		$this->load->view('home');
	}
	
	#----------------------------------------------------------------------------------------------------------------------------------------
	#
	#                          OUR Woment Football Association CRUD CODE BELOW (GUYS, PUT YOUR CODE IN THIS SECTION!)
	#
	#----------------------------------------------------------------------------------------------------------------------------------------
	#
	#--------------------------------------------------------
	#                   GERRON's WORK
	#--------------------------------------------------------
    public function Cards()
	{
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('card');
		$crud->set_subject('Card');
	    $crud->fields('CardID', 'CRegistrationID', 'IssueNo', 'IssueDate', 'ReplacementReason', 'StartDate', 'EndDate', 'CSCardStateID', 'Matches');
	    $crud->columns('CardID', 'CRegistrationID', 'IssueNo', 'IssueDate', 'ReplacementReason', 'StartDate', 'EndDate', 'CSCardStateID', 'Matches');
	    $crud->required_fields('CRegistrationID', 'IssueNo', 'IssueDate', 'StartDate', 'EndDate', 'CSCardStateID');
		$crud->edit_fields('CardID','CRegistrationID','ReplacementReason','StartDate', 'EndDate', 'Matches');
		//$crud->read_fields('CRegistrationID', 'IssueNo', 'IssueDate', 'StartDate', 'EndDate', 'CSCardStateID');
		$crud->set_relation('CRegistrationID', 'competitor', '{RegistrationID} - {Name} {Surname}');
		$crud->set_relation('CSCardStateID', 'card_state', 'Validity');
		$crud->set_relation_n_n('Matches', 'authorisation', 'battle', 'CCardID', 'BMatchID','{TeamCountry1} vs {TeamCountry2}');
		$crud->display_as('CardID', 'Card ID');
		$crud->display_as('IssueNo', 'Issue Number');
		$crud->display_as('IssueDate', 'Issue Date');
		$crud->display_as('ReplacementReason', 'Replacement Reason');
		$crud->display_as('StartDate', 'Start Date');
		$crud->display_as('EndDate', 'End Date');
		$crud->display_as('CRegistrationID', 'Registration ID');
		$crud->display_as('CSCardStateID', 'Card State ID');
		$crud->unset_add();

		$output = $crud->render();
	    $this->cards_output($output);
	}
	
	function cards_output($output = null) 
	{
		$this->load->view('cards_view.php', $output); 
	}
		
	public function Card_States()
	{
	   	$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('card_state');
		$crud->set_subject('Card_State');
	    $crud->fields('CardStateID','Validity');
	    $crud->required_fields('CardStateID','Validity');
	}
	
	public function Authorisations()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('authorisation');
		$crud->set_subject('Authorisation');
		$crud->fields('CCardID','BMatchID','ValidDate');
		$crud->required_fields('CCardID','BMatchID');
		$crud->set_relation('BMatchID','battle','{MatchID} - {TeamCountry1} vs {TeamCountry2}');
		$crud->set_relation('CCardID','card','{CardID} - {CRegistrationID} | {IssueNo}');
		$crud->display_as('BMatchID', 'Match ID');
		$crud->display_as('CCardID', 'Card ID');
		$crud->display_as('ValidDate', 'Valid Date');
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_read();
		//$crud->unset_delete();
		
		$output = $crud->render();
		$this->authorisations_output($output);
	}
	
	function authorisations_output($output = null) 
	{
		$this->load->view('authorisations_view.php', $output); 
	}
	
	public function EntryLogs()
	{
		//extract all data from the entrylogs table
		$result2 = mysql_query("SELECT CCardID, VVenueID, Date FROM entrylog");
		$cardsID2 = Array();
		$vensID2 = Array();
		$dates2 = Array();
     
		while ($row = mysql_fetch_array($result2, MYSQL_ASSOC))
		{
			$cardsID2[] =  $row['CCardID'];
			$vensID2[] =  $row['VVenueID'];
			$dates2[] =  $row['Date'];    
		}
     
		for ($i = 0; $i<count($cardsID2); $i++)
		{
			//check if they still have authorization when refreshed
			//extract query result for an authorisation
			$result3 = mysql_query("SELECT r.CardID Car, v.VenueID Ven, a.ValidDate Dat
									FROM competitor c, card r, authorisation a, battle b, venue v 
									WHERE c.RegistrationID = r.CRegistrationID AND
									r.CardID = a.CCardID AND
									b.MatchID = a.BMatchID AND
									v.VenueID = b.VVenueID AND
									r.CSCardStateID = 1");
			$cardsID3 = Array();
			$vensID3 = Array();
			$dates3 = Array();
			
			while ($row = mysql_fetch_array($result3, MYSQL_ASSOC))
			{
				$cardsID3[] =  $row['Car'];
				$vensID3[] =  $row['Ven'];
				$dates3[] =  $row['Dat'];
			}
			
			if (count($cardsID3)==0)
			{
				$this->db->query('UPDATE entrylog SET Access = "Access Denied" WHERE CCardID = '.$cardsID2[$i].' AND VVenueID = '.$vensID2[$i].' AND Date = "'.$dates2[$i].'"');
			}
			$aod = "Access Denied";
			
			for ($j = 0; $j<count($cardsID3); $j++)
			{
				if ($cardsID2[$i] == $cardsID3[$j] AND $vensID2[$i] == $vensID3[$j] AND $dates2[$i] == $dates3[$j])
				{
					$aod = "Access Accepted";
				}
			}
			 
			$this->db->query('UPDATE entrylog SET Access = "'.$aod.'" WHERE CCardID = '.$cardsID2[$i].' AND VVenueID = '.$vensID2[$i].' AND Date = "'.$dates2[$i].'"');
		}	 
		
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('entrylog');
		$crud->set_subject('Entry');
	    $crud->fields('CCardID','VVenueID','Date','Access');
	    $crud->required_fields('CRegistrationID','VVenueID','Date','Access');
	    $crud->set_relation('CCardID','card','{CardID} - {CRegistrationID}');
	    $crud->set_relation('VVenueID','venue','VenueName');
		$crud->display_as('CCardID', 'Card ID');
		$crud->display_as('VVenueID', 'Venue Name');
		$crud->unset_add();
		$crud->unset_edit();
		
		$output = $crud->render();
	    $this->entrylogs_output($output);
	}
	
	
	function entrylogs_output($output = null) 
	{
		$this->load->view('entrylogs_view.php', $output); 
	}
	
	
	
	#--------------------------------------------------------
	#                   SOHAIL's WORK
	#--------------------------------------------------------
		
    public function Venues()
	{
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('venue');
		$crud->set_subject('Venue');
	    $crud->fields('VenueID','VenueName', 'Stadium');
	    $crud->columns('VenueID', 'VenueName', 'Stadium');
	    $crud->required_fields('VenueID', 'VenueName', 'Stadium');
	    $crud->edit_fields('VenueID', 'VenueName', 'Stadium');
	    $crud->display_as('VenueID', 'Venue ID');
	    $crud->display_as('VenueName', 'Venue Name');
		$crud->unset_add();
		
		$output = $crud->render();
	    $this->venues_output($output);
	}
	
	function venues_output($output = null) 
	{
		$this->load->view('venues_view.php', $output); 
	}
	
	public function Matches()
	{
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('battle');
		$crud->set_subject('Match');
	    $crud->fields('MatchID','VVenueID', 'TeamCountry1', 'TeamCountry2', 'MatchDate', 'Cards');
	    $crud->required_fields('MatchID','VVenueID','MatchDate');
	    $crud->columns('MatchID', 'TeamCountry1', 'TeamCountry2', 'VVenueID', 'MatchDate','Cards');
		$crud->set_relation('VVenueID','venue','VenueName');
		$crud->edit_fields('MatchID','Cards');
		//$crud->set_relation('TeamCountry1','team','Country');
		//$crud->set_relation('TeamCountry2','team','Country');
		$crud->set_relation_n_n('Cards', 'authorisation', 'card', 'BMatchID', 'CCardID','CardID');
		$crud->display_as('MatchID', 'Match ID');
		$crud->display_as('VVenueID', 'Venue Name');
		$crud->display_as('TeamCountry1', 'Team 1');
		$crud->display_as('TeamCountry2', 'Team 2');
		$crud->display_as('MatchDate', 'Match Date');
		$crud->unset_add();
		
		$output = $crud->render();
	    $this->matches_output($output);
	}
	
	function matches_output($output = null) 
	{
		$this->load->view('matches_view.php', $output); 
	}

	#--------------------------------------------------------
	#                   MONIQUE AND RAGGAN's WORK
	#--------------------------------------------------------
	
	public function Competitors()
	{
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('competitor');
		$crud->set_subject('Competitor');
	    $crud->fields('RegistrationID', 'Name', 'Surname', 'TCountry', 'TTitleID', 'CSCompetitorStatusID','RRoleID');
	    $crud->required_fields('Name','Surname','TCountry', 'TTitleID','CSCompetitorStatusID','RRoleID');
		$crud->edit_fields('RegistrationID','Name','Surname','TCountry', 'TTitleID','RRoleID');
	    $crud->columns('RegistrationID', 'Name','Surname','TCountry', 'TTitleID','CSCompetitorStatusID','RRoleID');
		$crud->set_relation('RRoleID','role','Role');
		$crud->set_relation('TTitleID','title','Title');
		$crud->set_relation('TCountry','team','Country');
		$crud->set_relation('CSCompetitorStatusID','competitor_status','CompetitorStatus');
		$crud->display_as('RegistrationID', 'Registration ID');
		$crud->display_as('TTitleID','Title');
		$crud->display_as('RRoleID','Role');
		$crud->display_as('CSCompetitorStatusID','Competitor Status');
		$crud->display_as('TCountry', 'Country');
		$crud->unset_add();
		
		$output = $crud->render();
	    $this->competitors_output($output);
	}
	
	function competitors_output($output = null) 
	{
		$this->load->view('competitors_view.php', $output); 
	}
	
	
	public function Roles()
	{
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('role');
		$crud->set_subject('Role');
	    $crud->fields('RoleID', 'Role');
	    $crud->required_fields('RoleID', 'Role');	
	}
	
	public function Competitor_Status()
	{
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('competitor_status');
		$crud->set_subject('Competitor Status');
	    $crud->fields('CompetitorStatusID', 'CompetitorStatus');
	    $crud->required_fields('CompetitorStatusID', 'CompetitorStatus');
		$crud->display_as('CompetitorStatusID', 'Competitor Status ID ');	
	}
	
	public function Titles()
	{
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('title');
		$crud->set_subject('Title');
	    $crud->fields('TitleID', 'Title');
	    $crud->required_fields('TitleID', 'Title');

	}
	
	#--------------------------------------------------------
	#                   Abdulla's WORK
	#--------------------------------------------------------
	public function Teams()
	{
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('team');
		$crud->set_subject('Team');
	    $crud->fields('Country', 'NFA', 'Acronym', 'Nickname', 'TSTeamStatusID');
		$crud->edit_fields('Country', 'NFA', 'Acronym', 'Nickname');
	    $crud->required_fields('Country', 'NFA', 'Acronym', 'TSTeamStatusID');
		$crud->set_relation('TSTeamStatusID','team_status','TeamStatus');
		$crud->display_as('TSTeamStatusID', 'Team Status');
		$crud->unset_add();
		$output = $crud->render();
	    $this->teams_output($output);
	}
	
	function teams_output($output = null) 
	{
		$this->load->view('teams_view.php', $output); 
	}
	
	public function Team_Status()
	{
	   	$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('team_status');
		$crud->set_subject('Team_Status');
	    $crud->fields('TeamStatusID','TeamStatus');
	    $crud->required_fields('TeamStatusID','TeamStatus');
	}
	
	
#-------------------------------------------------------------------------------------------------
# EXTRA FUNCTIONS
#--------------------------------------------------------------------------------------------------
    public function ChangeCardStatus()
	{
		$cardID = $this->input->post('CardIDBox');
		$cardStatus = $this->input->post('CardStatusBox');
		
		if ($cardID != "" AND $cardStatus != "")
		{ 
			$this->db->query('UPDATE card SET CSCardStateID = "'.$cardStatus.'" WHERE CardID ="'.$cardID.'"');
			if ($cardStatus == 2 or $cardStatus == 3)
			{
				$this->db->query('DELETE FROM authorisation WHERE CCardID = "'.$cardID.'"');
			} 
			else if ($cardStatus == 1)
			{
				//set authorizations back
				$result = mysql_query("SELECT b.MatchID MatchID, b.MatchDate MatchDate
									   FROM battle b, competitor c, card r 
									   WHERE c.RegistrationID = r.CRegistrationID AND
									   (b.TeamCountry1 = c.TCountry OR b.TeamCountry2 = c.TCountry) AND
									   r.CardID ='".$cardID."'");
		        
				$matchesID = Array();
				$matchdates = Array();
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					$matchesID[] = $row['MatchID'];
					$matchdates[] = $row['MatchDate'];    
				}
				
				//-------------------------------------------------------------------
				//checks first if authorizations already exists before adding them
				//-------------------------------------------------------------------
				$foundornot = "false";
				
				for ($i = 0; $i<count($matchesID); $i++)
				{
					$result4 = mysql_query("SELECT CCardID,BMatchID,ValidDate from authorisation");
		        
					$cards2 = Array();
					$matches2 = Array();
					$dates2 = Array();
					
					while ($row = mysql_fetch_array($result4, MYSQL_ASSOC))
					{
						$cards2[] = $row['CCardID'];
						$matches2[] = $row['BMatchID']; 
						$dates2[] = $row['ValidDate'];    
					}
					
					for ($l = 0; $l<count($cards2); $l++)
					{
						if ($cards2[$l] == $cardID AND $matches2[$l] == $matchesID[$i] AND $dates2[$l] == $matchdates[$i])
						{
							$foundornot = "true";   
						}
					}	
				}
		        //---------------------------------------------------------------------------------
		        //Adds authorizations to relevant matches if the authorizations were not yet added
		        //----------------------------------------------------------------------------------
				
				if ($foundornot == "false")
				{
					for ($m = 0; $m<count($matchesID); $m++)
					{
					   $this->db->query('INSERT INTO authorisation (CCardID,BMatchID,ValidDate) 
		                                 VALUES('.$cardID.','.$matchesID[$m].',"'.$matchdates[$m].'")');
					}
				}
		
			}
		}
		else
		{
			echo "<script type='text/javascript'>alert('Make sure necessary fields are filled in.')</script>";
		}
		redirect('main/cards','refresh');
	}
		
	public function ChangeMatchDate()
	{
	    $matchID = $this->input->post('MatchIDBox');
		$date = $this->input->post('DateBox');
		$dateinval = "false";
		if ($date != "" and $matchID != "" and ($date < "2017-07-16" or $date > "2017-08-06"))
		{
			echo "<script type='text/javascript'>alert('Dates entered is invalid. The competition runs between July 16 2017 to August 6 2017.')</script>";
		}
		else if ($date != "" and $matchID != "" and ($date >= "2017-07-16" or $date <= "2017-08-06"))
		{
			$this->db->query('UPDATE battle SET MatchDate = "'.$date.'" WHERE MatchID ="'.$matchID.'"');
			$this->db->query('UPDATE authorisation SET ValidDate = "'.$date.'" WHERE BMatchID ="'.$matchID.'"');
	    }
	    else
	    {
			echo "<script type='text/javascript'>alert('Required Fields Missing.')</script>";
		}
		
		redirect('main/matches','refresh');	
	}
	
	public function ChangeMatchVenue()
	{
	    $matchID = $this->input->post('MatchIDBox');
		$venueID = $this->input->post('VenueBox');
		if ($matchID != "" and $venueID != "")
		{
			$this->db->query('UPDATE battle SET VVenueID = '.$venueID.' WHERE MatchID ="'.$matchID.'"');
	    }
	    else
	    {
			echo "<script type='text/javascript'>alert('Required Fields Missing.')</script>";
		}
		
		redirect('main/matches','refresh');
	}
	
	public function UpdateTeams()
	{
	    $matchID = $this->input->post('MatchIDTBox');
	    $team1 = $this->input->post('Team1TBox');
	    $team2 = $this->input->post('Team2TBox');
		
		if ($matchID != "")
		{
			$this->db->query('UPDATE battle SET TeamCountry1 = "'.$team1.'", TeamCountry2 = "'.$team2.'" WHERE MatchID ="'.$matchID.'"');
	    }
	    else
	    {
			echo "<script type='text/javascript'>alert('Required Fields Missing.')</script>";
		}
		
		redirect('main/matches','refresh');
	}

	
	public function AddMatch()
	{
	    $matchID = $this->input->post('MatchIDBox');
		$venue = $this->input->post('VenueBox');
		$team1 = $this->input->post('Team1Box');
		$team2 = $this->input->post('Team2Box');
		$date = $this->input->post('MatchDateBox');
			
		//----------------------------------------------------------------------
		//Check key duplication
		//------------------------------------------------------------------------
		$duplicatefound = "false";
		   
		$result3 = mysql_query("SELECT MatchID from battle");
        $dupmatchID = Array();
        
        while ($row = mysql_fetch_array($result3, MYSQL_ASSOC))
        {
            $dupmatchID[] = $row['MatchID'];   
        }
        
        for ($i = 0; $i<count($dupmatchID); $i++)
        {
			if ($dupmatchID[$i] == $matchID )
			{
				  $duplicatefound = "true";   
			}
		}
		
		$dateinvalid = "false";
		$missing = "notmissing";
		
		if ($matchID == "" and $venue == "" and $team1 == "" and $team2 == "" and $date == "")
		{
		   //do nothing and don't add it
		}
		else if ($matchID == "" or $venue == "" or $date == "")
		{
		   //set $missing to missing
		   $missing = "missing";
		}
		else if ($duplicatefound == "true")
		{
			echo "<script type='text/javascript'>alert('Duplicated keys found. Record not added.')</script>";
		}
		else if ($date < "2017-07-16" or $date > "2017-08-06")
		{	
			//set $dateinvalid to true
			$dateinvalid = "true";	   
	    }
		else
		{   
		    if ($team1 != "" or $team2 != "")
		    { 
				$this->db->query('INSERT INTO battle (MatchID,VVenueID,TeamCountry1,TeamCountry2,MatchDate) 
								  VALUES ('.$matchID.','.$venue.', "'.$team1.'","'.$team2.'","'.$date.'")');
	        }
	        else if ($team1 != "" or $team2 == "")
	        { 
				$this->db->query('INSERT INTO battle (MatchID,VVenueID,TeamCountry1,MatchDate) 
								  VALUES ('.$matchID.','.$venue.', "'.$team1.'","'.$date.'")');
	        }
	        else if ($team1 == "" or $team2 == "")
	        { 
				$this->db->query('INSERT INTO battle (MatchID,VVenueID,MatchDate) 
								  VALUES ('.$matchID.','.$venue.',"'.$date.'")');
	        }
	       
		    $result = mysql_query("SELECT r.CardID Car
		                           FROM competitor c,card r,team t
		                           WHERE c.RegistrationID = r.CRegistrationID AND
		                                 t.Country = c.TCountry AND
		                                 r.CSCardStateID = 1 AND
		                                 (t.Country = '".$team1."' OR t.Country = '".$team2."')");
            $cardsID = Array();
           
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
            {
				$cardsID[] = $row['Car'];    
            }
           
            for ($i = 0; $i<count($cardsID); $i++)
            {
				$this->db->query('INSERT INTO authorisation (CCardID,BMatchID,ValidDate) 
								  VALUES('.$cardsID[$i].','.$matchID.',"'.$date.'")');
	        }
	    }
	    
	    if ($missing == "missing")
	    {
		    echo "<script type='text/javascript'>alert('Some required fields are missing therefore they are not added to your table.')</script>";
	    }
	    else if ($dateinvalid == "true")
	    {
			echo "<script type='text/javascript'>alert('Match Date must be between July 16 2017 to August 6 2017')</script>";
		}
	    redirect('main/matches','refresh');
	}
	
	public function AddCard()
	{
		$regID = $this->input->post('RegIDBox');
		$rr = $this->input->post('RRBox');
		$startd = $this->input->post('SDBox');
		$date5 = date('Y-m-d');
		
		$missing = "notmissing";
		$invaliddate = "valid";
		$imposdate = "false";
		
		$result10 = mysql_query("SELECT r.StartDate StartDate, r.EndDate EndDate
		                         FROM card r, competitor c
		                         WHERE c.RegistrationID = r.CRegistrationID AND
		                               (r.CSCardStateID = 1 or r.CSCardStateID = 2) AND
		                               c.RegistrationID = '".$regID."'");
		$startdate = Array();
		$enddate = Array();
		    
		while ($row = mysql_fetch_array($result10, MYSQL_ASSOC))
		{
            $startdate[] = $row['StartDate'];
            $enddate[] = $row['EndDate'];
        }         
        
        $maxstartdate = "2017-07-16";
        
        for ($s = 0; $s<count($startdate); $s++)
        {
			if ($startdate[$s] > $maxstartdate)
			{
				$maxstartdate = $startdate[$s];
			}
		}
		
		if ($regID == "" and $rr == "" and $startd == "")
		{
		   //if all fields are empty, do nothing and don't add it
		}
		else if ($regID == "" or $startd == "")
		{
		   //if some fields are missing, echo error
		   echo "<script type='text/javascript'>alert('Some required fields are missing therefore they are not added to your table.')</script>";
		}
		else if ($startd < "2017-07-16" or $startd > "2017-08-06")
		{   
			//if start date isn't between the duration of the competition, echo error
			echo "<script type='text/javascript'>alert('Start Date has to be between the duration of the competition (July 16 2017 to Aug 6 2017)')</script>";
		}
		else if ($startd < $maxstartdate)
		{   
			//if start date of a replacement card is less than the start date of the current valid card, echo error
			echo "<script type='text/javascript'>alert('Date entered must be greater than start date of the current valid card.')</script>";
		}
		else
		{
		    //---------------------------------------------------------------------------------------------------
		    //insert code to invalidate and expire previous cards before replacement card is successfully added. 
		    //---------------------------------------------------------------------------------------------------
		    //--------------------------------
		    //Set Previous Cards to cancelled
		    //--------------------------------
		    $this->db->query('UPDATE card
		                      SET CSCardStateID = 3
		                      WHERE CRegistrationID IN (SELECT c.RegistrationID
		                                                FROM competitor c
		                                                WHERE c.RegistrationID = '.$regID.')');
		                                                
		    //-------------------------------------                                          
		    //Find the CardID of the card to cancel
		    //-------------------------------------
		    $result6 = mysql_query("SELECT r.CardID CardID, r.IssueNo IssueNo, r.StartDate StartDate
		                           FROM card r, competitor c
		                           WHERE c.RegistrationID = r.CRegistrationID AND
		                                 r.CSCardStateID = 3 AND
		                                 c.RegistrationID = '".$regID."'");
		    $getcard = Array();
		    $issueno = Array();
		    
		    while ($row = mysql_fetch_array($result6, MYSQL_ASSOC))
		    {
                  $getcard[] = $row['CardID'];
                  $issueno[] = $row['IssueNo'];
            }
            
            //-----------------------------                                          
		    //Cancel authorisations after.
		    //------------------------------
		    for ($i = 0; $i<count($getcard); $i++)
		    {
		       $this->db->query('DELETE FROM authorisation WHERE CCardID = '.$getcard[$i].'');
		    }
		    
		    //-----------------------------------------------
		    //Calculating next issue number
		    //----------------------------------------------
		    $previssue = 0;
		    
		    for ($i = 0; $i<count($getcard); $i++)
		    {
				if ($issueno[$i] > $previssue)
				{
					$previssue = $issueno[$i];
				}
			}
		    
		    $newissue = $previssue + 1;
		    
		    //---------------------------------------------------------------------
		    //Insert Card
		    //----------------------------------------------------------------------
		    //--------------------------------------
		    //Fetch the Competitor StatusID first
		    //----------------------------------------
		    $result = mysql_query("SELECT CSCompetitorStatusID FROM competitor WHERE RegistrationID = '".$regID."'");
		    
		    $compstat = Array();
		    
		    while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		    {
				$compstat[] = $row['CSCompetitorStatusID'];
			}
			
			if ($compstat[0] != 1)
			{
				$fetchreg = 2;
			}
			else
			{
				$fetchreg = 1;
			}
			
		    //------------------------------------------
		    //Insert New Card Information to the database
		    //-------------------------------------------
		    if ($fetchreg == 1)
		    {                                            
				$this->db->query('INSERT INTO card (CRegistrationID,IssueNo,IssueDate,ReplacementReason,StartDate,EndDate,CSCardStateID) 
						          VALUES ('.$regID.','.$newissue.',"'.$date5.'", "'.$rr.'","'.$startd.'","2017-08-06",'.$fetchreg.')');
	        }
	        else if ($fetchreg != 1 and count($startdate) != 0)
	        {
				$this->db->query('INSERT INTO card (CRegistrationID,IssueNo,IssueDate,ReplacementReason,StartDate,EndDate,CSCardStateID) 
						          VALUES ('.$regID.','.$newissue.',"'.$date5.'", "'.$rr.'","'.$startd.'","'.$enddate[0].'",'.$fetchreg.')');
		    }
		    else if ($fetchreg != 1 and count($startdate) == 0)
		    {
				$this->db->query('INSERT INTO card (CRegistrationID,IssueNo,IssueDate,ReplacementReason,StartDate,EndDate,CSCardStateID) 
						          VALUES ('.$regID.','.$newissue.',"'.$date5.'", "'.$rr.'","'.$startd.'","2017-08-06",'.$fetchreg.')');
			}
		    
		    
		    if ($fetchreg == 1)
		    {
				//-------------------------------------------------------------------------------------------------------------
				//Find the Card ID and Country of the newly added card to determine which matches they should be authorised to
				//-----------------------------------------------------------------------------------------------------------
				$result = mysql_query("SELECT r.CardID CardID, t.Country Country
									   FROM card r, competitor c, team t
									   WHERE c.RegistrationID = r.CRegistrationID AND
											t.Country = c.TCountry AND
											r.CSCardStateID = 1 AND
											c.RegistrationID = '".$regID."'");
				$countries = Array();
				$cards = Array();
		    
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					$countries[] = $row['Country'];
					$cards[] = $row['CardID'];
				}
            
				//---------------------------------------------------------------------
				//Find Matches the card should be authorised to using the found Country
				//-----------------------------------------------------------------------
                          
				$result1 = mysql_query("SELECT MatchID,MatchDate
										FROM battle
										WHERE TeamCountry1 = '".$countries[0]."' OR TeamCountry2 = '".$countries[0]."'");
				$matchID = Array();
				$matchdate = Array();
            
				while ($row = mysql_fetch_array($result1, MYSQL_ASSOC))
				{
					$matchID[] = $row['MatchID'];
					$matchdate[] = $row['MatchDate'];      
				}
            
				//------------------------
				//Add the authorisations
				//------------------------
            
				for ($i = 0; $i<count($matchID); $i++)
				{
					$this->db->query('INSERT INTO authorisation (CCardID,BMatchID,ValidDate) 
									  VALUES('.$cards[0].','.$matchID[$i].',"'.$matchdate[$i].'")'); 
				}
			}
		}
	       	
	    redirect('main/cards','refresh');
	}
	
	public function AddTeam()
	{
	    $country = $this->input->post('CountryBox');
		$nfa = $this->input->post('NFABox');
		$acro = $this->input->post('AcronymBox');
		$nick = $this->input->post('NicknameBox');
		
		//--------------------------------------
		//Check key duplication
		//--------------------------------------
		
		$duplicatefound = "false";
		   
		$result3 = mysql_query("SELECT Country from team");
        $dupcountry = Array();
        
        while ($row = mysql_fetch_array($result3, MYSQL_ASSOC))
        {
            $dupcountry[] = $row['Country'];   
        }
        
        for ($i = 0; $i<count($dupcountry); $i++)
        {
			if ($dupcountry[$i] == $country )
			{
				  $duplicatefound = "true";   
			}
		}
			
		if ($country == "" and $nfa == "" and $acro == "" and $nick == "")
		{
		   //do nothing and don't add it
		}
		else if ($country == "" or $nfa == "" or $acro == "")
		{
		    //some fields are missing error
		    echo "<script type='text/javascript'>alert('Some required fields are missing therefore they are not added to your table.')</script>";
		}
		else if ($duplicatefound == "true")
		{
			//Duplicate key error
			echo "<script type='text/javascript'>alert('Duplicated keys found. Record not added.')</script>";
		}
		else
		{
			//If all requirements are met, add the team successfully
		    $this->db->query('INSERT INTO team (Country,NFA,Acronym,Nickname,TSTeamStatusID) 
							  VALUES ("'.$country.'", "'.$nfa.'", "'.$acro.'", "'.$nick.'",1)');
	    }
		
	    redirect('main/teams','refresh');
	}
	
	public function AddVenue()
	{
	    $venue = $this->input->post('VenNameBox');
		$stadium = $this->input->post('StadiumBox');
		
		if ($venue == "" and $stadium == "")
		{
		    //do nothing and don't add it
		}
		else if ($venue == "" or $stadium == "")
		{
		    //say a message that some fields
		    echo "<script type='text/javascript'>alert('Some required fields are missing therefore they are not added to your table.')</script>";
		}
		else
		{
		    $this->db->query('INSERT INTO venue (VenueName,Stadium) 
		                      VALUES ("'.$venue.'","'.$stadium.'")');
	    }
	    
	    redirect('main/venues','refresh');
	}
	
	public function AddCompetitor()
	{
	    $namea = array("CNameBox", "CNameBox2", "CNameBox3", "CNameBox4", "CNameBox5","CNameBox6", "CNameBox7", "CNameBox8", "CNameBox9", "CNameBox10");
	    $surnamea = array("CSurnameBox", "CSurnameBox2", "CSurnameBox3", "CSurnameBox4", "CSurnameBox5","CSurnameBox6", "CSurnameBox7", "CSurnameBox8", "CSurnameBox9", "CSurnameBox10");
	    $countrya = array("CountryBox", "CountryBox2", "CountryBox3", "CountryBox4", "CountryBox5","CountryBox6", "CountryBox7", "CountryBox8", "CountryBox9", "CountryBox10");
	    $titlea = array("TitleBox", "TitleBox2", "TitleBox3", "TitleBox4", "TitleBox5","TitleBox6", "TitleBox7", "TitleBox8", "TitleBox9", "TitleBox10");
	    $rolea = array("RoleBox", "RoleBox2", "RoleBox3", "RoleBox4", "RoleBox5","RoleBox6", "RoleBox7", "RoleBox8", "RoleBox9", "RoleBox10");
	    $startda = array("SDBox","SDBox2","SDBox3","SDBox4","SDBox5","SDBox6","SDBox7","SDBox8","SDBox9","SDBox10");
	    
	    $missing = "notmissing";
	    $date = date('Y-m-d');
	    $duplicatefound = "false";
	    $invalidstart = "false";
	    	    
	    for ($k=0;$k<count($namea);$k++)
	    {
				
		    $name = $this->input->post($namea[$k]);
		    $surname = $this->input->post($surnamea[$k]);
		    $country = $this->input->post($countrya[$k]);
		    $title = $this->input->post($titlea[$k]);
		    $role = $this->input->post($rolea[$k]);
		    $startd = $this->input->post($startda[$k]);
			
			
		    
		    //------------------------------------------------------------------------------
		    //prevents registering competitors twice with the same name, surname and country
		    //-------------------------------------------------------------------------------
		   
			$result4 = mysql_query("SELECT Name,Surname,TCountry from competitor");
			$names2 = Array();
			$surnames2 = Array();
			$countries2 = Array();
           
			while ($row = mysql_fetch_array($result4, MYSQL_ASSOC)) 
			{
				$names2[] = $row['Name'];
				$surnames2[] = $row['Surname']; 
				$countries2[] = $row['TCountry'];    
			}
			
			for ($j = 0; $j<count($names2); $j++)
			{
			    if ($names2[$j] == $name AND $surnames2[$j] == $surname AND $countries2[$j] == $country)
			    {
				    $duplicatefound = "true";   
			    }
		    }
		   
		    //---------------------------
		    //Prevents invalid start date
		    //---------------------------
		    if ($startd != "" AND ($startd < "2017-07-16" or $startd > "2017-08-06"))
		    {
				$invalidstart = "true";
		    }
            //-----------------
            //check conditions
            //-----------------
		    if ($name == "" and $surname == "" and $country == "" and $title == "" and $role == "" and $startd == "")
		    {
		 		//do nothing and don't add it
		    }
		    else if ($name == "" or $surname == "" or $country == "" or $title == "" or $role == "")
		    {
				//say a message that some fields are missing. Do nothing as well
				$missing = "missing";
	        }
		    else if ($duplicatefound == "true")
		    {
				//Don't add the fields and do nothing 
		    }
		    else if ($invalidstart == "true")
		    {
				//Don't add the fields and do nothing
			}
			else
			{
				//---------------------
				//Fetch Country Status
				//---------------------
				$result7 = mysql_query("SELECT TSTeamStatusID FROM team WHERE Country = '".$country."'");
				$countrystat = Array();
           
				while ($row = mysql_fetch_array($result7, MYSQL_ASSOC)) 
				{
					$countrystat[0] = $row['TSTeamStatusID'];   
				}
			
				$fetchcompstat = $countrystat[0];	
				
				//---------------------------------------
				//Assing competitor if all conditions met
				//----------------------------------------		      
				$this->db->query('INSERT INTO competitor (Name,Surname,TCountry,TTitleID,CSCompetitorStatusID,RRoleID) 
								  VALUES ("'.$name.'", "'.$surname.'", "'.$country.'", '.$title.', '.$fetchcompstat.','.$role.')');
				
				//----------------------------------------------------------------
				//grab the assigned registrationID first before assigning a card
				//-----------------------------------------------------------
				$result3 = mysql_query("SELECT RegistrationID
										FROM competitor 
										WHERE Name = '".$name."' AND
											  Surname = '".$surname."' AND
		                                      TCountry = '".$country."' AND
		                                      TTitleID = '".$title."' AND
		                                      CSCompetitorStatusID = '".$fetchcompstat."' AND
		                                      RRoleID = '".$role."'");
				$regsID = Array();
				
				while ($row = mysql_fetch_array($result3, MYSQL_ASSOC)) 
				{
					$regsID[] = $row['RegistrationID'];    
				}
		   
				$fetchreg = $regsID[0];
				
                //-------------------------------------------------		   
				//assign the card with the fetched registration ID
				//-------------------------------------------------
				
				if ($fetchcompstat != 1)
				{
					$fetchcardstate = 2;
				}
				else
				{
					$fetchcardstate = 1;
				}
					
					
		   
				if ($startd == "")
				{
					$this->db->query('INSERT INTO card (CRegistrationID,IssueNo,IssueDate,StartDate,EndDate,CSCardStateID) 
									  VALUES ('.$fetchreg.', 1, "'.$date.'", "2017-07-16", "2017-08-06", '.$fetchcardstate.')');
				}
				else
				{
					$this->db->query('INSERT INTO card (CRegistrationID,IssueNo,IssueDate,StartDate,EndDate,CSCardStateID) 
									  VALUES ('.$fetchreg.', 1, "'.$date.'", "'.$startd.'", "2017-08-06", '.$fetchcardstate.')');
				}
		   
				//-----------------------------------------------------------------
				//grab the assigned cardID first before assigning authorisations
				//-------------------------------------------------------------
		   
				$result = mysql_query("SELECT CardID
		                               FROM card r 
		                               WHERE CSCardStateID = 1 AND CRegistrationID = '".$fetchreg."'");
				$cardsID = Array();
				
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
				{
					$cardsID[] = $row['CardID'];    
				}
               
		        //----------------------------------------------------------------------------------
				//assign authorisations with the fetched CardID for matches that their country is in.
				//-------------------------------------------------------------------------------------- 
		        
		        if (count($cardsID) != 0)
		        {                   
					$result2 = mysql_query("SELECT MatchID,MatchDate
											FROM battle
											WHERE TeamCountry1 = '".$country."' OR TeamCountry2 = '".$country."'");
					$matchID = Array();
					$matchdate = Array();
           
					while ($row = mysql_fetch_array($result2, MYSQL_ASSOC)) 
					{
						$matchID[] = $row['MatchID'];
						$matchdate[] = $row['MatchDate'];      
					}
           
					for ($i = 0; $i<count($matchID); $i++)
					{
						$this->db->query('INSERT INTO authorisation (CCardID,BMatchID,ValidDate) 
										  VALUES('.$cardsID[0].','.$matchID[$i].',"'.$matchdate[$i].'")');
					}
				}
	     
	        }
	    }
	    
		if ($missing == "missing")
		{  
		   //echo an error if fields are missing
		   echo "<script type='text/javascript'>alert('Some rows are missing required fields therefore they are not added to your table.')</script>";
	    }
	    if ($duplicatefound == "true")
	    {
			//duplicate competitor error
			echo "<script type='text/javascript'>alert('An attempt to add an existing competitor was made. This specific action is denied.')</script>";
		}
		if ($invalidstart == "true")
		{   
			//invalid date error
			echo "<script type='text/javascript'>alert('Start Date outside of July 16 2017 to August 6 2017 is detected. Specific instance is not added.')</script>";
		}
		redirect('main/competitors','refresh');
	
	}

	
	public function AddAuthorisation()
	{
	    $cardID = $this->input->post('CardIDBox2');
		$matchID = $this->input->post('MatchIDBox2');
		
		//----------------------------------------------------------------------
		//Check key duplication
		//-----------------------------
		$duplicatefound = "false";
		   
		$result3 = mysql_query("SELECT CCardID, BMatchID from authorisation");
        $dupcardsID = Array();
        $dupmatchID = Array();
        
        while ($row = mysql_fetch_array($result3, MYSQL_ASSOC)) 
        {
			$dupcardsID[] = $row['CCardID'];  
            $dupmatchID[] = $row['BMatchID'];   
        }
        for ($i = 0; $i<count($dupcardsID); $i++)
        {
			if ($dupcardsID[$i] == $cardID AND $dupmatchID[$i] == $matchID )
			{
				  $duplicatefound = "true";   
			}
		}
		
		if ($cardID == "" AND $matchID == "")
		{
			//do nothing if all fields are empty
		}
		else if ($cardID == "" OR $matchID == "")
		{
			//echo missing fields error
			echo "<script type='text/javascript'>alert('Some rows are missing required fields therefore they are not added to your table.')</script>";
		}
		else if ($duplicatefound == "true")
		{
			//echo duplicate key error
			echo "<script type='text/javascript'>alert('Duplicated keys found. Record not added.')</script>";
		}
		else
		{
			//fetch match date first before adding authorisations
		    $result = mysql_query("SELECT MatchDate
		                           FROM battle 
		                           WHERE MatchID = '".$matchID."'");
		    
		    $getmatchdate = Array();    
            
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
            {
				$getmatchdate[] = $row['MatchDate'];    
            }
            
            //insert the authorisation
		    $this->db->query('INSERT INTO authorisation (CCardID,BMatchID,ValidDate) 
		    VALUES('.$cardID.','.$matchID.',"'.$getmatchdate[0].'")');
		    
	    }

		redirect('main/authorisations','refresh');
		
	}
	
	public function CompStatus()
	{
	    $status = $this->input->post('CStatusBox');
		$regsID = $this->input->post('RegIDBox');
		$excard = $this->input->post('ExpireCardBox');
		
		$missingfields = "false";
		$requiredate = "false";
		
		//-------------------------------------------------------------------------
		//Check for missing and empty fields. Only ask for date if updating to eliminate 
		//-----------------------------------------------------------------------------
		if ($status == "" AND $regsID == "" AND $excard == "")
		{
			$missingfields = "true";
		} 
		else if ($status != 1 AND $excard == "")
		{
			$missingfields = "true";
		}
		else if ($status == "" or $regsID == "")
		{
			$missingfields = "true";
		}
		
        //-------------------------------------
        //check if date is required
        //---------------------------------
		if ($status != 1 AND $status != "" AND $regsID != "" AND $excard == "")
		{
			$requiredate = "true";
		}
		
		//--------------------------------------------------
		//Grab start date and end date from the cards table
		//--------------------------------------------------
		$result9 = mysql_query("SELECT r.StartDate, r.EndDate
		                           FROM competitor c, card r 
		                           WHERE c.RegistrationID = r.CRegistrationID AND
		                           r.CSCardStateID = 1 AND
		                           c.RegistrationID ='".$regsID."'");
		                           
		$getStartDate = Array();
		$getEndDate = Array();      
        
        while ($row = mysql_fetch_array($result9, MYSQL_ASSOC)) 
        {
            $getStartDate[] = $row['StartDate'];
            $getEndDate[] = $row['EndDate'];     
        }                  
		
		if ($missingfields == "true")
		{
			//echo error if missing fields found
			echo "<script type='text/javascript'>alert('Make sure necessary fields are filled in.')</script>";
			
			if ($requiredate == "true")
			{
				//echo error if date is required and it's not given
			    echo "<script type='text/javascript'>alert('Remember! A leaving competitor requires a date to expire their card with')</script>";
		    }	
		}
		else if ($status != 1 AND $excard != "" AND ($excard >$getEndDate[0] OR $excard<$getStartDate[0]))
		{
			//echo error if date expiration is set to an inappropriate value.
			echo "<script type='text/javascript'>alert('Date Expiration has to be set between the valid date and its current expiry date')</script>";
		}		
		else if ($status == 2 or $status == 3 or $status == 4 or $status == 5)
		{
			//invalidate card and delete authorisations
			$this->db->query('UPDATE competitor SET CSCompetitorStatusID = '.$status.' WHERE RegistrationID = "'.$regsID.'"');
			$this->db->query('UPDATE card 
			                  SET CSCardStateID = 2, EndDate = "'.$excard.'"
			                  WHERE CSCardStateID != 3 AND CRegistrationID IN (SELECT c.RegistrationID 
			                                               FROM competitor c
			                                               WHERE c.RegistrationID = "'.$regsID.'")');
			                                            
			$result1 = mysql_query("SELECT r.CardID CardID
		                           FROM competitor c, card r 
		                           WHERE c.RegistrationID = r.CRegistrationID AND
		                           c.RegistrationID ='".$regsID."'");
		    $getcardID = Array();    
            
            while ($row = mysql_fetch_array($result1, MYSQL_ASSOC)) 
            {
				$getcardID[] = $row['CardID'];    
            }
                                                       
			for($i=0;$i<count($getcardID);$i++)
			{                                            
				$this->db->query('DELETE FROM authorisation WHERE CCardID = "'.$getcardID[$i].'"');
	        }
		}
		else if ($status == 1)
		{   
			//set competitor status to 1 (valid)
			$this->db->query('UPDATE competitor SET CSCompetitorStatusID = '.$status.' WHERE RegistrationID = "'.$regsID.'"');
			
			//--------------------------------
			//Find the card ID to validate
			//---------------------------------
			$result7 = mysql_query("SELECT MAX(CardID) CardID
			                       FROM card
			                       WHERE CardID IN (SELECT r.CardID CardID
		                                            FROM competitor c, card r 
		                                            WHERE c.RegistrationID = r.CRegistrationID AND
		                                            c.RegistrationID ='".$regsID."')");
		    
		    $maxcardid = Array();
		    
		    while ($row = mysql_fetch_array($result7, MYSQL_ASSOC)) 
		    {
                $maxcardid[] = $row['CardID'];
			}
			 
			//---------------------------------------
			//Update Card Status to valid
			//----------------------------------------
			
			$this->db->query('UPDATE card 
			                  SET CSCardStateID = 1, EndDate = "2017-08-06"
			                  WHERE CSCardStateID != 3 AND CardID ='.$maxcardid[0].'');                                       
			//---------------------------                                            
			//set authorisations back
			//------------------------
			
			$result = mysql_query("SELECT r.CardID CardID, b.MatchID MatchID, b.MatchDate MatchDate
		                           FROM battle b, competitor c, card r 
		                           WHERE c.RegistrationID = r.CRegistrationID AND
		                           r.CSCardStateID = 1 AND
		                          (b.TeamCountry1 = c.TCountry OR b.TeamCountry2 = c.TCountry) AND
		                           r.CardID ='".$maxcardid[0]."'");
		    $cardsID = Array();    
            $matchesID = Array();
            $matchdates = Array();
            
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
            {
				$cardsID[] = $row['CardID'];
				$matchesID[] = $row['MatchID'];
				$matchdates[] = $row['MatchDate'];    
            }
            
            //check if already exists
            
            for ($i = 0; $i<count($matchesID); $i++)
            {
			    //----------------------------------------------------------
		        //checks first if authorizations already exists before adding them
		        //---------------------------------------------------------------
		        $result4 = mysql_query("SELECT CCardID,BMatchID,ValidDate from authorisation");
		        
                $cards2 = Array();
                $matches2 = Array();
                $dates2 = Array();
                
                while ($row = mysql_fetch_array($result4, MYSQL_ASSOC)) 
                {
                    $cards2[] = $row['CCardID'];
                    $matches2[] = $row['BMatchID']; 
                    $dates2[] = $row['ValidDate'];    
                }
                
                $foundornot = "false";
                
                for ($l = 0; $l<count($cards2); $l++)
                {
			        if ($cards2[$l] == $cardsID[$i] AND $matches2[$l] == $matchesID[$i] AND $dates2[$l] == $matchdates[$i])
			        {
				        $foundornot = "true";   
			        }
			       
		        }
		        //--------------------------------------
		        //Add authorisation if it doesn't exist yet
		        //---------------------------------------
		        if ($foundornot == "false")
		        {
					$this->db->query('INSERT INTO authorisation (CCardID,BMatchID,ValidDate) 
		                              VALUES('.$cardsID[$i].','.$matchesID[$i].',"'.$matchdates[$i].'")');
		        }
			}
		}
			
		redirect('main/competitors','refresh');
	}
	
	public function TeamStatus()
	{
	    $status = $this->input->post('TStatusBox');
		$country = $this->input->post('CountryBox');
		$excard = $this->input->post('ExpireCardBox');
		
		$missingfields = "false";
		$requiredate = "false";
		
		//---------------------------------------------------------------------------------
		//Check for missing and empty fields. Only ask for date if updating to eliminate the team 
		//-----------------------------------------------------------------------------------------
		if ($status == "" AND $country == "" AND $excard == "")
		{
			$missingfields = "true";
		} 
		else if($status != 1 AND $excard == "")
		{
			$missingfields = "true";
	    }
		else if($status == "" or $country == "")
		{
			$missingfields = "true";
		}
		
		//-----------------------------------------
		//check if date is required for elimination
		//-----------------------------------------
		if($status != 1 AND $status != "" AND $country != "" AND $excard == "")
		{
		    $requiredate = "true";
		}
		
		
		if ($missingfields == "true")
		{
			//error message if missing fields found
			echo "<script type='text/javascript'>alert('Make sure necessary fields are filled in.')</script>";
		    if ($requiredate == "true")
		    {
				//error message if date to eliminate is required and not given
			    echo "<script type='text/javascript'>alert('Remember! A leaving team requires a date to expire their cards with')</script>";
		    }	
		}	
		else if ($status != 1 AND $excard != "" AND ($excard <"2017-07-16" OR $excard>"2017-08-06"))
		{
			//error message if the date given is invalid
			echo "<script type='text/javascript'>alert('Date Expiration has to be set between the valid date and its current expiry date')</script>";
		}	
		else if ($status == 1)
		{
			//-------------------------------------------------------------------------
			//Update team status and competitor status belonging to the team to valid
			//-----------------------------------------------------------------------
			$this->db->query('UPDATE team SET TSTeamStatusID = '.$status.' WHERE Country = "'.$country.'"');	
			$this->db->query('UPDATE competitor 
			                  SET CSCompetitorStatusID = 1
			                  WHERE TCountry ="'.$country.'"');
			                  
			//----------------------------------------
			//Searching for relevant cards to validate
			//----------------------------------------                  		                                            
			$result3 = mysql_query("SELECT r.CardID CardID
		                            FROM competitor c, card r 
		                            WHERE c.RegistrationID = r.CRegistrationID AND
		                                  c.TCountry ='".$country."'");
		    $getcardID3 = Array();    
            
            while ($row = mysql_fetch_array($result3, MYSQL_ASSOC)) 
            {
				$getcardID3[] = $row['CardID'];    
            }
            
            //---------------------------------------------
			//Find out which cardIDs should be updated
			//----------------------------------------------
            for ($j = 0; $j<count($getcardID3); $j++)
            {
				
			
				$result7 = mysql_query("SELECT MAX(CardID) CardID
										FROM card
										WHERE CardID IN (SELECT r.CardID CardID
														 FROM competitor c, card r 
														 WHERE c.RegistrationID = r.CRegistrationID AND
															   c.RegistrationID  IN (SELECT c.RegistrationID
																					 FROM card r, competitor c
																					 WHERE c.RegistrationID = r.CRegistrationID AND
																						   r.CardID = '".$getcardID3[$j]."'))");
				$maxcardid = Array();
		    
				while ($row = mysql_fetch_array($result7, MYSQL_ASSOC)) 
				{
					$maxcardid[] = $row['CardID'];
				}
			 

				$this->db->query('UPDATE card 
								  SET CSCardStateID = 1, EndDate = "2017-08-06"
								  WHERE CardID = '.$maxcardid[0].'');
						  
			
				//---------------------------------------                                                                                               
				//search relevant matches to authorise in
				//-----------------------------------------
				$result4 = mysql_query("SELECT b.MatchID MatchID, b.MatchDate MatchDate
										FROM battle b, competitor c, card r 
										WHERE c.RegistrationID = r.CRegistrationID AND
											  r.CSCardStateID = 1 AND
											  (b.TeamCountry1 = c.TCountry OR b.TeamCountry2 = c.TCountry) AND
											  r.CardID ='".$maxcardid[0]."'");    
				$matchesID = Array();
				$matchdates = Array();
				
				while ($row = mysql_fetch_array($result4, MYSQL_ASSOC)) 
				{
					$matchesID[] = $row['MatchID'];
					$matchdates[] = $row['MatchDate'];    
				}
            
				for ($r = 0; $r<count($matchesID); $r++)
				{
					//----------------------------------------------------------------------
					//Check if authorisations already exist before adding them
					//-----------------------------------------------------
		      
					$result5 = mysql_query("SELECT CCardID,BMatchID,ValidDate from authorisation");
		        
					$cards2 = Array();
					$matches2 = Array();
					$dates2 = Array();
                
					while ($row = mysql_fetch_array($result5, MYSQL_ASSOC)) 
					{
						$cards2[] = $row['CCardID'];
						$matches2[] = $row['BMatchID']; 
						$dates2[] = $row['ValidDate'];   
                    }
					
					$foundornot = "false";  
					
					for ($l = 0; $l<count($cards2); $l++)
					{
						if ($cards2[$l] == $maxcardid[0] AND $matches2[$l] == $matchesID[$r] AND $dates2[$l] == $matchdates[$r])
						{
							$foundornot = "true";   
						}
					}
					//-------------------------------------------
					//add authorisation if it doesn't exist yet
					//------------------------------------------
					if ($foundornot == "false")
					{
						$this->db->query('INSERT INTO authorisation (CCardID,BMatchID,ValidDate) 
						VALUES('.$maxcardid[0].','.$matchesID[$r].',"'.$matchdates[$r].'")');
					}
				}
		              
			}
		}
		else if ($status == 2)
		{   //---------------------------------------------------------------------------
			//Update team status, relevant competitor status and card status to invalid
			//-------------------------------------------------------------------------
			$this->db->query('UPDATE team SET TSTeamStatusID = '.$status.' WHERE Country = "'.$country.'"');
			$this->db->query('UPDATE competitor 
			                  SET CSCompetitorStatusID = 2
			                  WHERE TCountry ="'.$country.'"');
			$this->db->query('UPDATE card 
			                  SET CSCardStateID = 2, EndDate = "'.$excard.'"
			                  WHERE CSCardStateID != 3 AND CRegistrationID IN (SELECT c.RegistrationID 
			                                               FROM competitor c
			                                               WHERE c.TCountry = "'.$country.'")');
			                                            
			$result1 = mysql_query("SELECT r.CardID CardID
		                            FROM competitor c, card r 
		                            WHERE c.RegistrationID = r.CRegistrationID AND
		                                  c.TCountry ='".$country."'");
		    $getcardID = Array();    
            
            while ($row = mysql_fetch_array($result1, MYSQL_ASSOC)) 
            {
				$getcardID[] = $row['CardID'];    
            }
            //-------------------------------------
            //Delete relevant authorisations
            //------------------------------------- 
            for ($i = 0; $i<count($getcardID); $i++)
            {                                                                                               
				$this->db->query('DELETE FROM authorisation WHERE CCardID = "'.$getcardID[$i].'"');  
		    }                
		}
		else if ($status == 3)
		{
			//-----------------------------------------------------------------------------------------
			//Update team status, relevant competitor status to disqualified and card status to invalid
			//-------------------------------------------------------------------------------------------
			$this->db->query('UPDATE team SET TSTeamStatusID = '.$status.' WHERE Country = "'.$country.'"');
			$this->db->query('UPDATE competitor 
			                  SET CSCompetitorStatusID = 3
			                  WHERE TCountry ="'.$country.'"');
			$this->db->query('UPDATE card 
			                  SET CSCardStateID = 2, EndDate = "'.$excard.'"
			                  WHERE CSCardStateID != 3 AND CRegistrationID IN (SELECT c.RegistrationID 
			                                               FROM competitor c
			                                               WHERE c.TCountry = "'.$country.'")');                                            
			                                            
		    $result2 = mysql_query("SELECT r.CardID CardID
		                            FROM competitor c, card r 
		                            WHERE c.RegistrationID = r.CRegistrationID AND
		                                  c.TCountry ='".$country."'");
		    $getcardID = Array();    
            
            while ($row = mysql_fetch_array($result2, MYSQL_ASSOC)) 
            {
				$getcardID2[] = $row['CardID'];    
            }
            //-----------------------------------
            //Delete relevant authorisations
            //--------------------------------- 
            for ($i = 0; $i<count($getcardID2); $i++)
            {                                                                                               
				$this->db->query('DELETE FROM authorisation WHERE CCardID = "'.$getcardID2[$i].'"'); 
			}
		      
		}
	
		redirect('main/teams','refresh');
	}
		
	public function InsertEntry()
	{
	    $cardID = $this->input->post('CardIDBox');
		$venueID = $this->input->post('VenueIDBox');
		$date2 = $this->input->post('DateBox');	 
		$missing = "notmissing";
		
		$aod = "Access Denied";
		
		//-----------------------------------------------------
        //checks if entry log is valid in the authorisation list
        //----------------------------------------------------
        $result = mysql_query("SELECT r.CardID Car, v.VenueID Ven, a.ValidDate Dat
							   FROM competitor c, card r, authorisation a, battle b, venue v 
							   WHERE c.RegistrationID = r.CRegistrationID AND
							   r.CardID = a.CCardID AND
							   b.MatchID = a.BMatchID AND
							   v.VenueID = b.VVenueID AND
							   r.CSCardStateID = 1");
        $cardsID = Array();
        $vensID = Array();
        $dates = Array();
        
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
        {
			$cardsID[] =  $row['Car'];
			$vensID[] =  $row['Ven'];
			$dates[] =  $row['Dat'];
        }
        
        for ($i = 0; $i<count($cardsID); $i++)
        {
			if ($cardID == $cardsID[$i] AND $venueID == $vensID[$i] AND $date2 == $dates[$i])
			{
				$aod = "Access Accepted";
			}
		}
		   
		if ($cardID == "" and $venueID == "" and $date2 == "")
		{
		    //If all fields are empty, do nothing and don't add it
		}
		else if ($cardID == "" or $venueID == "" or $date2 == "" or (bool)strtotime($date2) == false)
		{
			//say an error message that some fields are missing
		    echo "<script type='text/javascript'>alert('Either some fields are missing or some invalid date were entered. Data not added.')</script>";
		   
		}
		else
		{
            $this->db->query('INSERT INTO entrylog (CCardID,VVenueID,Date,Access) VALUES ("'.$cardID.'","'.$venueID.'","'.$date2.'","'.$aod.'")');
	    }
	    
	    redirect('main/entrylogs','refresh');		
	}
	

	
	public function querynav()
	{	
		$this->load->view('header');
		$this->load->view('querynav_view');
	}
	
	public function sample()
	{	
		$this->load->view('header');
		$this->load->view('sample_query');
	}
	

	public function query3()
	{	
		$this->load->view('header');
		$this->load->view('query_view3');
	}
	
	
	public function query5()
	{	
		$this->load->view('header');
		$this->load->view('query_view5');
	}
	
	public function query5_1(){
		$this->load->view('header');
		$this->load->view('query_view5');
		$cardID = $this->input->post('CardIDBox');
		$venID = $this->input->post('VenIDBox');
		$date = $this->input->post('DateBox');
		
		
		if (($cardID != "" OR $venID != "" OR $date != "") and $cardID != "" and $venID == "" and $date == "")
		{
			$tmpl = array ('table_open' => '<table class="mytable" align = "center" style="position: absolute; left: 580; right: auto; top:300px;background-color: white;
							color: black;">');
			$this->table->set_template($tmpl); 
			$this->db->query('drop table if exists temp');
			$this->db->query('create temporary table temp as 
							(SELECT c.RegistrationID,v.VenueName, c.Name, c.Surname, r.CardID,b.MatchID, CONCAT(b.TeamCountry1," vs ",b.TeamCountry2) MatchName,a.ValidDate
						     FROM competitor c,card r,authorisation a, battle b, venue v
							 WHERE c.RegistrationID = r.CRegistrationID AND
								   r.CardID = a.CCardID AND
								   b.MatchID = a.BMatchID AND
								   v.VenueID = b.VVenueID AND
								   r.CSCardStateID = 1 AND
								   r.CardID = '.$cardID.')');
			$query = $this->db->query('select * from temp;');
			echo $this->table->generate($query);
	    }
	    else if (($cardID != "" OR $venID != "" OR $date != "") and $cardID == "" and $venID != "" and $date == "")
	    {
			$tmpl = array ('table_open' => '<table class="mytable" align = "center" style="position: absolute; left: 580; right: auto; top:300px;background-color: white;
							color: black;">');
			$this->table->set_template($tmpl); 
			$this->db->query('drop table if exists temp');
			$this->db->query('create temporary table temp as 
							(SELECT c.RegistrationID,v.VenueName, c.Name, c.Surname, r.CardID,b.MatchID, CONCAT(b.TeamCountry1," vs ",b.TeamCountry2) MatchName,a.ValidDate
							FROM competitor c,card r,authorisation a, battle b, venue v
							WHERE c.RegistrationID = r.CRegistrationID AND
								  r.CardID = a.CCardID AND
								  b.MatchID = a.BMatchID AND
								  v.VenueID = b.VVenueID AND
								  r.CSCardStateID = 1 AND
								  v.VenueID = '.$venID.')');
			$query = $this->db->query('select * from temp;');
			echo $this->table->generate($query);			
	    }
	    else if (($cardID != "" OR $venID != "" OR $date != "") and $cardID != "" and $venID != "" and $date == "")	
	    {
			$tmpl = array ('table_open' => '<table class="mytable" align = "center" style="position: absolute; left: 580; right: auto; top:300px;background-color: white;
							color: black;">');
			$this->table->set_template($tmpl); 
			$this->db->query('drop table if exists temp');
			$this->db->query('create temporary table temp as 
							(SELECT c.RegistrationID,v.VenueName, c.Name, c.Surname, r.CardID,b.MatchID, CONCAT(b.TeamCountry1," vs ",b.TeamCountry2) MatchName,a.ValidDate
							FROM competitor c,card r,authorisation a, battle b, venue v
							WHERE c.RegistrationID = r.CRegistrationID AND
								  r.CardID = a.CCardID AND
								  b.MatchID = a.BMatchID AND
								  v.VenueID = b.VVenueID AND
								  r.CSCardStateID = 1 AND
							      r.CardID = '.$cardID.' AND
								  v.VenueID = '.$venID.')');
			$query = $this->db->query('select * from temp;');
			echo $this->table->generate($query);			 
	    }
	    else if (($cardID != "" OR $venID != "" OR $date != "") and $cardID == "" and $venID == "" and $date != "")
	    {
			$tmpl = array ('table_open' => '<table class="mytable" align = "center" style="position: absolute; left: 580; right: auto; top:300px;background-color: white;
							color: black;">');
			$this->table->set_template($tmpl); 
			$this->db->query('drop table if exists temp');
			$this->db->query('create temporary table temp as 
							(SELECT c.RegistrationID,v.VenueName, c.Name, c.Surname, r.CardID,b.MatchID, CONCAT(b.TeamCountry1," vs ",b.TeamCountry2) MatchName,a.ValidDate
							 FROM competitor c,card r,authorisation a, battle b, venue v
							 WHERE c.RegistrationID = r.CRegistrationID AND
								   r.CardID = a.CCardID AND
								   b.MatchID = a.BMatchID AND
								   v.VenueID = b.VVenueID AND
								   r.CSCardStateID = 1 AND
							       a.ValidDate = "'.$date.'")');
			$query = $this->db->query('select * from temp;');
			echo $this->table->generate($query);
	    }
	    else if (($cardID != "" OR $venID != "" OR $date != "") and $cardID != "" and $venID == "" and $date != "")
	    {
			$tmpl = array ('table_open' => '<table class="mytable" align = "center" style="position: absolute; left: 580; right: auto; top:300px;background-color: white;
							color: black;">');
			$this->table->set_template($tmpl); 
			$this->db->query('drop table if exists temp');
			$this->db->query('create temporary table temp as 
							(SELECT c.RegistrationID,v.VenueName, c.Name, c.Surname, r.CardID,b.MatchID, CONCAT(b.TeamCountry1," vs ",b.TeamCountry2) MatchName,a.ValidDate
							FROM competitor c,card r,authorisation a, battle b, venue v
							WHERE c.RegistrationID = r.CRegistrationID AND
								  r.CardID = a.CCardID AND
								  b.MatchID = a.BMatchID AND
								  v.VenueID = b.VVenueID AND
								  r.CSCardStateID = 1 AND
								  r.CardID = '.$cardID.' AND
								  a.ValidDate = "'.$date.'")');
			$query = $this->db->query('select * from temp;');
			echo $this->table->generate($query);			 
	    }
	    else if (($cardID != "" OR $venID != "" OR $date != "") and $cardID == "" and $venID != "" and $date != "")
	    {
			$tmpl = array ('table_open' => '<table class="mytable" align = "center" style="position: absolute; left: 580; right: auto; top:300px;background-color: white;
							color: black;">');
			$this->table->set_template($tmpl); 
			$this->db->query('drop table if exists temp');
			$this->db->query('create temporary table temp as 
							(SELECT c.RegistrationID,v.VenueName, c.Name, c.Surname, r.CardID,b.MatchID, CONCAT(b.TeamCountry1," vs ",b.TeamCountry2) MatchName,a.ValidDate
							 FROM competitor c,card r,authorisation a, battle b, venue v
							 WHERE c.RegistrationID = r.CRegistrationID AND
								   r.CardID = a.CCardID AND
								   b.MatchID = a.BMatchID AND
								   v.VenueID = b.VVenueID AND
								   r.CSCardStateID = 1 AND
								   v.VenueID = '.$venID.' AND
								   a.ValidDate = "'.$date.'")');
			$query = $this->db->query('select * from temp;');
			echo $this->table->generate($query);
	    }
	    else if (($cardID != "" OR $venID != "" OR $date != "") and $cardID != "" and $venID != "" and $date != "")
	    {
			$tmpl = array ('table_open' => '<table class="mytable" align = "center" style="position: absolute; left: 580; right: auto; top:300px;background-color: white;
							color: black;">');
			$this->table->set_template($tmpl); 
			$this->db->query('drop table if exists temp');
			$this->db->query('create temporary table temp as 
							(SELECT c.RegistrationID,v.VenueName, c.Name, c.Surname, r.CardID,b.MatchID, CONCAT(b.TeamCountry1," vs ",b.TeamCountry2) MatchName,a.ValidDate
							 FROM competitor c,card r,authorisation a, battle b, venue v
							 WHERE c.RegistrationID = r.CRegistrationID AND
								   r.CardID = a.CCardID AND
								   b.MatchID = a.BMatchID AND
								   v.VenueID = b.VVenueID AND
								   r.CSCardStateID = 1 AND
								   r.CardID = '.$cardID.' AND
								   v.VenueID = '.$venID.' AND
								   a.ValidDate = "'.$date.'")');
			$query = $this->db->query('select * from temp;');
			echo $this->table->generate($query);
	    }
	    else
	    {
			echo "<script type='text/javascript'>alert('Required fields missing')</script>";
		}
	
	}
	

	
	public function query3_1()
	{
		$this->load->view('header');
		$this->load->view('query_view3');
		$venID = $this->input->post('VenIDBox');
		$cardID = $this->input->post('CardIDBox');
		
		if (($venID != "" or $cardID != "") and $venID != "" and $cardID == "")
		{
			$tmpl = array ('table_open' => '<table class="mytable" align = "center" style="position: absolute; left: 675; right: auto; top:300px;background-color: white;
							color: black;">');
			$this->table->set_template($tmpl); 
			$this->db->query('drop table if exists temp');
			$this->db->query('create temporary table temp as 
							(SELECT c.RegistrationID, r.CardID, c.Name,c.Surname,v.VenueName Venue,Date,Access
							 FROM entrylog e, card r, venue v, competitor c
							 WHERE c.RegistrationID = r.CRegistrationID AND
								   r.CardID = e.CCardID AND
								   v.VenueID = e.VVenueID AND
								   e.VVenueID = '.$venID.')');
			$query = $this->db->query('select * from temp;');
			echo $this->table->generate($query);
	    }
	    else if (($venID != "" or $cardID != "") and $venID == "" and $cardID != "")
		{
			$tmpl = array ('table_open' => '<table class="mytable" align = "center" style="position: absolute; left: 675; right: auto; top:300px;background-color: white;
						color: black;">');
			$this->table->set_template($tmpl); 
			$this->db->query('drop table if exists temp');
			$this->db->query('create temporary table temp as 
							(SELECT c.RegistrationID, r.CardID, c.Name,c.Surname,v.VenueName Venue,Date,Access
							 FROM entrylog e, competitor c, venue v, card r
							 WHERE c.RegistrationID = r.CRegistrationID AND
								   r.CardID = e.CCardID AND
								   v.VenueID = e.VVenueID AND
								   r.CardID = '.$cardID.')');
			$query = $this->db->query('select * from temp;');
			echo $this->table->generate($query);
		}
		else if (($venID != "" or $cardID != "") and $venID != "" and $cardID != "")
		{
			$tmpl = array ('table_open' => '<table class="mytable" align = "center" style="position: absolute; left: 675; right: auto; top:300px;background-color: white;
							color: black;">');
			$this->table->set_template($tmpl); 
			$this->db->query('drop table if exists temp');
			$this->db->query('create temporary table temp as 
						    (SELECT c.RegistrationID, r.CardID, c.Name,c.Surname,v.VenueName Venue,Date,Access
							 FROM entrylog e, competitor c, venue v, card r
							 WHERE c.RegistrationID = r.CRegistrationID AND
								   r.CardID = e.CCardID AND
								   v.VenueID = e.VVenueID AND
								   r.CardID = '.$cardID.' AND
								   e.VVenueID = '.$venID.')');
			$query = $this->db->query('select * from temp;');
			echo $this->table->generate($query);
		}
        else
        {
			echo "<script type='text/javascript'>alert('Required Fields missing')</script>";
		}
	
	}
	
	public function help()
	{	
		$this->load->view('header');
		$this->load->view('help_view');
	}
	
	
	public function blank()
	{	
		$this->load->view('header');
		$this->load->view('blank_view');
	}

}
