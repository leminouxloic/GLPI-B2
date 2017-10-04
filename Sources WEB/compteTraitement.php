

<?php
include_once('fonction_glpi.php');

session_destroy();
session_start();

$con=openDB();
linkCss();

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


function convert($chaine)
{
        $chaine = str_replace('<br/>',' ',$chaine);
        $chaine = str_replace('<br />',' ',$chaine);
        $chaine = str_replace("", "&agrave",$chaine);
        $chaine = str_replace("", "&acirc",$chaine);
        $chaine = str_replace("&quot;",'"',$chaine);
        $chaine = str_replace("&lt;","<",$chaine);
        $chaine = str_replace("&gt;",">",$chaine);
        $chaine = str_replace("&amp;","&",$chaine);
        $chaine = str_replace("","&eacute",$chaine);
        $chaine = str_replace("","&egrave",$chaine);
        $chaine = str_replace("","&ccedil",$chaine);
        $chaine = str_replace("","o",$chaine);
        $chaine = str_replace("","&euml",$chaine);
        $chaine = str_replace("","&ugrave",$chaine);
        $chaine = str_replace("","&ecirc",$chaine);
        $chaine = str_replace("","&ucirc",$chaine);
        $chaine = str_replace("","&ocirc",$chaine);

return $chaine;
}

$objet   = (isset($_POST['typeD']))   ? Rec($_POST['typeD'])   : 'Creation ou Elevation de compte';
$site   = (isset($_POST['site']))   ? Rec($_POST['site'])   : '';
$service   = (isset($_POST['service']))   ? Rec($_POST['service'])   : '';
$responsable   = (isset($_POST['responsable']))   ? Rec($_POST['responsable'])   : '';
$tel   = (isset($_POST['tel']))   ? Rec($_POST['tel'])   : '';
$dateeffet   = (isset($_POST['dateeffet']))   ? Rec($_POST['dateeffet'])   : '';
$typecompte = (isset($_POST['TypeCompte']))   ? Rec($_POST['TypeCompte'])   : '';
$comptegen = (isset($_POST['Compte']))   ? Rec($_POST['Compte'])   : '';
$comptenom = (isset($_POST['Nom']))   ? Rec($_POST['Nom'])   : '';
$compteprenom = (isset($_POST['Prenom']))   ? Rec($_POST['Prenom'])   : '';
$courriel = (isset($_POST['courriel']))   ? Rec($_POST['courriel'])   : '';

$TypeWin = (isset($_POST['TypeWin']))   ? Rec($_POST['TypeWin'])   : '';
$TypeSigems = (isset($_POST['TypeSigems']))   ? Rec($_POST['TypeSigems'])   : '';
$TypeMail = (isset($_POST['TypeMail']))   ? Rec($_POST['TypeMail'])   : '';
$TypeSignature = (isset($_POST['TypeSignature']))   ? Rec($_POST['TypeSignature'])   : '';

//$mail = (isset($_POST['Mail']))   ? Rec($_POST['Mail'])   : '';
$dossierperso = (isset($_POST['DossierPerso']))   ? Rec($_POST['DossierPerso'])   : '';
$imprimante = (isset($_POST['imprimante']))   ? Rec($_POST['imprimante'])   : '';
$partage = (isset($_POST['partage']))   ? Rec($_POST['partage'])   : '';
//$sigems = (isset($_POST['AccesSigems']))   ? Rec($_POST['AccesSigems'])   : '';
$choixsigems = (isset($_POST['ChoixSigems']))   ? Rec($_POST['ChoixSigems'])   : '';
$sigGBNALog = (isset($_POST['plateforme']))   ? Rec($_POST['plateforme'])   : '';
$sigPBNA = (isset($_POST['PBNA']))   ? Rec($_POST['PBNA'])   : '';
$sigPBRD = (isset($_POST['PBRD']))   ? Rec($_POST['PBRD'])   : '';
$sigNCBA = (isset($_POST['NCBA']))   ? Rec($_POST['NCBA'])   : '';
$sigCARC = (isset($_POST['CARC']))   ? Rec($_POST['CARC'])   : '';
$sigPBCA = (isset($_POST['PBCA']))   ? Rec($_POST['PBCA'])   : '';
$sigCOTH = (isset($_POST['COTH']))   ? Rec($_POST['COTH'])   : '';
$GestAdmin = (isset($_POST['GestAdmin']))   ? Rec($_POST['GestAdmin'])   : '';
$Comptabilite = (isset($_POST['Comptabilite']))   ? Rec($_POST['Comptabilite'])   : '';
$StockPl = (isset($_POST['StockPlateforme']))   ? Rec($_POST['StockPlateforme'])   : '';
$StockEco = (isset($_POST['StockEconomat']))   ? Rec($_POST['StockEconomat'])   : '';
$StockPUI = (isset($_POST['StockPharma']))   ? Rec($_POST['StockPharma'])   : '';
$StockBio = (isset($_POST['StockBio']))   ? Rec($_POST['StockBio'])   : '';
$StockProt = (isset($_POST['StockProthese']))   ? Rec($_POST['StockProthese'])   : '';
$Bloc = (isset($_POST['GestionBloc']))   ? Rec($_POST['GestionBloc'])   : '';
$SaisieBloc = (isset($_POST['SaisieBloc']))   ? Rec($_POST['SaisieBloc'])   : '';
$TableauMural = (isset($_POST['TableauMural']))   ? Rec($_POST['TableauMural'])   : '';
$PMSI = (isset($_POST['PMSI']))   ? Rec($_POST['PMSI'])   : '';
$autreSigems = (isset($_POST['autreSigems']))   ? Rec($_POST['autreSigems'])   : '';

$Office = (isset($_POST['Office']))   ? Rec($_POST['Office'])   : '';
$CEGID = (isset($_POST['CEGID']))   ? Rec($_POST['CEGID'])   : '';
$Chimio = (isset($_POST['Chimio']))   ? Rec($_POST['Chimio'])   : '';
$Hestia = (isset($_POST['Hestia']))   ? Rec($_POST['Hestia'])   : '';
$Hemadia = (isset($_POST['Hemadia']))   ? Rec($_POST['Hemadia'])   : '';
$Expertiz = (isset($_POST['Expertiz']))   ? Rec($_POST['Expertiz'])   : '';
$CV = (isset($_POST['CarteVitale']))   ? Rec($_POST['CarteVitale'])   : '';
$Lora = (isset($_POST['Lora']))   ? Rec($_POST['Lora'])   : '';
$OptimOPM = (isset($_POST['OptimOPM']))   ? Rec($_POST['OptimOPM'])   : '';
$OptimSPM = (isset($_POST['OptimSPM']))   ? Rec($_POST['OptimSPM'])   : '';
$Octime = (isset($_POST['Octime']))   ? Rec($_POST['Octime'])   : '';
$SIR5 = (isset($_POST['SIR5']))   ? Rec($_POST['SIR5'])   : '';
$USISTAFF = (isset($_POST['USISTAFF']))   ? Rec($_POST['USISTAFF'])   : '';
$Diane = (isset($_POST['Diane']))   ? Rec($_POST['Diane'])   : '';
$Gynelog = (isset($_POST['Gynelog']))   ? Rec($_POST['Gynelog'])   : '';
$autreLogiciels = (isset($_POST['autreLogiciels']))   ? Rec($_POST['autreLogiciels'])   : '';

$Fonction = (isset($_POST['fonction']))   ? Rec($_POST['fonction'])   : '';
$TelSign = (isset($_POST['telsign']))   ? Rec($_POST['telsign'])   : '';
$MobSign = (isset($_POST['mobsign']))   ? Rec($_POST['mobsign'])   : '';
$FaxSign = (isset($_POST['faxsign']))   ? Rec($_POST['faxsign'])   : '';
$Email = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';

$comments = (isset($_POST['comments']))   ? Rec($_POST['comments'])   : '';


$user = '3254';

$message .= "&#8855; <b>".$objet."</b> &#8855;"."\n";
$message .= "\n";
#$message .= "<b>Site</b> : ".$site."\n";
$message .= "&#8226; <b>Service</b> &rarr; ".$service."\n";
$message .= "&#8226; <b>Responsable</b> &rarr;  ".$responsable."\n";
$message .= "&#8226; <b>Tel</b> &rarr; ".$tel."\n";
$message .= "&#8226; <b>Courriel</b> &rarr; ".$courriel."\n";
#$message .= "<b>Date effet</b> : ".$dateeffet."\n";
if ($typecompte == "Nominatif")
        {$message .= "&#8226; <b>Type Compte </b>: ".$typecompte."\n";
        $message .= "&#8226; <b>Compte Nom & prnom </b>: ".$comptenom." ".$compteprenom."\n";
        $tempObjet = $comptenom." ".$compteprenom;
        $nomination = '['.$comptenom.' '.$compteprenom.']';}
else
        {$message .= "&#8226; <b>Type Compte</b>&rarr; Generique"."\n";
        $message .= "&#8226; <b>Compte </b>&rarr; ".$comptegen."\n";
        $tempObjet = $comptegen;
        $nomination = '['.$comptegen.']';}

$message .= "\n";
if ($TypeWin == "TypeWin")
        {$message .= "&#8853; <b> WINDOWS / CITRIX </b> &#8853;"."\n";
        $message .= "&#8226; <b>Dossier perso </b> &rarr; ".substr($dossierperso,-3)."\n";
        $message .= "&#8226; <b>Imprimante </b> &rarr; ".$imprimante."\n";
        $message .= "&#8226; <b>Partage </b> &rarr; ".quotemeta($partage)."\n";
        $message .= '&#8226; <b>Applications</b> &rarr; '.$Office."-".$CEGID."-".$Chimio."-".$Hestia."-".$Hemadia."-".$Expertiz."-".$CV."-".$Lora."-".$OptimOPM."-".$OptimSPM."-".$Octime."-".$SIR5."-".$USISTAFF."-".$Diane."-".$Gynelog."\n";
        $message .= "  ".$autreLogiciels."\n";
        $message .= "\n";
        }
if ($TypeSigems == "TypeSigems")
        {$message .= "&#8853; <b> SIGEMS </b> &#8853;"."\n";
        $message .= "&#8226; <b> Env. Sigems </b> &rarr; ".$sigGBNALog."-".$sigPBNA."-".$sigPBRD."-".$sigNCBA."-".$sigCARC."-".$sigPBCA."-".$sigCOTH."\n";
        $message .= "&#8226; <b> Modules Sigems </b> &rarr; ". $GestAdmin."-".$Comptabilite."-".$StockPl."-".$StockEco."-".$StockPUI."-".$StockBio."-".$StockProt."-".$Bloc."-".$SaisieBloc."-".$TableauMural."-".$PMSI."\n";
        $message .= "  ".$autreSigems."\n";
        $message .= "\n";
        }
if ($TypeMail == "TypeMail")
        {$message .= "&#8853; <b> NOTES </b> &#8853;"."\n";
        $message .= "&#8226; <b> Je veux un compte IBM Notes @bordeauxnord.com </b>"."\n";
        $message .= "\n";
        }
if ($TypeSignature == "TypeSignature")
        {$message .= "&#8853; <b>SIGNATURE EMAIL </b> &#8853;"."\n";
        $message .= "&#8226; <b> Fonction </b> &rarr; ".$Fonction."\n";
        $message .= "&#8226; <b> Tel </b> &rarr; ".$TelSign."\n";
        $message .= "&#8226; <b> Mobile </b> &rarr; ".$MobSign."\n";
        $message .= "&#8226; <b> Fax </b> &rarr; ".$FaxSign."\n";
        $message .= "&#8226; <b> email </b> &rarr; ".$Email."\n";
        $message .= "\n";
        }

$message .= "&#8855; <b> COMMENTAIRES </b> &#8855; ".$comments."\n";




# On recupere l'ID de ticket le plus haut dans la base

$sql="SELECT IFNULL(MAX(id),0)+1 FROM glpi_tickets";
      $sqlquery=mysqli_query($con,$sql) ;
      $sqlrowid=mysqli_fetch_array($sqlquery) ;
      $id=$sqlrowid[0];


      mysqli_free_result($sqlquery) ;

#$date = date('Y-m-d H:i:s', strtotime($timestamp_initial."+".$dateeffet." days"));

$objet .= ' '.$nomination;

$sql2 = "INSERT INTO glpi_tickets(entities_id, name, date, date_mod, status, users_id_recipient, content, urgency, impact, priority,type, itilcategories_id, requesttypes_id, date_creation, due_date)";
$sql2 .= " VALUES ('$site','$objet','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."', '1', '$id', '$message', '3','3','3','2','49','1','".date('Y-m-d H:i:s')."','$dateeffet')";

mysqli_query($con, $sql2);

$sql3 = "SELECT * FROM glpi_tickets WHERE id = '$id'";
$result = mysqli_query($con, $sql3);
$row = mysqli_fetch_array($result);
if (isset($row['name'])) {
  if (($row['name']) != "") {
    $success = 1;
  }
}elseif (!isset($row['name'])) {


  $_SESSION['site'] = $_POST['site'];
  $_SESSION['service'] = $_POST['service'];
  $_SESSION['responsable'] = $_POST['responsable'];
  $_SESSION['dateeffet'] = $_POST['dateeffet'];
  $_SESSION['Nom'] = $_POST['Nom'];
  $_SESSION['Prenom'] = $_POST['Prenom'];
  $_SESSION['courriel'] = $_POST['courriel'];


  header("Location: demandeCompte.php?empty=yes");
  exit();


}



if (isset($courriel)) {
  if (filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
    shell_exec('echo "'.'Votre demande a bien ete prise en compte\n\nTicket : '.$id.'\n\nBien Cordialement \n\nContact : '.'support.informatique@bordeauxnord.com'.'"| mail -s "'.'Ticket '.$id.' ouvert'.'" '.$courriel.' -a From:support.informatique@bordeauxnord.com');
  }
}
?>

<html>

  <header>
    <div class="col-sm-offset-4 col-sm-5">
      <img src="gbna_clinique.png" class="img-responsive" height="190" width="800" class="img-circle" alt="...">
    </div>
    <?php scriptHeader(); ?>
  </header>

  <body>
    <div class="col-sm-8 col-md-offset-2">

      <?php
      $script = '';
      $script .= '<h1 class="alert alert-success" style=" text-align: center;">Votre demande a bien été prise en compte</h1>';
      $script .= '<h2 class="alert alert-info" style=" text-align: center;"> Le numéro de vote demande est le : '.'<p style="color: red;">'.$id.'</p>'.'Veuillez conserver ce numéro </br> </h2>';
      print($script);

      ?>
    </div>
    </body>
</html>
