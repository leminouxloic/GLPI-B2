<?php
	include_once('fonction_glpi.php');

	if (!isset($_GET['empty'])) {
		session_start();
		session_unset();
		session_destroy();
	}

	session_start();

	$con=openDB();

?>
<!DOCTYPE html>
<html>
	<head>
		<?php linkCss(); ?>
		<title> Suivi Ticket </title>
		<script type="text/javascript">
		function blinker(id,c1,c2)
		{
		       elm = document.getElementById(id);
		       setTimeout(function() {setInterval(function () {elm.style.color=c1;},1000);},500);
		       setInterval(function () {elm.style.color=c2;},1000);
		}
		</script>
	</head>
		<body>



			<header>
				<div class="col-sm-offset-4 col-sm-5">
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

        <div class="container">

          <div class="col-sm-8 col-sm-offset-2">

            <div>


              <form class="form-horizontal" role="form" method="post" action="suivi.php">
                <div class="form-group">
                      <label for="Name" class="col-sm-4 control-label" >Recherche n°ticket : </label>
                      <div class="col-sm-5" >
                          <input type="text" name="idsuivi" placeholder="Exemple : 21580" class="form-control" autofocus><br>
                          <button type="submit" class="btn btn-primary btn-block" style="font-family: Helvetica;" ><b>Envoyer &#10003;</b></button>
													<?php $script ='<a href="suivi.php" class="btn btn-danger btn-block" style="font-family: Helvetica;"><b>Retour &#10007;</b></a>';
														if ((isset($_POST['idsuivi'])) or (isset($_GET['idsuivi']))) {
															print($script);
														}
														?>

                      </div>
                  </div>
              </form>


            <?php
              if ((isset($_POST['idsuivi'])) or (isset($_GET['idsuivi']))) {

								if (isset($_POST['idsuivi'])) {
									$id  = $_POST['idsuivi'];
								}elseif (isset($_GET['idsuivi'])) {
									$id  = $_GET['idsuivi'];
								}


                $sql2 = "SELECT id,name,status FROM glpi_tickets WHERE id="."$id";
                $sqlquery2 = mysqli_query($con, $sql2);
                $script = '<table class="table">';
                $script .= "
                <thead>
                  <th> ID - Numéro de ticket </th>
                  <th> Objet </th>
                  <th> Etat du ticket </th>
                </thead>";
                while ($sqlrowid2 = mysqli_fetch_array($sqlquery2)) {
                  switch ($sqlrowid2['status']) {
                    case "1":
                        $status = "En attente de traitement";
                        $couleur = "active";
                      break;
                    case "6":
                        $status = "Clos";
                        $couleur = "success";
                      break;
                    case '5':
                        $status = "Clos";
                        $couleur = "success";
                      break;
                    case '2':
                        $status = "En cours de traitement";
                        $couleur = "info";
                      break;
                    case '3':
                        $status = "En cours de traitement";
                        $couleur = "info";
                      break;
                    case '4':
                        $status = "En attente de traitement";
                        $couleur = "active";
                      break;
                    default:
                        $status = "Inconnu";
                      break;
                  }
                  $script .= '<tr class=" '."$couleur".'">';
                  $script .= '<td>'.$sqlrowid2['id'].'</td>';
                  $script .= '<td>'.utf8_encode($sqlrowid2['name']).'</td>';

                  }
                  $script .= '<td>'.$status.'</td>';
                  $script .= '</tr>';


                $script .= '</table>';
                print($script);
                mysqli_free_result($sqlquery2);

              }else {


                $sql="SELECT IFNULL(MAX(id),0)+1 FROM glpi_tickets";
                      $sqlquery=mysqli_query($con,$sql) ;
                      $sqlrowid=mysqli_fetch_array($sqlquery) ;
                      $id=$sqlrowid[0];
                      $id -= 50;



                    mysqli_free_result($sqlquery) ;


                $sql2 = "SELECT id,name,status FROM glpi_tickets WHERE id>"."$id"." ORDER BY id DESC";
                $sqlquery2 = mysqli_query($con, $sql2);
                $script = '<table class="table table-striped">';
                $script .= "
                <thead>
                  <th> ID - Numéro de ticket </th>
                  <th> Objet </th>
                  <th> Etat du ticket </th>
                </thead>";
                while ($sqlrowid2 = mysqli_fetch_array($sqlquery2)) {
									switch ($sqlrowid2['status']) {
                    case "1":
                        $status = "En attente de traitement";
                        $couleur = "active";
                      break;
                    case "6":
                        $status = "Clos";
                        $couleur = "success";
                      break;
                    case '5':
                        $status = "Clos";
                        $couleur = "success";
                      break;
                    case '2':
                        $status = "En cours de traitement";
                        $couleur = "info";
                      break;
                    case '3':
                        $status = "En cours de traitement";
                        $couleur = "info";
                      break;
                    case '4':
                        $status = "En attente de traitement";
                        $couleur = "active";
                      break;
                    default:
                        $status = "Inconnu";
                      break;
                  }
                  $script .= '<tr class=" '."$couleur".'">';
                  $script .= '<td>'.$sqlrowid2['id'].'</td>';
                  $script .= '<td>'.utf8_encode($sqlrowid2['name']).'</td>';

                  $script .= '<td>'.$status.'</td>';
                  $script .= '</tr>';

                }
                $script .= '</table>';
                print($script);
                mysqli_free_result($sqlquery2);
              }
               ?>

             </div>
           </div>
         </div>
      </section>
    </body>
</html>
