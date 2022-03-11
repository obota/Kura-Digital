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
     * getcount_verifiedvotingtally Model Action
     * @return Value
     */
	function getcount_verifiedvotingtally(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM poll_verification WHERE status = 'Verified'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_unverifiedvotingtally Model Action
     * @return Value
     */
	function getcount_unverifiedvotingtally(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM poll_verification WHERE status ='Pending Verification'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
