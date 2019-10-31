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
	
	#GUIDE IN CREATING TABLE FUNCTIONS - IF CONFUSED LOOK AT EXAMPLE FUNCTIONS BELOW!! CREATING EACH ONE OF OUR 'MAIN TABLES' REQUIRES TWO FUNCTIONS (CREATE,SHOW) BUT THE MINOR TABLES ONLY REQUIRE ONE (CREATE).
    #THIS JUST MEANS OUR MINOR TABLES WON'T BE SHOWING UP ON THE DATABASE SITE BUT WE STILL NEED TO CREATE THEM SINCE THEY ARE LINKED TO OUR MAIN TABLES. 
	#
	#//FIRST FUNCTION REQUIRED FOR THE MAIN TABLES AND MINOR TABLES
	#
	#//Basically starting your first function
	#public function 'table_name()' eg. Venues()
	#{
	#//the next three lines are basically mandatory to instantiate the table you are creating. Don't change them. Just add them at the beginning of your function
	#   $this->load->view('header');
	#   $crud = new grocery_CRUD();
	#   $crud->set_theme('datatables');
	#//Set table name	
	#   $crud->set_table('table_name'); eg. 'Venues'
	#//set an instance of a record and fields
	#   $crud->set_subject('table_instace'); eg. 'Venue'
	#   $crud->fields('field1','field2',field3'); eg. 'VenueName','Stadium'
	#   $crud->required_fields('field1','field2''); Basically, all the 'NON NULLABLE' FIELDS SHOULD GO HERE TOO
	#//setting foreign keys for one to many relationship ('this fk column','referencing table', 'column in referencing table')
    #   $crud->set_relation('Venue_VenueID','Venues','VenueID'); 
	#//setting many to many relationship tables
	#   $crud->set_relation_n_n('table_to_relateto_newname', 'join_table', 'other_parent_table', 'this fk in join table', 'other fk in join table', 'other fields from the other parent table');
	#   eg. if we're currently on creating the 'Cards' table. Linking it with 'Matches' to create the joiened table 'Authorization' would be like.. ('matches', 'authorizations', 'matches', 'issue_ID', 'match_id') 
	#//what will be displayed in the front end user '(columnname, new_column)'
	#   $crud->display_as('Venue_VenueID', 'VenueID');
	#
	#//ALWAYS ADD THIS AT THE END OF THIS FIRST FUNCTION. IT'S FOR SHOWING THE ACTUAL TABLES ON THE FRONT END. THIS IS NOT REQUIRED FOR THE MINOR TABLES
	#   $output = $crud->render();
	#   $this->'function_name_for_output'($output); eg. $this->orders_output($output);
	#//CLOSES YOUR FIRST FUNCTION
	#}
	#//SECOND FUNCTION REQUIRED FOR THE MAIN TABLES. THIS IS NOT REQUIRED FOR THE MINOR TABLES.
	#
	#//Basically starting your second function
	#function 'function_name_for_output'($output = null) #this must correspond to the name given on the line above eg. 'function orders_output($output = null)'
	#{
	#//this function links up to corresponding page in the views folder to display content for this table
	#	$this->load->view('table_name_view.php', $output); #this is basically referring to the new php file created in the views table for this specific table. DONT WORRY ABOUT CREATING THESE. I'LL DO IT MYSELF.
	#//CLOSES YOUR SECOND FUNCTION
	#}
	#
	#NOTE: One last thing. Use the same entity and field names that we have on our ERD, so they link up properly. I know some of them are a bit unconventional but we'll change them if we have to once we got everything together.
	#
	#----------------------------------------------------------------------------------------------------------------------------------------
	#
	#                          OUR Woment Football Association CRUD CODE BELOW (GUYS, PUT YOUR CODE IN THIS SECTION!)
	#
	#----------------------------------------------------------------------------------------------------------------------------------------
	
    public function Cards()
	{
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('Cards');
		$crud->set_subject('Card');
	    $crud->fields('IssueID', 'Competitor_Registration_ID', 'Issue_No', 'Issue_Date', 'ReplacementReason', 'Card_State_CS_ID');
	    $crud->required_fields('IssueID', 'Competitor_Registration_ID', 'Issue_no', 'Issue_Date', 'ReplacementReason', 'Card_State_CS_ID');
		$crud->set_relation('Competitor_Registration_ID','Competitors','Registration_ID');
		$crud->set_relation('Card_State_CS_ID','Card_States','CS_ID');
		$crud->set_relation_n_n(('Matches', 'Authorizations', 'Matches', 'Issue_ID', 'Match_ID');
		$crud->display_as('Competitor_Registration_ID', 'RegistrationID');
		$crud->display_as('Card_State_CS_ID', 'CardState');
		
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
		
		$crud->set_table('Card_States');
		$crud->set_subject('Card_State');
	    $crud->fields('CS_ID','Validity');
	    $crud->required_fields('CS_ID','Validity');
	}
	
	public function Authorizations()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('Authorizations');
		$crud->set_subject('Authorization');
		$crud->fields('Authorization_ID','Match_Match_ID','Card_Issue_ID','ValidStartDate','ExpiryDate');
		$crud->required_fields('Authorization_ID','Match_Match_ID','Card_Issue_ID','ValidStartDate','ExpiryDate');
		$crud->set_relation('Match_Match_ID','Matches','Match_ID');
		$crud->set_relation('Card_Issue_ID','Cards','Issue_ID');
		$crud->display_as('Match_Match_ID', 'MatchID');
		$crud->display_as('Card_Issue_ID', 'IssueID');
		
		$output = $crud->render();
		$this->authorizations_output($output);
	}
	
	function authorizations_output($output = null) 
	{
		$this->load->view('authorizations_view.php', $output); 
	}
	
	public function EntryLogs()
	{
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('EntryLogs');
		$crud->set_subject('Entry');
	    $crud->fields('Entry_ID','Authorization_Authorization_ID','EntryTime','ExitTime');
	    $crud->required_fields('Entry_ID','Authorization_Authorization_ID','EntryTime');
		$crud->set_relation('Authorization_Authorization_ID','Authorizations','Authorization_ID');
		$crud->display_as('Authorization_Authorization_ID', 'AuthorizationID');

		
		$output = $crud->render();
	    $this->entrylogs_output($output);
	}
	
	function entrylogs_output($output = null) 
	{
		$this->load->view('entrylogs_view.php', $output); 
	}
	
	#-------------------------------------------------------------------------------------------------------------------------
	#
	#                       GROCERY CRUD FUNCTIONS EXAMPLE BELOW
	#
	#-------------------------------------------------------------------------------------------------------------------------
	public function orders()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		//table name exact from database
		$crud->set_table('orders');
		
		//give focus on name used for operations e.g. Add Order, Delete Order
		$crud->set_subject('Order');
		$crud->fields('invoiceNo','date', 'custID', 'items');
		
		//set the foreign keys to appear as drop-down menus
		// ('this fk column','referencing table', 'column in referencing table')
		$crud->set_relation('custID','customers','custID');
		
		//many-to-many relationship with link table see grocery crud website: www.grocerycrud.com/examples/set_a_relation_n_n
		//('give a new name to related column for list in fields here', 'join table', 'other parent table', 'this fk in join table', 'other fk in join table', 'other parent table's viewable column to see in field')
		$crud->set_relation_n_n('items', 'order_items', 'items', 'invoice_no', 'item_id', 'itemDesc');
		
		//form validation (could match database columns set to "not null")
		$crud->required_fields('invoiceNo', 'date', 'custID');
		
		//change column heading name for readability ('columm name', 'name to display in frontend column header')
		$crud->display_as('custID', 'CustomerID');
		
		$output = $crud->render();
		$this->orders_output($output);
	}
	
	function orders_output($output = null)
	{
		//this function links up to corresponding page in the views folder to display content for this table
		$this->load->view('orders_view.php', $output);
	}

	public function items()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('items');
		$crud->set_subject('item');
		$crud->fields('itemID', 'itemDesc', 'orders');
		$crud->required_fields('itemID', 'itemDesc');
		$crud->set_relation_n_n('orders', 'order_items', 'orders', 'item_id', 'invoice_no', 'invoiceNo');
		$crud->display_as('itemDesc', 'Description');
		
		$output = $crud->render();
		$this->items_output($output);
	}
	
	function items_output($output = null)
	{
		$this->load->view('items_view.php', $output);
	}
	public function customers()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('customers');
		$crud->set_subject('customer');
		$crud->fields('custID', 'custName', 'custAddress', 'custTown', 'custPostcode', 'custTel', 'custEmail');
		$crud->required_fields('custID', 'custName', 'custAddress', 'custTown', 'custPostcode', 'custTel', 'custEmail');
		$crud->display_as('custID', 'CustomerID');
		$crud->display_as('custName', 'Name');
		$crud->display_as('custAddress', 'Address');
		$crud->display_as('custTown', 'Town');
		$crud->display_as('custPostcode', 'Postcode');
		$crud->display_as('custTel', 'Phone');
		$crud->display_as('custEmail', 'Email');
		
		$output = $crud->render();
		$this->cust_output($output);
	}
	
	function cust_output($output = null)
	{
		$this->load->view('cust_view.php', $output);
	}
	
	public function orderline()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('order_items');
		$crud->set_subject('order line');
		$crud->fields('invoice_no', 'item_id', 'itemQty', 'itemPrice');
		$crud->set_relation('invoice_no','orders','invoiceNo');
		//have multiple columns show in one FK column by concatenation:  www.grocerycrud.com/forums/topic/479-concatenate-two-or-more-fields-into-one-field/
		$crud->set_relation('item_id','items','{itemID} - {itemDesc}');
		$crud->required_fields('invoice_no', 'item_id', 'itemQty', 'itemPrice');
		$crud->display_as('invoice_no', 'InvoiceNo');
		$crud->display_as('item_id', 'ItemID');
		$crud->display_as('itemQty', 'Quantity');
		$crud->display_as('itemPrice', 'Price');
		
		$output = $crud->render();
		$this->orderline_output($output);
	}
	
	function orderline_output($output = null)
	{
		$this->load->view('orderline_view.php', $output);
	}
	
	public function querynav()
	{	
		$this->load->view('header');
		$this->load->view('querynav_view');
	}
		
	public function query1()
	{	
		$this->load->view('header');
		$this->load->view('query1_view');
	}
	
	public function query2()
	{	
		$this->load->view('header');
		$this->load->view('query2_view');
	}
	
	public function blank()
	{	
		$this->load->view('header');
		$this->load->view('blank_view');
	}
}
