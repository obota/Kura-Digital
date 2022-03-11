<?php 

/**
 * Home Page Controller
 * @category  Controller
 */
class HomeController extends SecureController{
	/**
     * Index Action
     * @return View
     */
	function index(){
		if(strtolower(USER_ROLE) == 'agent'){
			$this->render_view("home/agent.php" , null , "main_layout.php");
		}
		elseif(strtolower(USER_ROLE) == 'verification manager'){
			$this->render_view("home/verification manager.php" , null , "main_layout.php");
		}
		else{
			$this->render_view("home/index.php" , null , "main_layout.php");
		}
	}
}
