<?php
	require_once("action/CommonAction.php");

	class HomeAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MEMBER);
		}

		protected function executeAction() {
			if (!empty($_GET["logout"])) {
                if(isset($_SESSION["key"])){
					$data = [];
					$data["key"] = $_SESSION["key"];
                    parent::callAPI("signout", $data);
                }
                session_unset();
                session_destroy();
                session_start();
				header("location:login.php");
				exit;
            }
			
			// on démarre le match en fonction du type voulu (soit PVP ou PVE)
			if(!empty($_GET["pvp"])){
				//call api
				$data = [];
				$data["type"] = "PVP";
				$data["key"] = $_SESSION["key"];
				$result = parent::callAPI("games/auto-match", $data);
				
				header("location:game.php");
                exit;
            }
            if(!empty($_GET["pve"])){
				//call api
				$data = [];
				$data["type"] = "TRAINING";
				$data["key"] = $_SESSION["key"];
				$result = parent::callAPI("games/auto-match", $data);
                header("location:game.php");
                exit;
            }
		
		}

	
	}