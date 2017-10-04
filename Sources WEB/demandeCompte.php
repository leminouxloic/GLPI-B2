<?php
	include_once('fonction_glpi.php');
	if (!isset($_GET['empty'])) {
		session_start();
		session_unset();
		session_destroy();
	}
	session_start();

?>
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"fr\" lang=\"fr\">

<head>
<?php linkCss(); ?>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8 \" />
<title>Compte</title>
<meta name="description" content="D&eacuteclaration panne informatique - GBNA" />
<meta name="keywords" content="D&eacuteclaration panne informatique - GBNA" />
<meta http-equiv="Content-Language" content="fr" />
<meta name="language" content="fr-FR" />
<link href="../favicon.ico" rel="shortcut icon" />
<meta content="no" http-equiv="imagetoolbar" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function() {
$( "#datepicker" ).datepicker({
altField: "#datepicker",
closeText: 'Fermer',
prevText: 'Précédent',
nextText: 'Suivant',
currentText: 'Aujourd\'hui',
monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
weekHeader: 'Sem.',
dateFormat: 'yy-mm-dd'
});
});
</script>




<script type='text/javascript'>

        var delai=0; var pix=0; var pixmax=0; var inc=0;

        function MomNavigateur() {
          if (navigator.appName=="Microsoft Internet Explorer") {
                pixscroll = document.documentElement.scrollTop;
          }
          else {
                pixscroll = window.pageYOffset;
          }
        }

        function ScrollUpToPage() {
                delai=1;
                inc=-20;
                MomNavigateur()
                pix = pixscroll;
                if (-inc > pixscroll) {
                        if (pixscroll > 15) {inc = -pixmax+15;};
                }
                if (pixscroll > 15) {self.scrollTo(0,15);pixscroll=15;pix=15;inc=-5;}
                setTimeout("scroll()",delai);
        }

        function scroll() {
                pix=pix+inc;
                self.scrollBy(0,inc);
                if (pix >= 0) {
                        setTimeout("scroll()",delai);
                        MomNavigateur();
                        if (pixscroll <= 5) {inc=-1;}
                        if (pixscroll > 5) {if (pixscroll <= 10) {inc=-3;};}
                        if (pix < pixscroll) {pix=0;};
                }
        }

        function testChampsEtape1() {
    /*var a = document.forms["myForm"]["responsable"].value;  */
        var a = document.getElementById("responsable").value;
        var b = document.getElementById("tel").value;
        var c = document.getElementById("Compte").value;
        var d = document.getElementById("Nom").value;
        var e = document.getElementById("Prenom").value;
        var f = document.getElementById("site").options[document.getElementById("site").selectedIndex].text;
				var g = document.getElementById("courriel").value;
				var h = document.getElementById("service").value;
				var v = b.length;

        var flag = true;
        /*alert("a:"+a+"/b:"+b+"/c:"+c+"/d:"+d+"/e:"+e+"/f:"+f);        */



    		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    		var test = re.test(g);
				if (test === false) {
					flag = false;
				}

                if ((b == null || b == "") & (g == null || g == "")) {
                        flag = false;
        }
				if ((v != 4) & (v != 10) & (v != 0) & (v != 5) & (v != 14)) {
						flag = false;
				}
                if (a == null || a == "") {
                        flag = false;
        }
				if (h == null || h == "") {
								flag = false;
				}
                if (c == null || c == "") {
                        if (d == null || d == "" || e == null || e == "") {
                        flag = false;
        }}
                /*if (f == null || f == "") {
                        flag = false;
        }*/

                if (flag == false)
                        {alert("Les champs Etablissement, Responsable, Telephone (ou email), Type et Nom de compte sont obligatoires.");
                        return false;}
                        else
                        {return true;}

        }

        function F_Suivant(){
                if (testChampsEtape1()== true) {
                        ScrollUpToPage();

                        document.getElementById('infogen').style.display ="none";
                        document.getElementById('messagerie').style.display ="none";
                        document.getElementById('dossierp').style.display ="none";
                        document.getElementById('ZoneImpr').style.display ="none";
                        document.getElementById('ZonePartage').style.display ="none";
                        document.getElementById('ChoixSigems').style.display ="none";
                        document.getElementById('Applications').style.display ="none";
                        document.getElementById('commentaires').style.display ="none";
                        document.getElementById('signature').style.display ="none";
                        document.getElementById('bt_etape2p').style.display ="";
                        document.getElementById('bt_etape1s').style.display ="none";
                        document.getElementById('enteteWin').style.display ="none";
                        document.getElementById('enteteSigems').style.display ="none";
                        document.getElementById('enteteNotes').style.display ="none";
                        document.getElementById('enteteSign').style.display ="none";
                        document.getElementById('rien').style.display ="";
                        document.getElementById('bt_envoyer').style.display ="none";

                        if (document.getElementById("TypeWin").checked )
                                {
                                        document.getElementById('enteteWin').style.display ="";
                                   document.getElementById('dossierp').style.display ="";
                                   document.getElementById('ZoneImpr').style.display ="";
                                   document.getElementById('ZonePartage').style.display ="";
                                   document.getElementById('Applications').style.display ="";
                                   document.getElementById('commentaires').style.display ="";
                                   document.getElementById('rien').style.display ="none";
                                        document.getElementById('bt_envoyer').style.display ="";
                                }
                        if (document.getElementById("TypeMail").checked )
                                {
                                   document.getElementById('enteteNotes').style.display ="";
                                   document.getElementById('messagerie').style.display ="";
                                   document.getElementById('commentaires').style.display ="";
                                   document.getElementById('rien').style.display ="none";
                                        document.getElementById('bt_envoyer').style.display ="";
                                }

                        if (document.getElementById("TypeSigems").checked )
                                {
                                        document.getElementById('enteteSigems').style.display ="";
                                   document.getElementById('ChoixSigems').style.display ="";
                                   document.getElementById('commentaires').style.display ="";
                                   document.getElementById('rien').style.display ="none";
                                        document.getElementById('bt_envoyer').style.display ="";
                                }

                        if (document.getElementById("TypeSignature").checked )
                                {
                                        document.getElementById('enteteSign').style.display ="";
                                   document.getElementById('signature').style.display ="";
                                   document.getElementById('commentaires').style.display ="";
                                   document.getElementById('rien').style.display ="none";
                                        document.getElementById('bt_envoyer').style.display ="";
                                }
                        }
                }

                        function F_Page_InfoGen(){
                           ScrollUpToPage();
               document.getElementById('infogen').style.display ="";
                           document.getElementById('messagerie').style.display ="none";
                           document.getElementById('dossierp').style.display ="none";
                           document.getElementById('ZoneImpr').style.display ="none";
                           document.getElementById('ZonePartage').style.display ="none";
                           document.getElementById('ChoixSigems').style.display ="none";
                           document.getElementById('Applications').style.display ="none";
                           document.getElementById('commentaires').style.display ="none";
                           document.getElementById('bt_etape1s').style.display ="";
                           document.getElementById('bt_etape2p').style.display ="none";
                           document.getElementById('bt_envoyer').style.display ="none";
                           document.getElementById('signature').style.display ="none";
                           document.getElementById('enteteWin').style.display ="none";
                           document.getElementById('enteteSign').style.display ="none";
                           document.getElementById('enteteNotes').style.display ="none";
                           document.getElementById('enteteSigems').style.display ="none";
                           document.getElementById('rien').style.display ="none";
                        }



                        function F_CNom(){

                                document.getElementById('Compte').className = "";
                                document.getElementById('label01').className = "";
                                document.getElementById('Nom').className = "";
                                document.getElementById('Prenom').className = "";
                                document.getElementById('label02').className = "";
                                document.getElementById('label03').className = "";

               document.getElementById('Compte').style.display ="none";
                           document.getElementById('label01').style.display ="none";
                           document.getElementById('Nom').style.display ="";
                           document.getElementById('Prenom').style.display ="";
                           document.getElementById('label02').style.display ="";
                           document.getElementById('label03').style.display ="";
                        }

                        function F_CGen(){

                                document.getElementById('Compte').className = "";
                                document.getElementById('label01').className = "";
                                document.getElementById('Nom').className = "";
                                document.getElementById('Prenom').className = "";
                                document.getElementById('label02').className = "";
                                document.getElementById('label03').className = "";

               document.getElementById('Compte').style.display ="";
                           document.getElementById('label01').style.display ="";
                           document.getElementById('Nom').style.display ="none";
                           document.getElementById('Prenom').style.display ="none";
                           document.getElementById('label02').style.display ="none";
                           document.getElementById('label03').style.display ="none";
                        }

                window.onload = F_Page_InfoGen;

								$.datepicker.regional['fr'] = {
									minDate: '+3D',
									maxDate: "+90D",
								  closeText: 'Fermer',
								  prevText: 'Précédent',
								  nextText: 'Suivant',
								  currentText: 'Aujourd\'hui',
								  monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
								  monthNamesShort: ['Janv.','Févr.','Mars','Avril','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov.','Déc.'],
								  dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
								  dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
								  dayNamesMin: ['D','L','M','M','J','V','S'],
								  weekHeader: 'Sem.',
								  dateFormat: 'dd/mm/yy',
								  firstDay: 1,
								  isRTL: false,
								  showMonthAfterYear: false,
								  yearSuffix: ''};
									$.datepicker.setDefaults($.datepicker.regional['fr']);
        </script>
				<script type="text/javascript">
				function blinker(id,c1,c2)
				{
				       elm = document.getElementById(id);
				       setTimeout(function() {setInterval(function () {elm.style.color=c1;},1000);},500);
				       setInterval(function () {elm.style.color=c2;},1000);
				}
				</script>


</head>

<?php
function convert($chaine)
{
        $chaine = str_replace("&agrave", "&agrave",$chaine);
        $chaine = str_replace("", "&acirc",$chaine);
        $chaine = str_replace("&quot;",'"',$chaine);
        $chaine = str_replace('<br/>','',$chaine);
        $chaine = str_replace('<br />','',$chaine);
        $chaine = str_replace("&lt;","<",$chaine);
        $chaine = str_replace("&gt;",">",$chaine);
        $chaine = str_replace("&amp;","&",$chaine);
        $chaine = str_replace("&eacute","&eacute",$chaine);
        $chaine = str_replace("&egrave","&egrave",$chaine);
        $chaine = str_replace("","&ccedil",$chaine);
        $chaine = str_replace("","o",$chaine);
        $chaine = str_replace("","&euml",$chaine);
        $chaine = str_replace("","&ugrave",$chaine);
        $chaine = str_replace("","&ecirc",$chaine);
        $chaine = str_replace("","&ucirc",$chaine);
        $chaine = str_replace("","&ocirc",$chaine);
return $chaine;
}  ?>

<body>
  <header>
    <div class="col-sm-offset-4 col-sm-5">
      <img src="gbna_clinique.png" class="img-responsive" height="190" width="800" class="img-circle" alt="...">
    </div>
    <?php scriptHeader(); ?>
  </header>
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

        <div id="header">
        <div id="banner">
        </div>
        </div>

        <div id="outerWrapper">

        <div id="offset">
                <div id="content">




									<div class="form-horizontal">
        <form name="myForm" class="demcompte row justify-content-center" action="compteTraitement.php" method="post" >
          <div class="col-md-offset-1 col-md-10">
          <h1 style="text-align: center;" class="col-lg-12"><b>Cr&eacuteation ou modification de compte informatique</b></h1>
					<?php

					$alerte='';
					if (isset($_GET['empty'])) {
										$alerte= '<p class="alert alert-danger" style="font-size: 18px;  text-align: center;"><b>&#9940; Vous n\'avez pas remplis les champs correctement ! &#9940;</br>Merci de renseigner les champs en rouge </b> ';
					}

					print($alerte);
					?>
        </div>


					<div class="col-md-offset-4 col-md-2">
          <h4> <span style="color: red; text-align: left;">*</span>  Champs obligatoires <br><br></h4>

        </div>
				<div class="col-md-offset-2 col-md-8">
        <fieldset id="infogen">
        <legend><span style="color: #253772;">Informations sur le demandeur<br><br></span></legend>
        <div class="form-group">
          <div class="col-sm-4 control-label">
        <label for="site" >Etablissement : <span style="color: red;"> * </span></label>
        </div>

        <div class=" col-md-7">


                  <select placeholder="exemple" class="form-control" name="site" id="site" required="yes">
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




<div class="form-group">
  <div class="col-sm-4 control-label">
        <label for="service" >Service : <span style="color: red;"> *</span></label>
      </div>


			<div class="col-md-7">
        <input type="text" name="service"<?php
				if((!isset($_SESSION['service']) and ($_GET['empty'])=='yes') ){
					$script='style="border-color: #FF0000; box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);"';
					print($script);} ?> name="nom" id="service" placeholder="Exemple: Anesthésie, bâtiment B, 3e étage" class="form-control"	 autofocus
				<?php if (($_GET['empty']=='yes') and (!empty($_SESSION['service']))) {
					$script= 'value="'.$_SESSION['service'].'"';
					print($script);
				} ?>>
      </div>
		</div>

		<div class="form-group">
		  <div class="col-sm-4 control-label">
        <label for="responsable"  >Nom du responsable : <span style="color: red;"> *</span></label>
			</div>


			<div class="col-md-7">

        <input type="text" class="form-control" name="responsable" size="20"
        maxlength="50" id="responsable" placeholder="Exemple: Duppond Jean" />

			</div>
			</div>

			<div class="form-group">
				<div class="col-sm-8 col-sm-offset-4">
					<h3><span style="color: #c61111;">&#9888; </span><span style=" font-family: Helvetica; color: grey; font-size: 16px;"> Veuillez saisir une adresse e-mail et/ou un téléphone</span><span style="color: #c61111;"> &#9888; </span></h3>
				</div>
			</div>

			<div class="form-group">
			  <div class="col-sm-4 control-label">

        <p><label for="tel" >Téléphone de contact &#9742;  : <span style="color: red;"> *</span></label>
				</div>


				<div class="col-md-7">
        <input type="text" class="form-control" name="tel" size="20"
        maxlength="14" id="tel" placeholder="Exemple: 05 58 62 45 23" /></p>
			</div>
			</div>

				<div class="form-group">

        		<p><label for="tel"  class="col-sm-4 control-label" >Email de contact &#9993; : <span style="color: red;"> *</span></label>
							<div class="col-sm-7">

				        <input type="text" class="form-control" name="courriel" maxlength="50" id="courriel" placeholder="Exemple: jeanne.blanchard@bordeauxnord.com" /></p>
			 			</div>
				</div>

				<div class="form-group">
        <p><label for="dateeffet" class="col-sm-4 control-label" >Date d'effet souhait&eacute : <span style="color: red;"> * </span></label>
					<div class="col-sm-7">

					<input type="text" id="datepicker"  readonly="readonly" class="form-control" name="dateeffet" placeholder="Cliquez ici pour selectionner une date &#128197;">
				</div>
				</div>

				<legend><span style="color: #253772;">Informations sur le compte<br><br></span></legend>
				<div class="form-group">
					<div class="col-sm-4 control-label">

        </br>
        <p ><b>Type de la demande : <span style="color: red;"> * </span></b></p>
			</div>


			<div class="col-md-7">
				<br>
         <div class="div_liste" ><input type="radio" name="typeD" value="Creation de compte" id="typeD" checked="checked" />

         <label for="creation" class="inline"><div class="text_icones" style="color: green;">Nouveau compte</div></label>
				 &nbsp; &nbsp;
         <input type="radio" class="col-md-offset-1"  name="typeD" value="Modification de comtpe" id="typeD" />

         <label for="elevation" class="inline"><div class="text_icones" style="color: orange;"> Modification d'un compte</div></label></div>

			 </div>
			</div>


							<div class="form-group">
								<div class="col-sm-4 control-label">

        <p ><b>Type de compte : <span style="color: red;"> * </span></b></p>
			</div>
         <div class="div_liste col-md-offset-5" ><input type="radio" name="TypeCompte" value="G&eacuten&eacuterique" id="CompteGen"  onClick='F_CGen()'/>
         <label for="CompteGen" class="inline"><img class="icones" src="comptegen.png" height="32" width="32"><div class="text_icones">G&eacuten&eacuterique (Pour tout le service)</div></label></div>
         </br>
         <div class="div_liste col-md-offset-5" ><input type="radio"  name="TypeCompte" value="Nominatif" id="CompteNom" onClick='F_CNom()'/>
         <label for="CompteNom" class="inline"><img class="icones" src="comptenom.png" height="32" width="32"><div class="text_icones">Nominatif (Personnel)</div></label></div>

</div>


<div class="form-group">
	<div class="col-sm-4 control-label">
        <p><label for="lblCompte" class="cache" id="label01">Nom du compte : <span style="color: red;"> * </span></label>
				</div>


				<div class="col-md-7">
        <input type="text" name="Compte" size="20"
        maxlength="20" id="Compte" class="cache form-control" /></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-4 control-label">

        <p><label for="lblNom" class="cache" id="label02">Nom : <span style="color: red;"> * </span></label>
				</div>


				<div class="col-md-7">
        <input type="text" class="form-control cache" name="Nom" size="20"
        maxlength="20" id="Nom" /></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-4 control-label">

        <p><label for="lblPrenom" class="cache" id="label03">Pr&eacutenom : <span style="color: red;"> * </span></label>
				</div>


				<div class="col-md-7">
        <input type="text" class="form-control cache" name="Prenom" size="20"
        maxlength="20" id="Prenom" /></p>
			</div>
		</div>

        </br>

        <legend><span style="color: #253772;">Applications et services souhaités <br><br></span></legend>
        </br>
<div class="col-md-offset-1">
         <div class="div_liste" ><input type="checkbox" value="TypeWin" id="TypeWin" name="TypeWin"/><img class="icones" src="logoWin.png" height="32" width="32"><div class="text_icones"><b>Windows / Citrix</b></div></div>
         </br>
         <div class="div_liste"><input type="checkbox" value="TypeMail" id="TypeMail" name="TypeMail"/><img class="icones" src="logoNotes.png" height="32" width="32"><div class="text_icones"><b>Compte de messagerie</b></div></div>
         </br>
         <div class="div_liste"><input type="checkbox" value="TypeSignature" id="TypeSignature" name="TypeSignature"/><img class="icones" src="logoPBNA.png" height="32" width="32"><div class="text_icones"><b>Signature d'e-mail</b></div></div>
         </br>
         <div class="div_liste"><input type="checkbox" value="TypeSigems" id="TypeSigems" name="TypeSigems"/><img  class="icones" src="logoSigems.png" height="32" width="32"><div class="text_icones"><b>Compte(s) Sigems</b></div></div>
         </br>
        </p>
			</div>
        </fieldset></p>

        <div id="enteteWin">
        </br>
        <div class="entete" >
        </br>
        <p><div class="div_liste"><img class="icones" src="logoWin.png" height="32" width="32"><div class="text_icones"><h2 style="color: #253772;"><b>Windows / Citrix</b></h2></div></div></p>
        </br>
        </div>
        </br>
        </div>

        <p><fieldset id="Applications">
        <legend style="color: #253772;">Logiciels souhaités :</legend>
        </br>
        <table class="applications">
        <tr><td>
        <input type="checkbox" value="Office" id="Office" name="Office"/>Office (Word, Excel)
         </td><td>
         <input type="checkbox" value="CEGID" id="CEGID" name="CEGID"/>CEGID
         </td></tr>
         <tr><td>
         <input type="checkbox" value="Chimio" id="Chimio" name="Chimio"/>Chimio
         </td> <td>
         <input type="checkbox" value="Hestia" id="Hestia" name="Hestia"/>Hestia
         </td></tr>
         <tr><td>
         <input type="checkbox" value="Hemadia" id="Hemadia" name="Hemadia"/>Hemadia
         </td> <td>
         <input type="checkbox" value="Expertiz" id="Expertiz" name="Expertiz"/>DPI Expertiz Sant&eacute
         </td></tr>
         <tr><td>
         <input type="checkbox" value="Carte vitale" id="CarteVitale" name="CarteVitale"/>Acc&egraves carte vitale
          </td> <td>
         <input type="checkbox" value="Lora" id="Lora" name="Lora"/>Lora
          </td></tr>
         <tr><td>
         <input type="checkbox" value="Optim OPM" id="Optim OPM" name="OptimOPM"/>Optim OPM (bloc)
         </td> <td>
          <input type="checkbox" value="Optim SPM" id="Optim SPM" name="OptimSPM"/>Optim SPM (st&eacute)
          </td></tr>
         <tr><td>
         <input type="checkbox" value="Octime" id="Octime" name="Octime"/>Octime
          </td> <td>
         <input type="checkbox" value="SIR5" id="SIR5" name="SIR5"/>SIR5
          </td></tr>
         <tr><td>
         <input type="checkbox" value="USISTAFF" id="USISTAFF" name="USISTAFF"/>USISTAFF
          </td> <td>
         <input type="checkbox" value="Diane" id="Diane" name="Diane"/>Diane
          </td></tr>
         <tr><td>
         <input type="checkbox" value="Gynelog" id="Gynelog" name="Gynelog"/>MedyCS (ex Gynelog)
          </td> </tr>
         </table>
         </br>
          <label for="autres" style="color: #253772;">Autres logiciels ou pr&eacutecisions :</label>
                <textarea name="autreLogiciels" class="form-control" id="autreLogiciels" style="width:460px"  cols="40" rows="4">
                </textarea>
        </p>
        </fieldset></p>

        <p><fieldset id="dossierp">
        <legend style="color: #253772;">Avez-vous besoin d'un dossier personnel ? (P:\)</legend>
        <p>
         <input type="radio" name="DossierPerso" value="DPOui" id="DPOui"  />
         <label for="DPOui" class="inline">Oui</label>
         <input type="radio" name="DossierPerso" value="DPNon" id="DPNon" />
         <label for="DPNon" class="inline">Non</label>
        </p>
        </fieldset></p>

        <p><fieldset id="ZoneImpr">
        <legend style="color: #253772;">Liste des imprimantes</legend>
        <p>
         <label for="imprimante">Pr&eacutecisez m&ecircmes imprimantes que... ou le nom des imprimantes sur vos postes :</label>
        <textarea name="imprimante" class="form-control" id="imprimante" style="width:460px"  cols="40" rows="8">
        </textarea></p>
        </fieldset></p>

        <p><fieldset id="ZonePartage">
        <legend style="color: #253772;">Dossiers partag&eacutes</legend>
        <p>
         <label for="partage">Pr&eacutecisez m&ecircmes droits que...  ou nom du partage (exemple X:\partage) :</label>
        <textarea name="partage" class="form-control" id="partage" style="width:460px"  cols="40" rows="8">
        </textarea></p>
        </fieldset></p>

        <div id="enteteNotes">
        </br>
        <div class="entete" >
        </br>
        <p><div class="div_liste"><img class="icones" src="logoNotes.png" height="32" width="32"><div class="text_icones"><h2 style="color: #253772;"><b>Compte de messagerie</b></h2></div></div></p>
        </br>
        </div>
        </div>

        <p><fieldset id="messagerie">
        <legend style="color: #253772;">Compte de messagerie BordeauxNord.com</legend>
        <p>Un compte de messagerie @bordeauxnord.com sera cr&eacute&eacute.</p>
        <p>Si vous ne souhaitez pas cr&eacuteer un compte de messagerie sur ce domaine, veuillez revenir &agrave l'&eacutetape pr&eacutec&eacutedente et d&eacutecocher "Compte de messagerie"</p>
        </fieldset></p>

        <div  id="enteteSign">
        </br>
        <div class="entete" >
        </br>
        <p><div class="div_liste"><img class="icones" src="logoPBNA.png" height="32" width="32"><div class="text_icones"><h2 style="color: #253772;"><b>Signature d'e-mail</b></h2></div></div></p>
        </br>
        </div>
        </br>
        </div>

        <p><fieldset id="signature">
        <legend style="color: #253772;">Informations sur la signature</legend>

        <p><label for="fonction">Fonction : <span style="color: red;"> * </span></label>
        <input type="text" class="form-control" name="fonction" size="20"
        maxlength="40" id="fonction" /></p>

        <p><label for="telsign">T&eacutel&eacutephone :</label>
        <input type="text" class="form-control" name="telsign" size="20"
        maxlength="14" id="telsign" /></p>

        <p><label for="mobign">Mobile :</label>
        <input type="text" class="form-control" name="mobsign" size="20"
        maxlength="14" id="mobsign" /></p>

        <p><label for="faxsign">Fax :</label>
        <input type="text" class="form-control" name="faxsign" size="20"
        maxlength="14" id="faxsign" /></p>

        <p><label for="email">Adresse e-Mail :</label>
        <input type="text" class="form-control" name="email" size="30"
        maxlength="50" id="email" />@bordeauxnord.com</p>

        </fieldset></p>

        <div  id="enteteSigems">
        </br>
        <div class="entete" >
        </br>
        <p><div class="div_liste"><img class="icones" src="logoSigems.png" height="32" width="32"><div class="text_icones"><h2 style="color: #253772;"><b>Compte(s) Sigems</b></h2></div></div></p>
        </br>
        </div>
        </br>
        </div>

        <p><fieldset id="ChoixSigems" name="ChoixSigems">
        <legend style="color: #253772;">Choix des acc&egraves Sigems</legend>
        </br>
         <table class="TSESigems table table-striped"><tr><td colspan="3">
         <input type="checkbox" value="plateforme" id="plateforme" name="plateforme"/>Plateforme Logistics
         </td></tr><tr><td>
         <input type="checkbox"  value="PBNA" id="PBNA" name="PBNA"/>PBNA
         </td><td>
         <input type="checkbox" value="PBRD" id="PBRD" name="PBRD"/>PBRD
         </td><td>
         <input type="checkbox" value="NCBA" id="NCBA" name="NCBA"/>NCBA
         </td></tr><tr><td>
         <input type="checkbox" value="CARC" id="CARC" name="CARC"/>CARC
         </td><td>
         <input type="checkbox" value="PBCA" id="PBCA" name="PBCA"/>PBCA
         </td><td>
         <input type="checkbox" value="COTH" id="COTH" name="COTH"/>COTH
         </td></tr></table>
				 <br>
        <p><b>Modules :</b></p>
        </br>
         <input type="checkbox" value="GestAdmin" id="GestAdmin" name="GestAdmin"/>Gestion administrative
         </br>
				 </br>
         <input type="checkbox" value="Comptabilite" id="Comptabilite" name="Comptabilite"/>Comptabilit&eacute
         </br>
				 </br>
         <input type="checkbox" value="StockPlateforme" id="StockPlateforme" name="StockPlateforme"/>Gestion des stocks (plateforme)
         </br>
				 </br>
         <input type="checkbox" value="StockEconomat" id="StockEconomat" name="StockEconomat"/>Gestion des stocks (Economat)
         </br>
				 </br>
         <input type="checkbox" value="StockPharma" id="StockPharma" name="StockPharma"/>Gestion des stocks (Pharmacie)
         </br>
				 </br>
         <input type="checkbox" value="StockBio" id="StockBio" name="StockBio"/>Gestion des stocks (Biomed)
         </br>
				 </br>
         <input type="checkbox" value="StockProthese" id="StockProthese" name="StockProthese"/>Gestion des stocks (Proth&egravese)
          </br>
					</br>
         <input type="checkbox" value="GestionBloc" id="GestionBloc" name="GestionBloc"/>Gestion du bloc (planning)
          </br>
					</br>
        <input type="checkbox" value="SaisieBloc" id="SaisieBloc" name="SaisieBloc"/>Saisie au bloc
         </br>
				 </br>
         <input type="checkbox" value="Tableau mural" id="TM" name="TableauMural"/>Tableau mural
         </br>
			 </br>
        <input type="checkbox" value="PMSI" id="PMSI" name="PMSI"/>PMSI
          </br>
          </br>
          <label for="autres">Autres :</label>
                <textarea name="autreSigems" class="form-control" id="autreSigems" style="width:460px"  cols="40" rows="4">
                </textarea>
        </p>
        </fieldset></p>

        <div id="commentaires">
        </br>
        <p><fieldset>
        <legend style="color: #253772;">Vos commentaires</legend>
        </br>
        <textarea name="comments" class="form-control" id="comments" style="width:460px"  cols="40" rows="4">
        </textarea>
        </fieldset></p>
        </div>

        <div id="rien">
                <p style="color: red;">Vous n'avez rien coch&eacute, veuillez revenir &agrave l'&eacutetape pr&eacutec&eacutedente</p>
        </div>
        <div class="col-sm-4">
        <p>
        <button id="bt_etape2p" type="button" class="btn btn-danger btn-block " onclick="F_Page_InfoGen()">&larr; Etape précédente</button>
      </div>
      <div class="col-sm-4">

        <button id="bt_etape1s" type="button" class="btn btn-primary btn-block " onclick="F_Suivant()">Etape suivante &rarr;</button>
      </div>
      <div class="col-sm-4">
        <input id="bt_envoyer" type="submit" class="btn btn-success btn-block " value="Envoyer &#10004;" />
        <!-- <input type="reset" value="Annuler" />  -->
        </p>

      </div>
        </form>
              </div>
            </div>
        </div>
    </div>
		<script> document.getElementById("CompteNom").click();  </script>
</body>

  <footer>
    <?php scriptFooter(2); ?>
    <?php CloseDB($con); ?>
  </footer>


</html>
