<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="icon" href="/img/icon.png" type="image/png" />
	<title>ALARMES</title>

	<style>
		/*    ###   --- carregamento das fontes ---   ###    */
		/*    ###   --- carregamento das fontes ---   ###    */
		/*    ###   --- carregamento das fontes ---   ###    */


		@font-face {
			font-family: "myfont";
			src: url("/fonts/PTSans-Regular.ttf");
		}

		.use_font {
			font-family: myfont;
		}

		@font-face {
			font-family: "myfont-bold";
			src: url("/fonts/PTSans-Bold.ttf");
			font-weight: bold;
		}

		.use_font_bold {
			font-family: myfont-bold;
		}



		/*    ###   --- definição do body ---   ###    */
		/*    ###   --- definição do body ---   ###    */
		/*    ###   --- definição do body ---   ###    */


		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
			background: linear-gradient(to bottom, #cafe, #fff 1.3%);
			height: 100vh;
			background-repeat: no-repeat;
		}

		.content {
			color: #2c2c2c;
			padding-right: 3vh;
			padding-left: 3vh;
			padding-top: 9vw;
		}



		/*    ###   --- barra menu superior ---   ###    */
		/*    ###   --- barra menu superior ---   ###    */
		/*    ###   --- barra menu superior ---   ###    */


		.menu-bar-op {
			font-family: myfont-bold;
			position: fixed;
			background-color: #00000000;
			width: 100%;
		}

		.menu-bar-op-items ul li {
			list-style: none;
			margin: 0;
			padding: 0;
			text-align: left;
		}

		.menu-bar-op-items ul li ul,
		#buttonGrid {
			position: absolute;
			top: 13px;
			left: 0;
			background-color: #cd79799b;
			display: none;
		}

		.menu-bar {
			font-family: myfont-bold;
			position: fixed;
			background-color: rgba(250, 235, 215, 0.637);
			padding: 6px 0px;
			width: 100%;
		}

		.menu-items {
			list-style: none;
			margin: 0;
			padding: 0;
			text-align: center;
		}

		.menu-items td,
		.menu-items p {
			display: inline-block;
			margin-right: 10px;
		}

		.menu-items td p a {
			border-style: groove;
			border-color: aqua black gold aquamarine;
			background-color: #efefef;
			color: #000000;
			text-decoration: none;
			padding: 10px;
			transition: background-color 0.3s;
			border-radius: 6%;
		}

		.menu-items td p a:hover {
			background-color: #c3c3c3;
		}



		/*    ###   --- botão topo ---   ###    */
		/*    ###   --- botão topo ---   ###    */
		/*    ###   --- botão topo ---   ###    */


		#btnVoltarTopo {
			display: none;
			position: fixed;
			bottom: 20px;
			right: 20px;
			z-index: 99;
			font-size: 16px;
			background-color: #007bff;
			color: white;
			border: none;
			border-radius: 5px;
			padding: 10px 20px;
			cursor: pointer;
		}

		#btnVoltarTopo:hover {
			background-color: #0056b3;
		}
		
		.links a {
			color: blue;
			text-decoration: none;
			transition: color 0.3s;
		}

		.links a:hover {
			color: red;
		}
		
		
		
		
		.popup {
			display: none;
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			background-color: rgba(0, 0, 0, 0.5);
			padding: 20px;
			border-radius: 5px;
			color: white;
			z-index: 9999;
		}

		.popup-content {
			text-align: center;
		}

		.popup-close {
			position: absolute;
			top: 10px;
			right: 10px;
			cursor: pointer;
		}
		
		
		
		
		
		.button_bar {
			display: inline-block;
			padding: 3px 13px;
			font-size: 14px;
			text-align: center;
			text-decoration: none;
			border: 2px solid mediumaquamarine;
			border-radius: 5px;
			color: #333;
			background-color: #f9f9f9;
			cursor: pointer;
			transition: background-color 0.3s, border-color 0.3s, color 0.3s;
		}

		.button_bar:hover {
			background-color: #eaeaea;
		}

		.button_bar:active {
			background-color: #ddd;
			border-color: #999;
			color: #222;
		}
		
		
		
				
		
		#imagem-sobreposta {
			position: absolute;
			top: 1px;
			left: 6px;
			z-index: 9999;
			pointer-events: none;
		}

		#imagem-sobreposta img {
			width: 128px;
			height: auto;
		}
		
		
		
		.button_dir {
			color: rgb(245, 215, 173);
			position: absolute;
			top: 10px;
			right: 10px;
		}
		
		.button_dir:hover{
			color:  rgb(240, 196, 136);
		}
		
		
		
		footer {
			color: #999;
		}

		footer img {
			height: 1em;
		}
		footer a {
			color: #999;
			transition: color 0.3s;
		}

		footer a:hover {
			color: blue;
		}
	</style>

</head>

<body>
	<div id="cookie"></div>
	<top>
		<center>
			<div class="menu-bar">
				<div id="imagem-sobreposta">
					<img src="/img/satac.png">
				</div>
				<table class="menu-items">
					<tr>
						<td>
							<p><button class="button_bar" onclick="window.location.href='/pesquisar/index.php'">PESQUISAR</button></p>
						</td>
						<td>
							<p><a href="/alarmes/index.php">ALARMES</a></p>
						</td>
						<td>
							<p><a href="/contadores/index.php">CONTADORES</a></p>
						</td>
						<td>
							<p><a href="/ficheiros/index.html">FICHEIROS</a></p>
						</td>

					</tr>
				</table>
				<a href="/oos/lic.html" class="button_dir">License</a>
			</div>
		</center>
	</top>
	<div class="content use_font">


<?php

			$linhas_pag = 200;
			
            // Conecte-se ao banco de dados
            $servername = "localhost";
            $username = "";
            $password = "";
            $database = "satacDB";
            
            $conn = new mysqli($servername, $username, $password, $database);
            $conn2 = new mysqli($servername, $username, $password, $database);
            
            // Verifique a conexão
            if ($conn->connect_error) {
                die("Erro na conexão: " . $conn->connect_error);
            }
			
            // Verifique a conexão 2
            if ($conn2->connect_error) {
                die("Erro na conexão: " . $conn2->connect_error);
            }
			
			?>
    <h1>ALARMES</h1>
		<?php
		
		$sql = "SELECT COUNT(*) FROM `contador_com_telemetria`";
        $result = $conn->query($sql);
		$num_pag = $result->fetch_assoc();
		$num_pag = $num_pag['COUNT(*)'];
		$num_pag = ceil($num_pag / $linhas_pag);
		
		?>
	<form action="" method="GET">
		<label for="texto">página:</label>
		<input type="text" id="texto" name="pag" style="width: 14px;" value='<?php if(isset($_GET['pag']))echo $_GET['pag']; ?>' >
		<spam> / <?php echo $num_pag ?> </spam>
		<input type="submit" value="ir">
		<br>
		<input type="submit" name="olf" value="Ordenar Linhas por Fuga">
	</form>
	<center class="links">
		<?php 
		
		$Ss = 3;  // nº de indices
		if(array_key_exists("pag", $_GET)){
			$pag_s = intval($_GET['pag']);
			if($pag_s <= 0){
				$pag_s = 1;
			}
			if($pag_s > $num_pag){
				$pag_s = $num_pag;
			}
		} else {
			$pag_s = 1;
		}
		
		$pag_in = max($pag_s - $Ss, 1);
		$pag_fn = min($num_pag, $pag_s + $Ss);
		
		
		for($p = $pag_in; $p <= $pag_fn; $p++){
			if($p == $pag_s){
				echo "<spam> -[$p]- </spam>";
			} else {
				echo "<a href='?pag={$p}";
				if(array_key_exists("olf", $_GET)){
					echo "&olf=1";
				}
				echo "'> -{$p}- </a>";
			}
		}
		

		?>
	</center>
	<br>
	<center>
    <table border="3">
        <thead>
            <tr>
				<th>Nº linhas</th>
                <th>Plataforma</th>
                <th>Número de Instalação</th>
                <th>Nome</th>
                <th>Gráfico</th>
                <th>Leitura [5 dias registados] (<a href="#" class="popup-trigger1">1</a>)</th>
                <th>Perdas – Gastos constantes [7 dias registados] (<a href="#" class="popup-trigger">2</a>)</th>
                <th>Classificação de consumidores [60 dias registados] (2)</th>
            </tr>
        </thead>
        <tbody>
			<?php
			
			
			$offset =  $linhas_pag * ( $pag_s - 1 );
			
			if(array_key_exists("olf", $_GET)){
			
				$sql = "
				WITH UltimosRegistros AS (
					SELECT contador_com_telemetria_id, 
						   AVG(fluxo_min) AS media_fluxo
					FROM (
					SELECT contador_com_telemetria_id, 
							   fluxo_min,
							   ROW_NUMBER() OVER (PARTITION BY contador_com_telemetria_id ORDER BY `data` DESC) AS rank
						FROM `satacDB`.`medicao`
					) sub
					WHERE RANK <= 3
					GROUP BY contador_com_telemetria_id
				)
				SELECT *
				FROM `satacDB`.`contador_com_telemetria` t1
				JOIN UltimosRegistros u ON t1.id = u.contador_com_telemetria_id
				ORDER BY u.media_fluxo DESC
				LIMIT {$linhas_pag} OFFSET $offset
				";
			} else {
				$sql = "SELECT * FROM `contador_com_telemetria` ORDER BY `plum_ewebtel`,`id` DESC LIMIT {$linhas_pag} OFFSET $offset";
			}
            $result = $conn->query($sql);
			
			$conta_lin = $offset;
			
			while($nl_contadores = $result->fetch_assoc()){ ?>
				<tr>
					<td><?php 
					$conta_lin++;
					echo $conta_lin;
					?></td>
					<td><?php 
					if ($nl_contadores['plum_ewebtel'] == 1){
						echo "Plum";
					} else {
						echo "Temetra";
					}
					?></td>
					<td><?php 
					$id = $nl_contadores['id'];
					echo $nl_contadores['id'];
	
					?></td>
					<td><?php echo $nl_contadores['nome'];?></td>
					<td class="links"><?php echo "<a href='/oos/grafico.php?id={$id}' target='_blank'> -- Gráfico -- </a>" ?></td>

					
					<?php
					
					$sql2="
					SELECT DATE(MAX(`data`)) AS dia, fluxo_min, valor_medicao, uso_dia_anterior
					FROM `satacdb`.`medicao`
					WHERE contador_com_telemetria_id = '{$id}'
					GROUP BY DATE(`data`)
					ORDER BY `data` DESC
					LIMIT 60 OFFSET 1
					";
					$result2 = $conn2->query($sql2);
					
					
					if (mysqli_num_rows($result2) > 7) {   // nemos de 7 dias não é possivel fazer as contas
						
						$total5 = 0;
						$total7 = 0;
						$total60 = 0;
						
						$conta = 0;
						
						$f1 = 0;
						$f_2 = 0;
						
						for($i=0; $i<= mysqli_num_rows($result2)-1; $i++){
							$res = $result2->fetch_assoc();
							
							if($i<=4){
								$conta++;
								$ultValor = $res['valor_medicao'];
								$total5 += $res['valor_medicao'];
							}
							
							
							if($i<=6){
								if($res['fluxo_min'] == 0 && $f_2 == 0){
									$f_2 = 1;
								}
								$total7 += $res['fluxo_min'];
							}
							
							$total60 += $res['uso_dia_anterior'];
							
						}
						
						if($ultValor != 0){
							$partido = ($total5/$conta)/$ultValor;
						} else {
							$partido =  0;
						}
						
						$f1=1;
					
					}
					
					
					
					
					?>

					<td><?php 
					if($partido == 1 && $f1 == 1){
						echo "<p style='color: #f30;'>|| parado ||";
					} elseif($partido = 0 && $f1 == 1) {
						echo "<p style='color: #333;'>|| sem início ||";
					} else {
						echo "<p style='color: #0cf;'>|||||||";
					}
					
					?></td>
					
					<td><?php
					
					if($total7 > 0 && $f_2 == 0){
						echo "<p style='color: #f30;'>|| fluxo positivo ||";
					} elseif($total7 < 0 && $f_2 == 0) {
						echo "<p style='color: #f0f;'>|| fluxo negativo ||";
					} else {
						echo "<p style='color: #0cf;'>|||||||";
					}
					
					?></td>
					
					<td><?php 
					if($total60 >= 100 && $total60 < 150 && $f1 == 1){
						echo "<p style='color: #00e500;'>|| > 50m3 / mês ||";
					} elseif($total60 >= 150 && $total60 < 200 && $f1 == 1){
						echo "<p style='color: #fc0;'>|| > 75m3 / mês ||";
					} elseif($total60 >= 200 && $f1 == 1) {
						echo "<p style='color: #f00;'>|| > 100m3 / mês ||";
					} else {
						echo "<p style='color: #0cf;'>|||||||";
					}
					
					?></td>
					
				</tr>
			<?php
			}
			
            $conn->close();
            $conn2->close();
			
            ?>
        </tbody>
    </table>
	</center>
	<br>
	<center class="links">
	<?php 
	
		for($p = $pag_in; $p <= $pag_fn; $p++){
			if($p == $pag_s){
				echo "<spam> -[$p]- </spam>";
			} else {
				echo "<a href='?pag={$p}";
				if(array_key_exists("olf", $_GET)){
					echo "&olf=1";
				}
				echo "'> -{$p}- </a>";
			}
		}
	
	?>
	</center>
<br>
	</div>


	<div class="popup" id="popup">
		<div class="popup-content">
			<span class="popup-close" id="popup-close">&times;</span>
			<p><img src="2.png" width="100%"></p>
		</div>
	</div>

	<div class="popup" id="popup1">
		<div class="popup-content">
			<span class="popup-close" id="popup-close1">&times;</span>
			<p><img src="1.png" width="100%"></p>
		</div>
	</div>


	<!-- Botão Voltar ao Topo -->
	<button onclick="voltarAoTopo()" id="btnVoltarTopo" title="Voltar ao Topo">Topo</button>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const trigger = document.querySelector(".popup-trigger1");
			const popup = document.getElementById("popup1");
			const closeBtn = document.getElementById("popup-close1");

			trigger.addEventListener("click", function(event) {
				event.preventDefault();
				popup.style.display = "block";
			});

			closeBtn.addEventListener("click", function() {
				popup.style.display = "none";
			});
		});
	
		document.addEventListener("DOMContentLoaded", function() {
			const trigger = document.querySelector(".popup-trigger");
			const popup = document.getElementById("popup");
			const closeBtn = document.getElementById("popup-close");

			trigger.addEventListener("click", function(event) {
				event.preventDefault();
				popup.style.display = "block";
			});

			closeBtn.addEventListener("click", function() {
				popup.style.display = "none";
			});
		});
	
		// Função para mostrar ou esconder o botão conforme o usuário rola a página
		window.onscroll = function () { scrollFunction() };

		function scrollFunction() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				document.getElementById("btnVoltarTopo").style.display = "block";
			} else {
				document.getElementById("btnVoltarTopo").style.display = "none";
			}
		}

		function voltarAoTopo() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
	</script>

</body>
<footer style="font-family: myfont; padding: 6px 6vh;">
	<p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/"><a property="dct:title" rel="cc:attributionURL" href="https://github.com/JazzFuCore/SATAC">SATAC</a> by <a rel="cc:attributionURL dct:creator" property="cc:attributionName" href="https://github.com/JazzFuCore">Frederico Jorge Café</a> is licensed under <a href="https://creativecommons.org/licenses/by-sa/4.0/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">Creative Commons Attribution-ShareAlike 4.0 International<img src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" onerror="this.src='/img/cc.svg';" alt=""><img src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" onerror="this.src='/img/by.svg';" alt=""><img src="https://mirrors.creativecommons.org/presskit/icons/sa.svg?ref=chooser-v1" onerror="this.src='/img/sa.svg';" alt=""></a></p>
</footer>
</html>