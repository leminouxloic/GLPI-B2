<?php
	include_once('fonction_glpi.php');

	session_destroy();
	session_start();


	$con=openDB();


	$lienmot = strtr($mot, "àâäçéèêëîïùüû", "aaaceeeeiiuuu");
	$lienmot = strtr($lienmot, "\'", "-");
	$lienmot = strtr($lienmot, "\'", "-");
	$lienmot = strtr($lienmot, "\’", "-");
	$lienmot = strtr($lienmot, "\’ ", "-");

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
		<?php

		# vérification du formulaire

		# phone number checking then mail checking

				$check = True;
				$checknom = (!empty($_POST['nom']));

				if ($_POST['tel']!='') {
					$lentel = strlen($_POST['tel']);
					if ($lentel>='4') {
						$numbers = ctype_digit($_POST['tel']);
						if ($numbers===True) {
							$checktel=True;
							$_SESSION['tel']=$_POST['tel'];
						}
						else {
							$checktel=3;
							unset($_SESSION['tel']);
						}
					}
					else {
						$checktel=3;
						unset($_SESSION['tel']);
					}
				}
				else {
					$checktel=False;
				}


				if (empty($_POST['courriel'])) {
					$checkmail=False;
				}
				else {
					$checkmail=True;
					$_SESSION['courriel']=$_POST['courriel'];
				}
				if (($checkmail===True) or ($checktel===True)) {
					$checkmailtel = True;
				}
				else {
					$checkmailtel = False;
				}




				$_SESSION['IP']=$_POST['IP'];
				$_SESSION['site']=$_POST['site'];





		# name check
		if (empty($_POST['nom'])) {
			$checknom = False;
		}
		else {
			$checknom = True;
			$_SESSION['nom']=$_POST['nom'];
		}

		# object check
		if (empty($_POST['objet'])) {
			$checkobj = False;
		}
		else {
			$checkobj = True;
			$_SESSION['objet']=$_POST['objet'];
		}

		# message check

		if (empty($_POST['message'])) {
			$checkmsg = False;
		}
		else {
			$checkmsg = True;
			$_SESSION['message']=$_POST['message'];
		}

		# service check
		if (empty($_POST['service'])) {
			$checksvc= False;
		}
		else {
			$checksvc = True;
			$_SESSION['service']=$_POST['service'];
		}

		# message erreur champs manquant
		$alerte = 'Champs manquant(s) :';
		if ($checknom===False) {
			$alerte .= '<br> Nom ';
		}
		if ($checkobj===False) {
			$alerte .= '<br> Objet ';
		}
		if ($checkmsg===False) {
			$alerte .= '<br> Message ';
		}
		if ($checkmailtel===False) {
			$alerte .= '<br> Telephone ou email ';
		}
		if ($checksvc===False) {
			$alerte .= '<br> Service ';
		}
		if ($checktel===3) {
			$alerte .= '<br> Telephone erroné ';
		}

		# verification du format de l'adresse IPv4
		# Active = NO

 /*


				if (!empty($_POST['ip'])) {
							# code...
						$ip = $_POST['ip']; // test avec une chaîne qui est une adresse IP

						// Vérifie si la chaîne ressemble à une adresse IP


						if ((preg_match('#^([0-9]{1,3}\.){2}[0-9]{1,3}$#', $ip)) or (preg_match('#^([0-9]{1,3}\.){3}[0-9]{1,3}$#', $ip))) {

							$checkip = True;
						} else {

							$checkip = False;
							$alerte .= 'Adresse IP non valide';
						}
			  }
				*/


		# verification des champs et redirection
		if (($checktel===3) or ($checkmailtel===False) or ($checknom===False) or ($checkobj===False) or ($checkmsg===False) or ($checkip===False) or ($checksvc===False)) {

			header("Location: Ticket_Intra.php?empty=yes&fail=$alerte");
			exit();
		}
		else{

				# Initialisation des variables

				$nom = '';
				$courriel = '';
				$tel = '';
				$site = '';
				$service = '';
				$ip = '';
				$cat = '';
				$impact = '';
				$urgence = '';
				$priority='';

				# récupération des variables

				$nom = utf8_decode($_POST['nom']);

				if (!empty($_POST['courriel'])) {
					$courriel = utf8_decode($_POST['courriel']);
				}
				if (!empty($_POST['tel'])) {
					$tel = $_POST['tel'];
				}
				if (!empty($_POST['service'])) {
					$service = utf8_decode($_POST['service']);
				}
				if (!empty($_POST['ip'])) {
					$ip = $_POST['ip'];
				}

				$site = $_POST['site'];


				$cat = $_POST['cat'];
				$impact = $_POST['impact'];
				$urgence = 2;
				$priority= $impact + 1;

				# Récupération de l'ID le plus haut

					$sql="SELECT IFNULL(MAX(id),0)+1 FROM glpi_tickets";
								$sqlquery=mysqli_query($con,$sql) ;
								$sqlrowid=mysqli_fetch_array($sqlquery) ;
								$id=$sqlrowid[0];


								mysqli_free_result($sqlquery) ;

				$objet2 = $_POST['objet'];
				$objet2 .= " [";
				$objet2 .= $nom;
				$objet2 .= "]";
				$objet = utf8_decode($objet2);

				$message = addslashes($_POST['message']);
				$message .= '\n@ip: '.$ip.'\n\nContact:'.'\n'.strtoupper($nom).'\n'.$courriel.'\nTel: '.$tel.'\n'.$service;

				$message = utf8_decode($message);



		}


		linkCss(); ?>
		<title> Demande valide </title>
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
					<div class="col-sm-offset-2 col-md-8">
					<?php

						# Récupération de la date après avoir modifier le fuseau horaire

							date_default_timezone_set('Europe/Paris');



							$date = date('Y-m-d H:i:s');
							echo "</br>";
							/*
							print($date);
							echo"$message";
							echo "$type";
							print_r($_POST);
							*/


						# Récupération du type via la variable $cat

							if (($cat=='44') or ($cat=='45') or ($cat=='53') or ($cat=='43') or ($cat=='56') or ($cat=='59') or ($cat=='41') or ($cat=='55')) {
								$type='1';
							}
							elseif (($cat=='51') or ($cat=='52') or ($cat=='49') or ($cat=='47') or ($cat=='48') or ($cat=='54') or ($cat=='50') or ($cat=='40') or ($cat=='57')) {
								$type='2';
							}

							$source = '1';
							if (isset($_POST['source'])) {
								$source = $_POST['source'];
								$message .= '\nVia &#x21A6; D.S.I.H.';
							}

							$sql2 = "INSERT INTO glpi_tickets(entities_id, name, date, date_mod, status, users_id_recipient, content, urgency, impact, priority,type, itilcategories_id, requesttypes_id, date_creation)";
							$sql2 .= " VALUES ('$site','$objet','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."', '1', '3254', '$message', '$urgence','$impact','$priority','$type','$cat','$source','".date('Y-m-d H:i:s')."')";

							$input = mysqli_query($con, $sql2);

							$sql3 = "INSERT INTO glpi_groups_tickets(tickets_id, groups_id, type) ";
							$sql3 .= " VALUES ('$id', '195', '1')";

							$input2 = mysqli_query($con, $sql3);

							#	Conversiond de l'impact from number to letter

							switch ($impact) {
								case '1':
									$prio = '[Impact : PERSONNEL]';
									break;
									case '3':
										$prio = '[Impact : SERVICE]';
										break;
										case '5':
											$prio = '[Impact : SITE]';
											break;

								default:
									$prio = '';
									break;
							}

							# Conversion du site from number to letter

							$site2[1]='ALIUM';
							$site2[2]='CARC / PSA';
							$site2[3]='CFPBNA';
							$site2[4]='COTH';
							$site2[5]='GIE 246';
							$site2[6]='EHPB';
							$site2[7]='GIE GBNA';
							$site2[8]='GIE Loghos';
							$site2[9]='GIE GBNA Logistics';
							$site2[10]='NCBA';
							$site2[11]='PBCA';
							$site2[12]='PBNA';
							$site2[13]='PBRD';



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


							for ($i=0; $i < 14 ; $i++) {
								if ($site == $siten[$i]) {
									$nomsite = $site2[$i];
								}
							}



							if ($checkmail===True) {
								shell_exec('echo "'.'Bonjour\n\nVotre demande a ete prise en compte avec le numero suivant '.$id.'\nUn technicien reviendra vers vous s\'il manque des informations ou pour faire des tests.'.'\n\nVous pouvez connaitre le statut du ticket en cliquant sur le lien suivant http://172.30.1.117/glpiweb/suivi.php?idsuivi='.$id.' \n\nPour toute demande d\'intervention au support informatique merci de passer en priorite par l\'intranet http://172.30.1.117/glpiweb/Ticket_Intra.php \n\nCordialement,\nLe support informatique\nTel : 05 57 22 58 20\nEmail : support.informatique@bordeauxnord.com'.'"| mail -s "'.'Ticket '.$id.' ouvert'.'" '.$courriel.' -a From:support.informatique@bordeauxnord.com');
							}
							shell_exec('echo "'.'Un ticket a ete ouvert sous le numero '.$id.' : '.$objet.'\n\n'.$message.'"| mail -s "'.$nomsite.' - '.$objet.' '.$prio.' '.$nom.'" s.chhem@bordeauxnord.com -a From:glpi.intranet@bordeauxnord.com');







						# Affichage utilisateur

							$ticketNum = $id;
							$script = '';
							$script .= '<h1 class="alert alert-success" style=" text-align: center;">Votre demande a bien été prise en compte</h1>';
							$script .= '<h2 class="alert alert-info" style=" text-align: center;"> Le numéro de vote demande est le : '.'<p style="color: red;">'.$ticketNum.'</p>'.'Veuillez conserver ce numéro </br> </h2>';
							print($script);


							mysqli_close($con);
							$con2=openDB2();


							if ($checkmail===False) {
								$courriel='vide';
							}
							$sql4 = "INSERT INTO courriel(courr_id, courr_adresse, courr_objet, courr_valid)";
							$sql4 .= " VALUES ('$id', '$courriel', '$objet', '2')";

							$input3 = mysqli_query($con2, $sql4);




					?>
					</div>
				</div>
			</section>
			<footer>
				<?php scriptFooter(1);
				CloseDB($con2);
					?>

			</footer>
		</body>
</html>
