<?php 
/**
 * Election_tally Page Controller
 * @category  Controller
 */
class Election_tallyController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "election_tally";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id", 
			"date", 
			"elective_position", 
			"county", 
			"constituency", 
			"polling_center", 
			"polling_station", 
			"votes", 
			"total_votes", 
			"results_form", 
			"tally_code", 
			"user", 
			"status");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				election_tally.id LIKE ? OR 
				election_tally.date LIKE ? OR 
				election_tally.elective_position LIKE ? OR 
				election_tally.county LIKE ? OR 
				election_tally.constituency LIKE ? OR 
				election_tally.polling_center LIKE ? OR 
				election_tally.polling_station LIKE ? OR 
				election_tally.votes LIKE ? OR 
				election_tally.total_votes LIKE ? OR 
				election_tally.results_form LIKE ? OR 
				election_tally.tally_code LIKE ? OR 
				election_tally.user LIKE ? OR 
				election_tally.status LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "election_tally/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("election_tally.id", ORDER_TYPE);
		}
		$allowed_roles = array ('administrator', 'verification manager');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("election_tally.user", get_active_user('full_names') );
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->election_tally_status)){
			$val = $request->election_tally_status;
			$db->where("election_tally.status", $val , "=");
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		if(	!empty($records)){
			foreach($records as &$record){
				$record['date'] = human_datetime($record['date']);
			}
		}
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Election Tally";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("election_tally/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"date", 
			"elective_position", 
			"county", 
			"constituency", 
			"polling_center", 
			"polling_station", 
			"total_votes", 
			"votes", 
			"results_form", 
			"tally_code", 
			"user", 
			"status");
		$allowed_roles = array ('administrator', 'verification manager');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("election_tally.user", get_active_user('full_names') );
		}
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("election_tally.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['date'] = human_datetime($record['date']);
			$page_title = $this->view->page_title = "View  Election Tally";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("election_tally/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("date","elective_position","county","constituency","polling_center","polling_station","votes","total_votes","results_form","tally_code","user","status");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'elective_position' => 'required',
				'county' => 'required',
				'constituency' => 'required',
				'polling_center' => 'required',
				'polling_station' => 'required',
				'votes' => 'required|numeric',
				'total_votes' => 'required|numeric',
				'results_form' => 'required',
				'tally_code' => 'required',
			);
			$this->sanitize_array = array(
				'elective_position' => 'sanitize_string',
				'county' => 'sanitize_string',
				'constituency' => 'sanitize_string',
				'polling_center' => 'sanitize_string',
				'polling_station' => 'sanitize_string',
				'votes' => 'sanitize_string',
				'total_votes' => 'sanitize_string',
				'results_form' => 'sanitize_string',
				'tally_code' => 'sanitize_string',
				'status' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['date'] = datetime_now();
$modeldata['user'] = USER_NAME;
			//Check if Duplicate Record Already Exit In The Database
			$db->where("tally_code", $modeldata['tally_code']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['tally_code']." Already exist!";
			} 
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
		//variabl;e declaration
$tallyCode  = $modeldata['tally_code'];
$votes      = $modeldata['votes'];
$totalVotes = $modeldata['total_votes'];
$status     = "Pending Verification";
//insert into poll verification
$table_data = array(
    "tally_code" => $tallyCode,
    "votes" => $votes,
    "total_votes" => $totalVotes,
    "status" => $status,
);
$db->insert("poll_verification", $table_data);
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("election_tally");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Election Tally";
		$this->render_view("election_tally/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","date","elective_position","county","constituency","polling_center","polling_station","votes","total_votes","results_form","tally_code","user","status");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'elective_position' => 'required',
				'county' => 'required',
				'constituency' => 'required',
				'polling_center' => 'required',
				'polling_station' => 'required',
				'votes' => 'required|numeric',
				'total_votes' => 'required|numeric',
				'results_form' => 'required',
				'tally_code' => 'required',
			);
			$this->sanitize_array = array(
				'elective_position' => 'sanitize_string',
				'county' => 'sanitize_string',
				'constituency' => 'sanitize_string',
				'polling_center' => 'sanitize_string',
				'polling_station' => 'sanitize_string',
				'votes' => 'sanitize_string',
				'total_votes' => 'sanitize_string',
				'results_form' => 'sanitize_string',
				'tally_code' => 'sanitize_string',
				'status' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['date'] = datetime_now();
$modeldata['user'] = USER_NAME;
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['tally_code'])){
				$db->where("tally_code", $modeldata['tally_code'])->where("id", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['tally_code']." Already exist!";
				}
			} 
			if($this->validated()){
		$allowed_roles = array ('administrator', 'verification manager');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("election_tally.user", get_active_user('full_names') );
		}
				$db->where("election_tally.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("election_tally");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("election_tally");
					}
				}
			}
		}
		$allowed_roles = array ('administrator', 'verification manager');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("election_tally.user", get_active_user('full_names') );
		}
		$db->where("election_tally.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Election Tally";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("election_tally/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id","date","elective_position","county","constituency","polling_center","polling_station","votes","total_votes","results_form","tally_code","user","status");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'elective_position' => 'required',
				'county' => 'required',
				'constituency' => 'required',
				'polling_center' => 'required',
				'polling_station' => 'required',
				'votes' => 'required|numeric',
				'total_votes' => 'required|numeric',
				'results_form' => 'required',
				'tally_code' => 'required',
			);
			$this->sanitize_array = array(
				'elective_position' => 'sanitize_string',
				'county' => 'sanitize_string',
				'constituency' => 'sanitize_string',
				'polling_center' => 'sanitize_string',
				'polling_station' => 'sanitize_string',
				'votes' => 'sanitize_string',
				'total_votes' => 'sanitize_string',
				'results_form' => 'sanitize_string',
				'tally_code' => 'sanitize_string',
				'status' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['tally_code'])){
				$db->where("tally_code", $modeldata['tally_code'])->where("id", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['tally_code']." Already exist!";
				}
			} 
			if($this->validated()){
		$allowed_roles = array ('administrator', 'verification manager');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("election_tally.user", get_active_user('full_names') );
		}
				$db->where("election_tally.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function pollverification($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"date", 
			"elective_position", 
			"county", 
			"constituency", 
			"polling_center", 
			"polling_station", 
			"tally_code", 
			"user", 
			"results_form", 
			"votes", 
			"total_votes", 
			"status");
		$allowed_roles = array ('administrator', 'verification manager');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("election_tally.user", get_active_user('full_names') );
		}
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("election_tally.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Election Tally";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("election_tally/pollverification.php", $record);
	}
}
