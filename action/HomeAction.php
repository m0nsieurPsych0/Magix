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
			
			// Vérifie si on veut déconnecter ou si la clef est expiré
			parent::checkSession($data);
			
			// on démarre le match en fonction du type voulu (soit PVP ou PVE(TRAINING) ou observe)
			if(!empty($_GET)){
				//call api
				if (isset($_GET["pvp"]) && $_SESSION["visibility"]>=VISIBILITY_MODERATOR){
					$data["type"] = "PVP";
					$result = parent::callAPI("games/auto-match", $data);
				}
				elseif (isset($_GET["pve"])){
					$data["type"] = "TRAINING";
					$result = parent::callAPI("games/auto-match", $data);
				}
				elseif (isset($_GET["observe"]) && $_SESSION["visibility"]>=VISIBILITY_MODERATOR){
					$data["username"] = $_GET["userToObserve"];
					$_SESSION["observe"] = $_GET["userToObserve"];
					$_SESSION["firstCall"] = true;
					$result = parent::callAPI("games/observe", $data);
				}
				else{
					header(HOME);
					exit;
				}
				// On vérifie si on a des erreurs retourné par l'API
				foreach (ERRORCODES as $error){
					if ($result == $error){
						$hasConnectionError = true;
						return compact("hasConnectionError", "error");
					}
				}
				// Tout va bien on démarre le mode voulu
				header(GAME);
                exit;
            }
			
			// Unset $_SESSION["observe"]
			if (!empty($_SESSION['observe']) || isset($_SESSION['observe'])){
				unset($_SESSION['observe']);
				unset($_SESSION["firstCall"]);
			}

			// Section message Système
			// On extrait nos informations
			$data["allUsers"] = false;
			$resultbrut = parent::callAPI("users-extra", $data);
			$result = $resultbrut->users;
			
			foreach($result as $content){
				if(isset($content->username)){
					if($content->username == $_SESSION["username"]){

						$info['Dernière Connexion: '] = $content->lastLogin;
						$info['Classe de Héro: '] = $content->className;
						$info['Adage: '] = $content->welcomeText;
						if($content->lastGameState == "LAST_GAME_LOST"){
							$info['Dernière Partie: '] = "Perdue";
						}
						else{
							$info['Dernière Partie: '] = "Gagnée";
						}
						$info['Parties Gagnées: '] = $content->winCount;
						$info['Parties Perdues: '] = $content->lossCount;
						$info['Trophés Actuel: '] = $content->trophies;
						$info['Meilleure Quantitée de Trophés: '] = $content->bestTrophyScore;
						return compact("info");

					}
				}
			}

		}

	
	}