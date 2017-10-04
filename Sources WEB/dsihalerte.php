<?php
	include_once('fonction_glpi.php');
?>
<!DOCTYPE html>
<html >
	<head>
		<?php

			linkCss();
			if (isset($_POST['mdp'])) {
				if ($_POST['mdp']!="dsih33") {

					#header("Location: dsihalerte.php?mdp=err");
				}
			}
      if (!empty($_POST['del'])) {
				if ($_POST['mdp']=="dsih33") {
					$monfichier = fopen('alerte.txt', 'w+');
	        fseek($monfichier, 0);
	        fclose($monfichier);
				}
      }

      if ((!empty($_POST['message'])) and ($_POST['mdp']=="dsih33")) {

        $monfichier = fopen('alerte.txt', 'a');
        /*
        $contenu = fread($monfichier, filesize("alerte.txt"));

        for ($i=0; $i <= (filesize("alerte.txt")) ; $i++) {
          unset($contenu[$i]);
        }
        */

        fputs($monfichier, $_POST['message']);



        fclose($monfichier);
      }
      $monfichier = fopen('alerte.txt', 'r');
      fseek($monfichier, 0);
      $alerte = fgets($monfichier);
      fclose($monfichier);


		?>
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
        <form class="form-horizontal" role="form" method="post" action="dsihalerte.php" >
        <div class="col-sm-offset-3 col-sm-6 ">
          <div class="form-group">
            <div>
              <label for="comment" class="control-label" style="color: #282828; font-size: 18px;">Message d'alerte &#9888; </label>
            </div>
    		<textarea class="form-control" rows="6" name="message" id="comment" placeholder="<?php print($alerte); ?>"></textarea>
		  	</div>
			</div>
			<div class="col-sm-offset-3 col-sm-6">
				<div class="form-group">
					<div>
						<label for="mdp" class="control-label" style="color: #282828; font-size: 18px;">Mot de passe &#9919;	 </label>
					</div>
			<input type="password" class="form-control" name="mdp" placeholder="* * * * * *"></input>
			</div>
			</div>

					<div class="form-group">
								<div class="col-md-2 col-md-offset-5">
										<button type="submit" class="btn btn-primary btn-block" style="font-family: Helvetica;" ><b>Envoyer</b></button>
										<button type="reset" class="btn btn-danger btn-block">Annuler</button>
										<?php

							      $fichier = fopen('alerte.txt', 'r+');



							      $check = fgets($fichier);

							      fseek($fichier, 0);


							      if ($check!='') {
							        $script = '<button type="submit" name="del" value="del" class="btn btn-warning btn-block" style="font-family: Helvetica;" ><b>Supprimer alerte</b></button>';
							        print($script);
							      }
							      ?>
								</div>
						</div>
				</div>
      </form>


			</section>
			<footer>
				<?php scriptFooter(1); ?>
			</footer>
		</body>
</html>
