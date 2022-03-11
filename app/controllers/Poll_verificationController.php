<?php 
/**
 * Poll_verification Page Controller
 * @category  Controller
 */
class Poll_verificationController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "poll_verification";
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
		$fields = array("poll_verification.id", 
			"poll_verification.tally_code", 
			"election_tally.elective_position AS election_tally_elective_position", 
			"election_tally.county AS election_tally_county", 
			"election_tally.constituency AS election_tally_constituency", 
			"election_tally.polling_center AS election_tally_polling_center", 
			"election_tally.polling_station AS election_tally_polling_station", 
			"election_tally.results_form AS election_tally_results_form", 
			"election_tally.votes AS election_tally_votes", 
			"election_tally.rejected_votes AS election_tally_rejected_votes", 
			"election_tally.spoilt_votes AS election_tally_spoilt_votes", 
			"election_tally.total_votes AS election_tally_total_votes", 
			"poll_verification.status", 
			"poll_verification.user");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				poll_verification.id LIKE ? OR 
				poll_verification.tally_code LIKE ? OR 
				election_tally.id LIKE ? OR 
				election_tally.date LIKE ? OR 
				election_tally.elective_position LIKE ? OR 
				election_tally.county LIKE ? OR 
				election_tally.constituency LIKE ? OR 
				election_tally.polling_center LIKE ? OR 
				election_tally.polling_station LIKE ? OR 
				election_tally.tally_code LIKE ? OR 
				election_tally.user LIKE ? OR 
				election_tally.results_form LIKE ? OR 
				election_tally.votes LIKE ? OR 
				election_tally.rejected_votes LIKE ? OR 
				election_tally.spoilt_votes LIKE ? OR 
				election_tally.total_votes LIKE ? OR 
				poll_verification.status LIKE ? OR 
				poll_verification.user LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "poll_verification/search.php";
		}
		$db->join("election_tally", "poll_verification.tally_code = election_tally.tally_code", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("poll_verification.id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Poll Verification";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("poll_verification/list.php", $data); //render the full page
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
		$fields = array("poll_verification.id", 
			"poll_verification.tally_code", 
			"election_tally.elective_position AS election_tally_elective_position", 
			"election_tally.county AS election_tally_county", 
			"election_tally.constituency AS election_tally_constituency", 
			"election_tally.polling_center AS election_tally_polling_center", 
			"election_tally.polling_station AS election_tally_polling_station", 
			"election_tally.results_form AS election_tally_results_form", 
			"election_tally.votes AS election_tally_votes", 
			"election_tally.total_votes AS election_tally_total_votes", 
			"election_tally.rejected_votes AS election_tally_rejected_votes", 
			"election_tally.spoilt_votes AS election_tally_spoilt_votes", 
			"poll_verification.status", 
			"poll_verification.user");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("poll_verification.id", $rec_id);; //select record based on primary key
		}
		$db->join("election_tally", "poll_verification.tally_code = election_tally.tally_code", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Poll Verification";
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
		return $this->render_view("poll_verification/view.php", $record);
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
			$fields = $this->fields = array("tally_code","status","user");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
			);
			$this->sanitize_array = array(
				'tally_code' => 'sanitize_string',
				'status' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['user'] = USER_NAME;
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("poll_verification");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Poll Verification";
		$this->render_view("poll_verification/add.php");
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
		$fields = $this->fields = array("id","tally_code","status","user");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
			);
			$this->sanitize_array = array(
				'tally_code' => 'sanitize_string',
				'status' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['user'] = USER_NAME;
			if($this->validated()){
				$db->where("poll_verification.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("poll_verification");
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
						return	$this->redirect("poll_verification");
					}
				}
			}
		}
		$db->where("poll_verification.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Poll Verification";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("poll_verification/edit.php", $data);
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
		$fields = $this->fields = array("id","tally_code","status","user");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
			);
			$this->sanitize_array = array(
				'tally_code' => 'sanitize_string',
				'status' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("poll_verification.id", $rec_id);;
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
}
