<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => '<i class="fa fa-home fa-2x"></i>'
		),
		
		array(
			'path' => 'polling_centers', 
			'label' => 'Polling Centers', 
			'icon' => '<i class="fa fa-building-o fa-2x"></i>'
		),
		
		array(
			'path' => 'election_tally', 
			'label' => 'Election Tally', 
			'icon' => '<i class="fa fa-archive fa-2x"></i>'
		),
		
		array(
			'path' => 'poll_verification', 
			'label' => 'Poll Verification', 
			'icon' => '<i class="fa fa-check-circle fa-2x"></i>'
		),
		
		array(
			'path' => 'agents', 
			'label' => 'Agents', 
			'icon' => '<i class="fa fa-suitcase fa-2x"></i>'
		),
		
		array(
			'path' => 'users', 
			'label' => 'Users', 
			'icon' => '<i class="fa fa-users fa-2x"></i>'
		)
	);
		
	
	
			public static $role = array(
		array(
			"value" => "Administrator", 
			"label" => "Administrator", 
		),
		array(
			"value" => "Verification Manager", 
			"label" => "Verification Manager", 
		),
		array(
			"value" => "Agent", 
			"label" => "Agent", 
		),);
		
			public static $elective_position = array(
		array(
			"value" => "President", 
			"label" => "President", 
		),
		array(
			"value" => "County Governor", 
			"label" => "County Governor", 
		),
		array(
			"value" => "County Senator", 
			"label" => "County Senator", 
		),
		array(
			"value" => "Member of National Assembly", 
			"label" => "Member Of National Assembly (MP)", 
		),
		array(
			"value" => "Women County Representative", 
			"label" => "Women County Representative", 
		),
		array(
			"value" => "Member of County Assembly", 
			"label" => "Member Of County Assembly (MCA)", 
		),);
		
			public static $status = array(
		array(
			"value" => "Verified", 
			"label" => "Verified", 
		),);
		
}