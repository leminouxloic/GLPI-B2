<?php
	include_once('fonction_glpi.php');

?>
<!DOCTYPE html>
<html >
	<head>
		<?php linkCss(); ?>
		<script type="text/javascript" src="./assets/js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="./assets/js/main.js"></script>
		<title> Accueil</title>
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
				<div class="col-sm-offset-4 col-sm-5" >
					<img src="gbna_clinique.png" class="img-responsive" height="190" width="800" class="img-circle" alt="...">
				</div>
				<?php scriptHeader(); ?>
			</header>
			<section>
				<div>
<!--
					<script type="text/javascript">
					function message(){
						var msg="PBNA -> Messagerie hors service";
						console.log(msg);
						alert(msg);
						alert("COUCOU");
					}
					alert("Messagerie hors service sur tout les sites, merci de patienter");
-->



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
									<div class="col-sm-8 col-md-offset-1">
									 <div class="col-padding">

									 <p id="a" class="alert" style="font-size: 22px; font-family: helvetica; text-align: center; border: solid 2px">&#9888; <b> ';
						$script .= "$alerte";
						$script .= '<script type="text/javascript">';
						$script .="blinker('a','#e21212','#000000'); </script></b></p></div></div></div>";

						if (!empty($alerte)) {
							print($script);
						}
					?>
				<div class="container">


				    <div class="row grid-divider">

							<div class="col-sm-3 col-md-offset-1 ">
					      <div class="col-padding alert alert-info" style="height: 280px;">
					       <a href="Ticket_Intra.php"> <h3 class="alert alert-success" style="color: black;">Ouvrir un ticket</h3>
					        <img class="img-responsive" src="ticket1.png" > </a>
					      </div>
					    </div>

				    <div class="col-sm-3 ">
				      <div class="col-padding alert alert-info" style="height: 280px;">
				       <a href="demandeCompte.php"> <h3 class="alert alert-success" style="color: black;">Demande de compte</h3>
				        <img class="img-responsive" src="compte.png" >

							</a>

				      </div>
				    </div>




				    <div class="col-sm-3">
				      <div class="col-padding alert alert-info" style="height: 280px;">
				       <a href="suivi.php"> <h3 class="alert alert-success" style="color: black;">Consulter l'état de vos demandes VANLOO</h3>
				        <img class="img-responsive" src="supp1.png"> </a>
				      </div>
				    </div>
					</div>


				</div>


			</section>
			<footer>
				<?php scriptFooter(1); ?>
			</footer>
		</body>
</html>
