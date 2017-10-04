<?php

function openDB(){

	$server='localhost';
	$user='glpi';
	$nomBDD='glpi';
	$pass='XwD**102';

	//ouverture de connexion

	$con=mysqli_connect($server, $user, $pass);


	//selection base de données
	mysqli_select_db($con, $nomBDD);
	return $con;

}
function openDB2(){

	$server='localhost';
	$user='glpi';
	$nomBDD='courriel';
	$pass='XwD**102';

	//ouverture de connexion

	$con2=mysqli_connect($server, $user, $pass);


	//selection base de données
	mysqli_select_db($con2, $nomBDD);
	return $con2;

}

function CloseDB($con){
	mysqli_close($con);
}

function linkCss(){
	$script='
		<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="bootstrap/js/bootstrap.js" />

        <link rel="stylesheet" href="bootstrap/js/jquery-3.1.1.js" />
        <link rel="stylesheet" href="style.css" />
        <link rel="shortcut icon" href="pc.png">';
	print ($script);
}
function linkcss2(){
$bootstrap = '<link href="assets/css/bootstrap.css" rel="stylesheet">';
$awesome = '<link href="assets/css/font-awesome.min.css" link rel="stylesheet">';
$main = '<link href="assets/css/main.css" link rel="stylesheet">';

print($bootstrap.$awesome.$main);
}

function linkmeta(){
$utf8='<meta charset="utf8">';
$scale ='<meta name="viewport" content="width=device-width, initial-scale=1.0">';
print($utf8.$scale);
}

function linkjs(){
$jquery = '<script src="assets/js/jquery-3.1.1.min.js"> </script>';
$js_boostrap = '<script src="assets/js/bootstrap.min.js"> </script>';
$modernizr = '<script src="assets/js/modernizr.custom.js"> </script>
<script src="assets/js/smoothscroll.js"></script>';
print($jquery.$js_boostrap.$modernizr);
}
function scriptHeader(){

    $script='   <div class="col-sm-offset-1 col-sm-10">
                <nav class="navbar navbar-inverse">
								<ul class="nav navbar-nav">
                    <li style="font-size: 16px;"><a href="accueil.php"><b>Accueil &#127968;</b></a></li>

                </ul>
                <ul class="nav navbar-nav">
                    <li style="font-size: 16px;"><a href="Ticket_Intra.php"><b>Ouvrir un ticket &#128232;</b></a></li>

                </ul>
                <ul class="nav navbar-nav">
                    <li style="font-size: 16px;"><a href="demandeCompte.php"><b>Demande de compte &#128100;</b></a></li>

                </ul>
                <ul class="nav navbar-nav">
                    <li style="font-size: 16px;"><a href="suivi.php" ><b>Etat des demandes &#128197;</b></a></li>

                </ul>
								<ul class="nav navbar-nav">
                    <li style="font-size: 16px;"><a href="dsihalerte.php" ><b>DSIH alerte &#128227;</b></a></li>

                </ul>

                </div>


          </nav>';
    print ($script);
}
# A rajouter dans le nav pour rendre accessible la page URGENCE INFORMATIQUE
#		<ul class="nav navbar-nav navbar-right">
#		<li><a href="urgenceInformatique.php"> <span style=" font-family: Arial black;" ><p id="urgent" style="font-size: 16px; color: red;">&#9940; URGENCE<br> INFORMATIQUE &nbsp;</p></span></a></li>
#		</ul>
function scriptFooter($i){
    if ($i==1) {

    $script=
    '<div>
        <div id="bas">
            <div class="containerbas">
                <div class="row">
                    <br>

                    <div class="col-sm-offset-4 col-sm-4">
                        <center>
                        <a href ="mailto:support.informatique@bordeauxnord.com"><img src="gbna_logo.png" height="110" width="160" class="img-circle" alt="..."></a>
                        <br>
                        <h3 class="footertext">Service informatique</h3>
												<h4 class="footertext">support.informatique@bordeauxnord.com</h4>
												<h4 class="footertext">05 57 22 58 20</h4>

                        </center>
                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>';
    }
    elseif ($i==2) {

    $script=
    '<div>
        <div id="bas">
            <div class="containerbas">
                <div class="row">
                    <br>
                    <div class="col-sm-offset-4 col-sm-5">
                    <img src="gbna_clinique.png" class="img-responsive" height="190" width="800" class="img-circle" alt="...">
                    </div>

                    <div class="col-sm-offset-4 col-sm-4">
                        <center>

                        <br>

                        </center>
                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>';
    }
    print($script);
}


?>
