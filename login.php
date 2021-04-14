<?php
    require_once("action/LoginAction.php");

    $action = new LoginAction();
    $data = $action->execute();
	$page = "login";
    require_once("partial/header.php");
?>
			<main>
				<div class="login-form-frame">
					<!-- autocomplete à «off» pour simuler une fenêtre de terminal -->
					<form action="login.php" method="post" autocomplete="off"> 
						<?php
							// if ($data["hasConnectionError"]){
								?>
								<!-- <div class="error-div"> Erreur de connexion </div> -->
								<?php
							// }
						?>

						<div class="form-label">
							<label for="username">Nom d'usager : </label>
						</div>

						<div class="form-input">
							<input type="text" name="username" id="username" />
						</div>
						<div class="form-separator"></div>

						<div class="form-label">
							<label for="password">Mot de passe : </label>
						</div>
						
						<div class="form-input">
							<input type="password" name="pwd" id="password" />
						</div>
						<div class="form-separator"></div>

						<div class="form-input">
							<button type="submit"></button>
						</div>
						<div class="form-separator"></div>
						
					</form>
				</div>
				
			</main>
		

<?php
	require_once("partial/footer.php");   

