<!DOCTYPE html>
	<html lang="en">
		<head>
			<!-- Global -->
			<meta charset="UTF-8">	
			<!-- <script src="js/js.js"></script> -->
			<link href="css/global.css" rel="stylesheet" />
			
			<!-- Specific -->
			<?php
				if ($page == "index"){
					?>
						<link href="css/index.css" rel="stylesheet" />
						<script src="js/index.js"></script>
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
						<script src="js/home.js"></script>
						<title>__Home__|\/|agix__OS</title>
					<?php	
				}				
				
			?>	
			
				
		</head>
		<body>
			<header>
			<?php
				if ($page == "index"){
					?>
					<div class="rotate">|\/|agix__OS</div><?php
				}
				else {
					?><div class="typing">|\/|agix__OS_______________________________________________________________________________________________________________________________________________________________</div><?php
				}
				?>
			</header>