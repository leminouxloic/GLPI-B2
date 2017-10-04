<?php
	include_once('fonction_glpi.php');
?>
<!DOCTYPE html>
<html >
	<head>
		<?php

			linkCss();

		?>
		<title> Demande valide </title>
		<script type="text/javascript">
		function blinker(id,c1,c2)
		{
		       elm = document.getElementById(id);
		       setTimeout(function() {setInterval(function () {elm.style.color=c1;},1000);},500);
		       setInterval(function () {elm.style.color=c2;},1000);
		}
		</script>
	</head>
		<body >



			<header>
				<div class="col-md-offset-3 col-md-6">
					<img src="gbna_clinique.png" class="img-responsive" height="190" width="800" class="img-circle" alt="...">
				</div>
				<?php scriptHeader(); ?>
			</header>
			<section>
				<?php /*   SEND MAIL via MAILUTILS
          $courriel = 'support.informatique@bordeauxnord.com';
          $message = 'Coucou ';
          $objet = 'GLPI ouverture';
          shell_exec('echo"'.$message.'\nObjet:'.$objet.'\n\nAdresse mail :'.$courriel.'" | mail -s "'.'[GLPI] Ouverture de ticket'.'" -t loic.lm17@gmail.com -a From:support.informatique@bordeauxnord.com');
          */
          $monfichier = fopen('alerte.txt', 'r+');

          fseek($monfichier, 0);

          $ligne = fgets($monfichier);

          $alerte = $ligne;

          fclose($monfichier);


					$script ='	<div class="container">
								<div class="col-sm-8 col-md-offset-2">
								 <div class="col-padding">

								 <p id="a" class="alert" style="font-size: 22px; font-family: helvetica; text-align: center; border: solid 2px">&#9888; <b> ';
					$script .= "$alerte";
					$script .= '<script type="text/javascript">';
					$script .="blinker('a','#e21212','#000000'); </script></b></p></div></div></div>";
          if (!empty($alerte)) {
            print($script);
          }
        ?>
				<div>
					<div class="col-sm-offset-3 col-sm-6 text-area" style="background-color: #d1d1d1; border-radius: 3px;">
						<h1>
							En cas d'urgence, vous pouvez contacter directement le responsable du support informatique
						</h1>

					</div>
					<div class="col-sm-offset-4 col-sm-4">
					<h1>_____________________</h1>

						<h2><b>Soben Chhem </b></br>Port. 0650401235 </br>Tel. 0545845613 </br> <a href="mailto:soben.chhem@bordeauxnord.com"> soben.chhem@bordeauxnord.com </a></h2>
						<h1>_____________________</h1>
					</div>

				</div>
			</section>

			<footer>
				<?php scriptFooter(1); ?>
			</footer>
		</body>
</html>
