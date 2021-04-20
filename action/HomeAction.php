<?php
	require_once("action/CommonAction.php");

	class HomeAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MEMBER);
		}
		
		protected function executeAction() {
			$hasConnectionError = false;
			$data = [];
			$data["key"] = $_SESSION["key"];

			parent::checkSession($data);
			
			// on démarre le match en fonction du type voulu (soit PVP ou PVE(TRAINING))
			if(!empty($_GET)){
				//call api
				if (isset($_GET["pvp"])){
					$data["type"] = "PVP";
				}
				else {
					$data["type"] = "TRAINING";
				}

				$result = parent::callAPI("games/auto-match", $data);

				foreach (ERRORCODES as $error){
					if ($result == $error){
						return compact("hasConnectionError", "error");
					}
				}
				
				$_SESSION["gameType"] = $result;
				header(GAME);
                exit;
            }

		}

	
	}