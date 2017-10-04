<?php
	include_once('fonction_glpi.php');

	if (!isset($_GET['empty'])) {
		session_start();
		session_unset();
		session_destroy();
	}

	session_start();

	$con=openDB();

	function convert($chaine)
{
        $chaine = str_replace("à", "&agrave",$chaine);
        $chaine = str_replace("â", "&acirc",$chaine);
        $chaine = str_replace("&quot;",'"',$chaine);
        $chaine = str_replace('<br/>','',$chaine);
        $chaine = str_replace('<br />','',$chaine);
        $chaine = str_replace("&lt;","<",$chaine);
        $chaine = str_replace("&gt;",">",$chaine);
        $chaine = str_replace("&amp;","&",$chaine);
        $chaine = str_replace("é","&eacute",$chaine);
        $chaine = str_replace("è","&egrave",$chaine);
        $chaine = str_replace("ç","&ccedil",$chaine);
        $chaine = str_replace("ö","o",$chaine);
        $chaine = str_replace("ë","&euml",$chaine);
        $chaine = str_replace("ù","&ugrave",$chaine);
        $chaine = str_replace("ê","&ecirc",$chaine);
        $chaine = str_replace("û","&ucirc",$chaine);
        $chaine = str_replace("ô","&ocirc",$chaine);
return $chaine;
}


?>
<!DOCTYPE html>
<html >
	<head>
		<?php linkCss(); ?>
		<title> Ticket </title>

		<script src="bootstrap/js/bootstrap.min.js"></script>
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
				<div class="col-sm-offset-4 col-sm-5">
					<img src="gbna_clinique.png" class="img-responsive" height="190" width="800" class="img-circle" alt="...">
				</div>
				<?php scriptHeader(); ?>
			</header>
			<section>
				<div>
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



					<!-- Debut du formulaire -->

	            		<form class="form-horizontal" role="form" method="post" action="Traitment_Intra.php" >
										<div class="col-md-offset-1 col-md-10">
	            		<?php

	            		$alerte='';
	            		if (isset($_GET['empty'])) {
		                        $alerte= '<p class="alert alert-danger" style="font-size: 18px;  text-align: center;"><b>&#9940; Vous n\'avez pas remplis tout les champs ! &#9940;</br>Merci de renseigner les champs en rouge </b> ';
	            		}

	            		print($alerte);
	            		?>
								</div>
									<div class="col-md-offset-1 col-md-10">
	            		<h1 style="text-align: center;" class="col-lg-12"><b>Demande informatique ou déclaration d'incident</b></h1>
								</div>
									<div class="col-md-offset-4 col-md-5">
	            		<h4> <span style="color: red;">*</span>  Champs obligatoires  </h4>

	            		</div>


            		<!-- NOM -->



	            		<div class="form-group">
	                    	<label for="Name" class="col-sm-4 control-label" >Nom et Prénom <span style="color: red;">*</span> : </label>
	                    	<div class="col-sm-5" >
	                        	<input type="text" <?php
														if((!isset($_SESSION['nom']) and ($_GET['empty'])=='yes') ){
															$script='style="border-color: #FF0000; box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);"';
															print($script);} ?> name="nom" id="Name" placeholder="Exemple : Duppond Jean" class="form-control"	 autofocus
														<?php if (($_GET['empty']=='yes') and (!empty($_SESSION['nom']))) {
	                        		$script= 'value="'.$_SESSION['nom'].'"';
															print($script);
	                        	} ?>>
	                    	</div>
	                	</div>

                	<!-- EMAIL  -->
									<div class="form-group">
										<div class="col-sm-6 col-sm-offset-4">
											<h3><span style="color: #c61111;">&#9888; </span><span style=" font-family: Helvetica; color: grey; font-size: 16px;"> Veuillez saisir une adresse e-mail et/ou un téléphone</span><span style="color: #c61111;"> &#9888; </span></h3>
										</div>
									</div>

	                	<div class="form-group">
	                    <label for="Name2" class="col-sm-4 control-label">Email de contact &#9993;<span style="color: red;"> * </span> : </label>
		                    <div class="col-sm-5">
		                        <input type="email"
														<?php
														if((!isset($_SESSION['courriel']) and ($_GET['empty'])=='yes') and (!isset($_SESSION['tel']))){
															$script='style="border-color: #FF0000; box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);"';
															print($script);} ?> name="courriel" id="courriel" placeholder="Exemple : jean.duppond@bordeauxnord.com" class="form-control" autofocus
														<?php if (($_GET['empty']=='yes') and (!empty($_SESSION['courriel']))) {
	                        		$script= 'value="'.$_SESSION['courriel'].'"';
															print($script);
	                        	} ?>>
		                    </div>
	                	</div>

                	<!-- TELEPHONE -->

	                <div class="form-group">
	                    <label for="telf" class="col-sm-4 control-label">Téléphone &#9742; (accessible de l'extérieur) <span style="color: red;">*</span> : </label>
		                    <div class="col-sm-5">
		                        <input type="text"
														<?php
														if(((!isset($_SESSION['tel']) and ($_GET['empty'])=='yes')) or ((!isset($_SESSION['courriel'])and ($_GET['empty'])=='yes'))){
															$script='style="border-color: #FF0000; box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);"';
															print($script);} ?> name="tel" id="tel" placeholder="Exemple: 05 57 22 58 20" class="form-control" size="10"
														<?php if (($_GET['empty']=='yes') and (!empty($_SESSION['tel']))) {
	                        		$script= 'value="'.$_SESSION['tel'].'"';
															print($script);
	                        	} ?>>
		                    </div>
	                </div>

                	<!-- SITE -->

                	<div>
	                    <div class="form-group">
	                    <label for="site" class="col-sm-4 control-label">Site &#127970; <span style="color: red;">*</span> : </label>
		                    <div class="col-sm-5">
		                        <select placeholder="exemple" class="form-control" name="site" required="yes">
		                        	<?php
		                        		$site[1]='ALIUM';
		                        		$site[2]='CARC / PSA';
		                        		$site[3]='CFPBNA';
		                        		$site[4]='COTH';
		                        		$site[5]='GIE 246';
		                        		$site[6]='EHPB';
		                        		$site[7]='GIE GBNA';
		                        		$site[8]='GIE Loghos';
		                        		$site[9]='GIE GBNA Logistics';
		                        		$site[10]='NCBA';
		                        		$site[11]='PBCA';
		                        		$site[12]='PBNA';
		                        		$site[13]='PBRD';



																$siten[1]='133';
		                        		$siten[2]='5';
		                        		$siten[3]='139';
		                        		$siten[4]='125';
		                        		$siten[5]='137';
		                        		$siten[6]='131';
		                        		$siten[7]='135';
		                        		$siten[8]='136';
		                        		$siten[9]='134';
		                        		$siten[10]='3';
		                        		$siten[11]='8';
		                        		$siten[12]='6';
		                        		$siten[13]='7';


																if ($_GET['empty']=='yes') {

																		for($i=1; $i<=13; $i++) {
																			if ($_SESSION['site']==$siten[$i]) {
																				print('<option value="'.$siten[$i].'" selected="selected">&#8226; '.$site[$i].'</option>') ;
																			}
																			else {
																				print('<option value="'.$siten[$i].'">&#8226; '.$site[$i].'</option>') ;
																			}

																		}

																}
																else {
																		for($i=1; $i<=13; $i++) {
																			if ($_GET['site']==$site[$i]) {
																				print('<option value="'.$siten[$i].'" selected="selected">&#8226; '.$site[$i].'</option>') ;
																			}
																			else {
																				print('<option value="'.$siten[$i].'">&#8226; '.$site[$i].'</option>') ;
																			}

																		}
																}
																?>
															</select>
		                    </div>
	                	</div>
	                </div>

                	<!-- SERVICE -->
                	<div>
	                    <div class="form-group">
	                    <label for="service" class="col-sm-4 control-label">Service <span style="color: red;">*</span> : </label>
		                    <div class="col-sm-5">

															<input type="text" <?php
															if((!isset($_SESSION['service']) and ($_GET['empty'])=='yes')){
																$script='style="border-color: #FF0000; box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);"';
																print($script);} ?> name="service" id="service" placeholder="Exemple: Batiment B, 3e étage Orthopédie" class="form-control" size="10"
															<?php if (($_GET['empty']=='yes') and (!empty($_SESSION['service']))) {
		                        		$script= 'value="'.$_SESSION['service'].'"';
																print($script);
		                        	} ?>>



		                    </div>
	                	</div>
	                </div>

                	<!-- IPv4 -->

		                <div class="form-group">
		                    <label for="IP" class="col-sm-4 control-label">Adresse IP : </label>
			                    <div class="col-sm-5">
			                        <input type="text-inline" name="ip" id="ip" placeholder="Exemple : 172.1.22.143" class="form-control" size="10"
															<?php if (($_GET['empty']=='yes') and (!empty($_SESSION['ip']))) {
		                        		$script= 'value="'.$_SESSION['ip'].'"';
																print($script);
		                        	} ?>>
			                    </div>
	                	</div>

                	<!-- Categorie -->

                	<div>
	                    <div class="form-group">
	                    <label for="cat" class="col-sm-4 control-label">Catégorie <span style="color: red;">*</span> : </label>
		                    <div class="col-sm-5">
		                        <select placeholder="exemple" name="cat" class="form-control" required="yes">

		                        	<?php
		                        		$inc[1]='Logiciel';
		                        		$inc[2]='Impression';
		                        		$inc[3]='Accès (Compte bloqué, réseau ralenti)';
																$inc[4]='Messagerie';
																$inc[5]='Autre';


																$dem[1]='Assistance & conseil';
																$dem[2]='Brassage';
																$dem[3]='Matériel et prêt';
																$dem[4]='Installation et mise en service';


																$numi[1]='45';
																$numi[2]='53';
																$numi[3]='55';
																$numi[4]='43';
																$numi[5]='0';


																$numd[1]='52';
																$numd[2]='40';
																$numd[3]='48';
																$numd[4]='47';



																if ($_GET['empty']=='yes') {
																		echo'<optgroup label="Incident &#8628;">';

																			for($i=1; $i<=5; $i++) {
																				if ($_SESSION['service']==$numd[$i]) {
																					print('<option value="'.$numi[$i].'" selected="selected">'.'&#8226; '.$inc[$i].'</option>') ;
																					}
																				else{

																						print('<option value="'.$numi[$i].'">'.'&#8226; '.$inc[$i].'</option>') ;


																					}
																				}
																	echo"</optgroup>";
																	echo'<optgroup label="Demande &#8628;">';

																	for($i=1; $i<=4; $i++) {
																		if ($_SESSION['service']==$numd[$i]) {
																			print('<option value="'.$numd[$i].'" selected="selected">'.'&#8226; '.$dem[$i].'</option>') ;
																		}
																		else {
																			print('<option value="'.$numd[$i].'">'.'&#8226; '.$dem[$i].'</option>') ;
																		}
																	}
																	echo"</optgroup>";
																}
																else{
																		echo'<optgroup label="Incident &#8628;">';

																			for($i=1; $i<=5; $i++) {
																			print('<option value="'.$numi[$i].'">'.'&#8226; '.$inc[$i].'</option>') ;
																			}
																		echo"</optgroup>";
																		echo'<optgroup label="Demande &#8628;">';

																			for($i=1; $i<=4; $i++) {
																			print('<option value="'.$numd[$i].'">'.'&#8226; '.$dem[$i].'</option>') ;
																			}
																		echo"</optgroup>";
																}

																?>

														</select>

		                    </div>
	                	</div>
	                </div>


                	<!-- Sous Categorie -->

        <!--        	<div>
	                    <div class="form-group">
	                    <label for="sous-cat" class="col-sm-4 control-label">Sous-catégorie : </label>
		                    <div class="col-sm-5">
		                        <select placeholder="exemple" name="souscat"  class="form-control" required="yes">

		                        	<?php $commment = true;
															/*
		                        		$site[1]='Application de messagerie';
		                        		$site[2]='Onco';
		                        		$site[3]='CME';
		                        		$site[4]='COTH';
		                        		$site[5]='CSLO';
		                        		$site[6]='EHPB';
		                        		$site[7]='GIE GBNA';
		                        		$site[8]='Loghos';
		                        		$site[9]='Logistics';
		                        		$site[10]='NCBA';
		                        		$site[11]='PBCA';
		                        		$site[12]='PBNA';
		                        		$site[13]='PBRD';

																for($i=1; $i<=13; $i++) {
																print('<option value="'.$site[$i].'">'.$site[$i].'</option>') ;
																}
																*/ ?>
															</select>

		                    </div>
	                	</div>
	                </div>
					-->

                	<!-- Impact -->

                	<div class="form-group">
	                	<div class="col-sm-4 control-label">
	                		<label> Qui est concerné par l'incident ? </label>
	                	</div>
                		<div class="col-sm-offset-0 control-label radio-inline" name="impact">

									<small style="color: grey; font-family: Arial black;"></small>
								  <label class="radio-inline" style="color: green;"><input type="radio" name="impact" value="1" checked="checked">Personnel</label>
								  <label class="radio-inline" style="color: orange;"><input type="radio" name="impact" value="3">Service</label>
								  <label class="radio-inline" style="color: red;"><input type="radio" name="impact" value="5" >Site</label>


						</div>
					</div>

<!--  active == no
                	Urgence
                	<div class="form-group">
	                	<div class="col-sm-1 col-sm-offset-3 control-label">
	                		<label> Urgence : </label>
	                	</div>
                		<div class="col-sm-offset-1 control-label radio-inline">


								  <label class="radio-inline" style="color: red;"><input type="radio" name="urgence" value="4">Oui</label>





								  <label class="radio-inline" style="color: green;"><input type="radio" name="urgence" checked="checked" value="2">Non</label>

						</div>
					</div>
-->


                	<!-- Objet -->
                	<div class="form-group">
	                	<div class="col-sm-4 control-label">
		                    <label for="objet">Objet <span style="color: red;">*</span> : </label>
		                </div>
			                    <div class="col-sm-5">
			                        <input type="text"
															<?php
															if((!isset($_SESSION['objet']) and ($_GET['empty'])=='yes') ){
																$script='style="border-color: #FF0000; box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);"';
																print($script);} ?> name="objet" id="objet" placeholder="Exemple: Ouverture de session" class="form-control" autofocus
															<?php if (($_GET['empty']=='yes') and (!empty($_SESSION['objet']))) {
		                        		$script= 'value="'.$_SESSION['objet'].'"';
																print($script);
		                        	} ?>>
			                    </div>


		            </div>

                	<!-- Message -->
                	<div class="col-sm-offset-4 col-sm-5">
	                	<div class="form-group">
		                	<div>
												<label for="comment" class="control-label" style="color: grey;">Veuillez préciser votre demande <span style="color: red;">*</span> : </label>
											</div>
							<textarea class="form-control"
							<?php
							if((!isset($_SESSION['message']) and ($_GET['empty'])=='yes') ){
								$script='style="border-color: #FF0000; box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);"';
								print($script);} ?> rows="5" name="message" id="comment" placeholder="Exemple :

Suite à un redémarage intempestif, impossible d'ouvrir à nouveau une session"><?php if (($_GET['empty']=='yes') and (!empty($_SESSION['message']))) {
	$script= $_SESSION['message'];
	print($script);
} ?></textarea>
						</div>
					</div>

            		<!-- Fin du formulaire -->
            		<div class="form-group">
	                    <div class="col-md-3 col-md-offset-5">
	                        <button type="submit" class="btn btn-primary btn-block" style="font-family: Helvetica;" ><b>Envoyer  &#10003;</b></button>
												</div>
										</div>

									</form>
									<form class="form-horizontal" role="form" method="post" action="Ticket_Intra.php" >
										<div class="form-group">
			                    <div class="col-md-3 col-md-offset-5">

	                        <button type="submit" class="btn btn-danger btn-block " style="font-family: Helvetica;"><b>Annuler &#10007;</b></button>
												</div>
										</div>

									</form>


        		</div>
    		</section>
			<footer>
				<?php scriptFooter(2); ?>
				<?php CloseDB($con); ?>
			</footer>
			
		</body>

</html>
