//find new entry in card first to find the CardID
		   $max2 = 0;
		   $result2 = mysql_query("SELECT CardID from card");
		   $listcards = Array();  
		   while ($row = mysql_fetch_array($result2, MYSQL_ASSOC)) {
		   $listcards[] = $row['CardID'];   
	       }
	       
		   for ($i = 0; $i<count($listcards); $i++){
			   if ($listcards[$i] > $max2){
				   $max2 = $listcards[$i];
			   }
		   }
		     
         
		   //find Country the new added card is from using the found CardID above
		   $result1 = mysql_query("SELECT t.Country Country
		                          FROM competitor c, card r, team t
		                          WHERE c.RegistrationID = r.CRegistrationID AND
		                                t.Country = c.TCountry AND
		                                r.CardID = '.$max2.'");
		   $getcountry = Array();
		   while ($row = mysql_fetch_array($result1, MYSQL_ASSOC)) {
           $getcountry[] = $row['Country'];     
           }
           $foundcountry = $getcountry[0];
           
           //find what matches they should be assigned to and add authorisation
		     
		   $result = mysql_query("SELECT MatchID,MatchDate
		                          FROM battle
		                          WHERE TeamCountry1 = '".$foundcountry."' OR TeamCountry2 = '".$foundcountry."'");
           $matchID = Array();
           $matchdate = Array();
           while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
           $matchID[] = $row['MatchID'];
           $matchdate[] = $row['MatchDate'];      
           }
           for ($i = 0; $i<count($matchID); $i++){
		   $this->db->query('INSERT INTO authorisation (CCardID,BMatchID,ValidDate) 
		   VALUES('.$max2.','.$matchID[$i].',"'.$matchdate[$i].'")');


///

$result3 = mysql_query("SELECT RegistrationID from competitor");
           $regisID = Array();
           while ($row = mysql_fetch_array($result3, MYSQL_ASSOC)) {
           $regisID[] = $row['RegistrationID'];   
           }
           for ($i = 0; $i<count($regisID); $i++){
			   if ($regisID == $regID){
				   echo "<script type='text/javascript'>alert('Duplicate primary keys detected. Some records may not be added.')</script>";   
			   }
			   else{
