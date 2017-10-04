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
		<title>Courriel</title>
	</head>
		<body >



			<header>
				<div class="col-sm-offset-4 col-sm-5">
					<img src="gbna_clinique.png" class="img-responsive" height="190" width="800" class="img-circle" alt="...">
				</div>
				<?php scriptHeader(); ?>
			</header>
			<section>
        <?php
          
            if ($_POST['message'] != '') {
              function Rec($text)
              {
                      $text = htmlspecialchars(trim($text), ENT_QUOTES);
                      if (1 === get_magic_quotes_gpc())
                      {
                      $text = stripslashes($text);
                      }

                      $text = nl2br($text);
                      return $text;
              };


              $service   = (isset($_POST['service']))   ? Rec($_POST['service'])   : '';
              $nom   = (isset($_POST['nom']))   ? Rec($_POST['nom'])   : '';
              $tel   = (isset($_POST['tel']))   ? Rec($_POST['tel'])   : '';
              $message   = (isset($_POST['message']))   ? Rec($_POST['message'])   : '';
              $courriel   = (isset($_POST['courriel']))   ? (utf8_decode($_POST['courriel']))   : '';
              $site = '';
              if (isset($_POST['site'])) {
                switch ($_POST['site']) {
                  case '3':
                      $site = 'NCBA';
                    break;
                    case '5':
                        $site = 'CARC';
                      break;
                      case '6':
                          $site = 'PBNA';
                        break;
                        case '7':
                            $site = 'PBRD';
                          break;
                          case '8':
                              $site = 'PBCA';
                            break;
                            case '9':
                                $site = 'PCRD';
                              break;
                              case '124':
                                  $site = 'CME';
                                break;
                                case '125':
                                    $site = 'COTH';
                                  break;
                                  case '126':
                                      $site = 'CSLO';
                                    break;
                                    case '130':
                                        $site = 'CTOU';
                                      break;
                                      case '131':
                                          $site = 'EHPB';
                                        break;
                                        case '133':
                                            $site = 'ALIUM';
                                          break;
                                          case '134':
                                              $site = 'Logistics';
                                            break;
                                            case '135':
                                                $site = 'GIE GBNA';
                                              break;
                                              case '136':
                                                  $site = 'Loghos';
                                                break;
                  default:
                    $site = 'Inconnu';
                    break;
                }
              }



              shell_exec('echo "'.$message.'\n\n'.$nom.'\n'.$tel.'\n'.$courriel.'\n'.$site.'\n'.$service.'"| mail -s " Courriel depuis intranet " loic.lm17@gmail.com -a From:support.informatique@bordeauxnord.com');

              $script = '<div>';
              $script .= '<h1 class="alert alert-success" style=" text-align: center;">Votre message a bien été envoyé</h1>';
              $script .= '<h2 class="alert alert-info" style=" text-align: center;"><a href="acceuil.php">Retour à '."l'".'accueil<p style="color: red;"></p></a></h2></div>';


            }

        ?>
				<div class="container">
          <div class="col-md-6 col-md-offset-3">
            <?php print($script); ?>

                  <form class="form-horizontal" role="form" method="post" action="courriel.php" >
                  <div>
                  <?php
                  /*
                  $alerte='';
                  if (isset($_GET['empty'])) {
                            $alerte= '<p class="alert alert-danger" style="font-size: 18px;  text-align: center;"><b>&#9940; Vous n\'avez pas remplis tout les champs ! &#9940;</br>Merci de renseigner les champs en rouge </b> ';
                  }

                  print($alerte);
                  */
                  ?>

                  <h1><b>Envoyer un e-mail au support</b></h1>
                  <h4> <span style="color: red;">*</span>  Champs obligatoires  </h4>

                  </div>

                <!-- NOM -->

                  <div class="form-group">
                        <label for="Name" class="control-label" >Nom et Prénom <span style="color: red;">*</span> : </label>
                        <div >
                            <input type="text"  name="nom" id="Name" placeholder="Exemple : Duppond Jean" class="form-control" autofocus>
                        </div>
                    </div>

                  <!-- EMAIL  -->

                    <div class="form-group">
                      <label for="Name2" class="control-label">Courriel &#9993; : </label>
                        <div>
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
                      <label for="telf" class="control-label">Téléphone &#9742; (accessible de l'extérieur) : </label>
                        <div>
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
                      <label for="site" class=" control-label">Site &#127970; <span style="color: red;">*</span> : </label>
                        <div >
                            <select placeholder="exemple" class="form-control" name="site" required="yes">
                              <?php
                                $site[1]='ALIUM';
                                $site[2]='CARC';
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

                                $siten[1]='133';
                                $siten[2]='5';
                                $siten[3]='124';
                                $siten[4]='125';
                                $siten[5]='126';
                                $siten[6]='131';
                                $siten[7]='135';
                                $siten[8]='136';
                                $siten[9]='134';
                                $siten[10]='3';
                                $siten[11]='8';
                                $siten[12]='6';
                                $siten[13]='7';


                                    for($i=1; $i<=13; $i++) {
                                        print('<option value="'.$siten[$i].'">'.$site[$i].'</option>') ;
                                    }

                                ?>
                              </select>
                        </div>
                    </div>
                  </div>

                  <!-- SERVICE -->
                  <div>
                      <div class="form-group">
                      <label for="service" class="control-label">Service <span style="color: red;">*</span>: </label>
                        <div >

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
                          <div>
                            <div class="form-group">
                              <div>
                                <label for="comment" class="control-label">Contenu du courriel :<span style="color: red;">*</span> : </label>
                              </div>
                      <textarea class="form-control" rows="5" name="message" id="comment" placeholder="Exemple :

              Suite à un redémarage intempestif, impossible d'ouvrir à nouveau une session"></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                        <div class="col-md-5 col-md-offset-3">
                            <button type="submit" class="btn btn-primary btn-block" style="font-family: Helvetica;" ><b>Envoyer  &#10003;</b></button>
                          </div>
                      </div>

                    </form>
                    <form class="form-horizontal" role="form" method="post" action="courriel.php" >
                      <div class="form-group">
                            <div class="col-md-5 col-md-offset-3">

                            <button type="submit" class="btn btn-danger btn-block " style="font-family: Helvetica;"><b>Annuler &#10007;</b></button>
                          </div>
                      </div>

                    </form>

          </div>
        </div>
      </section>
    </body>
  </html>
