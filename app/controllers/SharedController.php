<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * users_full_names_value_exist Model Action
     * @return array
     */
	function users_full_names_value_exist($val){
		$db = $this->GetModel();
		$db->where("full_names", $val);
		$exist = $db->has("users");
		return $exist;
	}

	/**
     * users_email_value_exist Model Action
     * @return array
     */
	function users_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("users");
		return $exist;
	}

	/**
     * election_tally_county_option_list Model Action
     * @return array
     */
	function election_tally_county_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT county_name AS value,county_name AS label FROM polling_centers WHERE county_name LIKE ? ORDER BY id ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * election_tally_constituency_option_list Model Action
     * @return array
     */
	function election_tally_constituency_option_list($lookup_county){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT constituency_name AS value,constituency_name AS label FROM polling_centers WHERE county_name= ? ORDER BY id ASC" ;
		$queryparams = array($lookup_county);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * election_tally_polling_center_option_list Model Action
     * @return array
     */
	function election_tally_polling_center_option_list($lookup_constituency){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT polling_center_name AS value,polling_center_name AS label FROM polling_centers WHERE constituency_name= ? ORDER BY id ASC" ;
		$queryparams = array($lookup_constituency);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * election_tally_polling_station_option_list Model Action
     * @return array
     */
	function election_tally_polling_station_option_list($lookup_polling_center){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT polling_station_name AS value,polling_station_name AS label FROM polling_centers WHERE polling_center_name= ? ORDER BY id ASC" ;
		$queryparams = array($lookup_polling_center);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * election_tally_tally_code_value_exist Model Action
     * @return array
     */
	function election_tally_tally_code_value_exist($val){
		$db = $this->GetModel();
		$db->where("tally_code", $val);
		$exist = $db->has("election_tally");
		return $exist;
	}

	/**
     * poll_verification_election_tally_county_option_list Model Action
     * @return array
     */
	function poll_verification_election_tally_county_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT county_name AS value,county_name AS label FROM polling_centers WHERE county_name LIKE ? ORDER BY id ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * poll_verification_election_tally_constituency_option_list Model Action
     * @return array
     */
	function poll_verification_election_tally_constituency_option_list($lookup_county){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT constituency_name AS value,constituency_name AS label FROM polling_centers WHERE county_name= ? ORDER BY id ASC" ;
		$queryparams = array($lookup_county);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * poll_verification_election_tally_polling_center_option_list Model Action
     * @return array
     */
	function poll_verification_election_tally_polling_center_option_list($lookup_constituency){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT polling_center_name AS value,polling_center_name AS label FROM polling_centers WHERE constituency_name= ? ORDER BY id ASC" ;
		$queryparams = array($lookup_constituency);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * poll_verification_election_tally_polling_station_option_list Model Action
     * @return array
     */
	function poll_verification_election_tally_polling_station_option_list($lookup_polling_center){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT polling_station_name AS value,polling_station_name AS label FROM polling_centers WHERE polling_center_name= ? ORDER BY id ASC" ;
		$queryparams = array($lookup_polling_center);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * poll_verification_tally_code_value_exist Model Action
     * @return array
     */
	function poll_verification_tally_code_value_exist($val){
		$db = $this->GetModel();
		$db->where("tally_code", $val);
		$exist = $db->has("poll_verification");
		return $exist;
	}

	/**
     * agents_county_option_list Model Action
     * @return array
     */
	function agents_county_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT county_name AS value,county_name AS label FROM polling_centers ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * agents_constituency_option_list Model Action
     * @return array
     */
	function agents_constituency_option_list($lookup_county){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT constituency_name AS value,constituency_name AS label FROM polling_centers WHERE county_name= ? ORDER BY id ASC" ;
		$queryparams = array($lookup_county);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * agents_polling_center_option_list Model Action
     * @return array
     */
	function agents_polling_center_option_list($lookup_constituency){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT polling_center_name AS value,polling_center_name AS label FROM polling_centers WHERE constituency_name= ? ORDER BY id ASC" ;
		$queryparams = array($lookup_constituency);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * agents_polling_station_option_list Model Action
     * @return array
     */
	function agents_polling_station_option_list($lookup_polling_center){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT polling_station_name AS value,polling_station_name AS label FROM polling_centers WHERE polling_center_name= ? ORDER BY id ASC" ;
		$queryparams = array($lookup_polling_center);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_totalpollingstations Model Action
     * @return Value
     */
	function getcount_totalpollingstations(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM polling_centers";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_pollverification Model Action
     * @return Value
     */
	function getcount_pollverification(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM poll_verification";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_electiontally Model Action
     * @return Value
     */
	function getcount_electiontally(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM election_tally WHERE status ='Pending Verification'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
	* barchart_datasetfromconstituencytally Model Action
	* @return array
	*/
	function barchart_datasetfromconstituencytally(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT  et.constituency, SUM(et.votes) AS sum_of_votes FROM election_tally AS et GROUP BY et.constituency ORDER BY et.votes DESC";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'sum_of_votes');
		$dataset_labels =  array_column($dataset1, 'constituency');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* piechart_tallyverification Model Action
	* @return array
	*/
	function piechart_tallyverification(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT  COUNT(et.id) AS count_of_id, et.status FROM election_tally AS et GROUP BY et.status";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'count_of_id');
		$dataset_labels =  array_column($dataset1, 'status');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

}
