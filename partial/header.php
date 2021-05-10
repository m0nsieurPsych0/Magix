<!DOCTYPE html>
	<html lang="fr">
		<head>
			<!-- Global -->
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link href="css/global.css" rel="stylesheet" />
			
			<!-- Specific -->
			<?php
				if ($page == "booting"){
					?>
						<link href="css/booting.css" rel="stylesheet" />
						<script src="js/booting.js"></script>
						<title>__Booting__|\/|agix__OS</title>
					<?php	
				}
				if ($page == "index"){
					?>
						<link href="css/index.css" rel="stylesheet" />
						<script src="js/index.js"></script>
						<script src="js/screenSaver.js"></script>
						<title>__ScreenSaver__|\/|agix__OS</title>
					<?php	
				}
				if ($page == "login"){
					?>
						<link href="css/login.css" rel="stylesheet" />
						<script src="js/screenSaver.js"></script>
						<script src="js/login.js"></script>
						<title>__Login__|\/|agix__OS</title>
					<?php	
				}
				if ($page == "home"){
					?>
						<link href="css/home.css" rel="stylesheet" />
						<script src="js/screenSaver.js"></script>
						<script src="js/chat.js"></script>
						<script src="js/home.js"></script>
						<title>__Home__|\/|agix__OS</title>
					<?php	
				}
				if ($page == "deckMaster"){
					?>
						<link href="css/deckMaster.css" rel="stylesheet" />
						<script src="js/screenSaver.js"></script>
						<title>__Deck_Master__|\/|agix__OS</title>
					<?php	
				}
				if ($page == "game"){
					?>
						<link href="css/game.css" rel="stylesheet" />
					<!-- GAME BACKGROUND -->
						<script src="js/Gamebackground/assets/utils.js"></script>
						<script src="js/Gamebackground/dist/gameBackground.js"></script>
					<!-- GAME BACKGROUND -->
						<script src="js/chat.js"></script>
						<script src="js/game.js"></script>
						<title>__Game__|\/|agix__OS</title>
					<?php	
				}
				if ($page == "guide"){
					?>
						<link href="css/guide.css" rel="stylesheet" />
						<!-- <script src="js/screenSaver.js"></script> -->
						<script src="js/guide.js"></script>
						<title>__Guide__|\/|agix__OS</title>
					<?php	
				}							
				
			?>	
				
		</head>
		<body>
			<header>
			<?php
				if ($page == "index"){
					?><div class="rotate">|\/|agix__OS</div><?php
				}
				elseif ($page == "game"){
					?><?php
				}
				elseif ($page == "deckMaster"){
					?><div class="typing">Deck_M4st3r________________________________________________________________________________________________________________________________________________________________</div><?php
				}
				elseif ($page == "booting"){
					?><?php
				}
				elseif ($page == "guide"){
					?><div class="typing">Guide_Str4tégiqu3________________________________________________________________________________________________________________________________________________________________</div><?php
				}
				else {
					?><div class="typing">|\/|agix__OS_______________________________________________________________________________________________________________________________________________________________</div><?php
				}
				?>
			</header>