<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
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
	function election_tally_constituency_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT constituency_name AS value,constituency_name AS label FROM polling_centers WHERE constituency_name LIKE ? ORDER BY id ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * election_tally_polling_center_option_list Model Action
     * @return array
     */
	function election_tally_polling_center_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT polling_center_name AS value,polling_center_name AS label FROM polling_centers WHERE polling_center_name LIKE ? ORDER BY id ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * election_tally_polling_station_option_list Model Action
     * @return array
     */
	function election_tally_polling_station_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT polling_station_name AS value,polling_station_name AS label FROM polling_centers WHERE polling_station_name LIKE ? ORDER BY id ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

}
