<?php
	include_once('fonction_glpi.php');
  $con = openDB();
?>
<!DOCTYPE html>
<html >
	<head>
		<?php

			linkCss();

		?>
		<title>Statistiques</title>
	</head>
		<body>

			<header>

        <?php linkmeta(); linkcss2(); linkjs();   ?>
        <script> src="Chart.js" </script>
			</header>

      <body data-spy="scroll" data-offset="0" data-target="#menu">
        <nav class="menu" id="theMenu">
          <div class="menu-wrap">
            <h1 class="logo">Menu</h1>
            <i class="icon-remove menu-close"></i>
            <a href="#home" class="smoothScroll">Haut de page</a>
          </div>
          <div id="menuToogle"><i class="icon-reorder"></i></div>
        </nav>

      <section id="home" name="home"></section>
        <div id="headerwrap">
          <div class="container">
            <div class="logo">
              <img src="assets/img/logo.png">
            </div>
            <br>
            <div class="row">
              <h1> D.S.I.H.</h1>
            <br>
            <h3> Statistiques </h3>
            <br>
            <br>
            <div class="col-lg-6 col-lg-offset-3">
            </div>
          </div>
        </div>
      </div>

			<section id="resultat" name="resultat"></section>

        <div id="f">
          <div class="container">
            <div class="row-centered">
              <div class="col-lg-6 col-lg-offset-3">
                <?php $hum='10'; $ent='60'; $pro='30'; ?>

                <canvas id="myChart" width="400" height="300" style="background-color: #455dc6; border-radius: 5px"></canvas>
                <script>
                var ctx = document.getElementById("myChart");
                //Chart.defaults.global.legend.display = false;
                Chart.defaults.global.defaultFontColor = '#fff';
                var myChart = new Chart(ctx, {
                scaleFontColor:"white",
                   type: 'bar',
                   data: {
                       labels: ["Humanisme", "Entrepreunariat", "Professionnalisme"],
                       datasets: [{
                           label: 'Pourcentage',
                           data: ['<?php echo $hum ; ?>','<?php echo $ent; ?>', '<?php echo $pro; ?>'],
                           backgroundColor: [
                               'rgba(255, 99, 132, 0.2)',
                               'rgba(54, 162, 235, 0.2)',
                               'rgba(255, 206, 86, 0.2)',
                               'rgba(75, 192, 192, 0.2)',
                               'rgba(153, 102, 255, 0.2)',
                               'rgba(255, 159, 64, 0.2)'
                           ],
                           borderColor: [
                               'rgba(255,99,132,1)',
                               'rgba(54, 162, 235, 1)',
                               'rgba(255, 206, 86, 1)',
                               'rgba(75, 192, 192, 1)',
                               'rgba(153, 102, 255, 1)',
                               'rgba(255, 159, 64, 1)'
                           ],
                           borderWidth: 1
                       }]
                   },
                   options: {

                       scales: {
                           yAxes: [{
                               ticks: {

                                   beginAtZero:true
                               }
                           }]
                       }
                   }
                });

                </script>
              </div>
            </div>
        </div>
      </div>


    </body>

  </html>
