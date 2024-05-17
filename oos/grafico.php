<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="/img/icon_g.png" type="image/png" />
    <title><?php if($_GET['id']) echo $_GET['id']; ?> - Gráfico de Valores</title>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script src="/js_lib/chart.js"></script>
    <style>
		@font-face {
			font-family: "myfont";
			src: url("/fonts/PTSans-Regular.ttf");
		}

		.use_font {
			font-family: myfont;
		}
	
        canvas {
            display: block;
            margin: auto;
        }

        .charts-container {
            display: flex;
            justify-content: center;
        }

        .chart-container {
            margin-right: 20px;
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
<body class="use_font">
    <h1>Gráfico de Valores - Nº instalação: <?php if($_GET['id']) echo $_GET['id']; ?></h1>
    <div>
        <form method="get" action="">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" style="width: 113px;">
            <input type="submit" value="ir">
			<label>&nbsp;&nbsp;&nbsp;

    <?php
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "";
    $password = "";
    $dbname = "satacDB";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verificar se o ID foi enviado via método GET
    if (isset($_GET['id'])) {
		 
		
        $id = $_GET['id'];
        $sql = "
		SELECT plum_ewebtel
		FROM `satacdb`.`contador_com_telemetria`
		WHERE id = '{$id}'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
			$nl_contadores = $result->fetch_assoc();
			if ($nl_contadores['plum_ewebtel'] == 1){
				echo "plataforma: Plum";
				$temetra = 0;
			} else {
				$temetra = 1;
				echo "plataforma: Temetra";
			}
		}
		?>
		</label>
        </form>
    </div>
	<br>
		
		<?php
        $id = $_GET['id'];
        $sql = "
		SELECT DATE(MAX(`data`)) AS dia, fluxo_min, valor_medicao, uso_dia_anterior
		FROM `satacdb`.`medicao`
		WHERE contador_com_telemetria_id = '{$id}'
		GROUP BY DATE(`data`)
		ORDER BY `data` DESC
		LIMIT 30";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // $values = [];
            // $label = [];
			$c_l = 1;
            while($row = $result->fetch_assoc()) {
					$dia_t[] = $row["dia"];
				if($c_l != 1){
					$label[] = $row["dia"];
				}
					if($temetra == 0){
						$values2[] = $row["fluxo_min"];
						$values3[] = $row["valor_medicao"];
					} else {
						$values2[] = ($row["fluxo_min"]/1000);
						$values3[] = ($row["valor_medicao"]/1000);
					}
					
				if($c_l != mysqli_num_rows($result)){
					if($temetra == 0){
						$values[] = $row["uso_dia_anterior"];
					} else {
						$values[] = ($row["uso_dia_anterior"]/1000);
					}
				}
				$c_l++;
            }
        } else {
            echo "Nenhum resultado encontrado para o ID especificado.";
        }
		
        $sql = "
		SELECT DATE(MAX(`data`)) AS dia, fluxo_min, valor_medicao
		FROM `satacdb`.`medicao`
		WHERE contador_com_telemetria_id = '{$id}'
		GROUP BY DATE(`data`)
		ORDER BY `data` DESC
		LIMIT 100
		";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
					$dia_t2[] = $row["dia"];
					
					if($temetra == 0){
						$values5[] = $row["valor_medicao"];
						$values6[] = $row["fluxo_min"];
					} else {
						$values5[] = ($row["valor_medicao"]/1000);
						$values6[] = ($row["fluxo_min"]/1000);
					}
					
            }
        }

        $sql = "SELECT `data`, `valor_medicao`  FROM `satacdb`.`medicao` WHERE `contador_com_telemetria_id` = '{$id}' ORDER BY `data` DESC LIMIT 200";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
					$diahora[] = $row["data"];
					
					if($temetra == 0){
						$values7[] = $row["valor_medicao"];
					} else {
						$values7[] = ($row["valor_medicao"]/1000);
					}
            }
        }
    }
    ?>

	<div class="charts-container">
		<div class="chart-container">
			<canvas id="myChart" width="400" height="400"></canvas>
		</div>
		<div class="chart-container">
			<canvas id="myChart2" width="400" height="400"></canvas>
		</div>
	</div>
	<br>
	<div class="charts-container">
		<div class="chart-container">
			<canvas id="myChart3" width="400" height="400"></canvas>
		</div>
		<div class="chart-container">
			<canvas id="myChart4" width="400" height="400"></canvas>
		</div>
	</div>
	<br>
	<div class="charts-container">
		<div class="chart-container">
			<canvas id="myChart5" width="800" height="400"></canvas>
		</div>
	</div>
	<br>
	<div class="charts-container">
		<div class="chart-container">
			<canvas id="myChart6" width="800" height="400"></canvas>
		</div>
	</div>
	<br>
	<div class="charts-container">
		<div class="chart-container">
			<canvas id="myChart7" width="1200" height="400"></canvas>
		</div>
	</div>
<br>
    <script>
		var data = {
			    labels: <?php echo json_encode($label); ?>,
                datasets: [{
                    label: 'consumo diário até 29 dias registados (m3/dia)',
                    data: <?php echo json_encode($values); ?>,
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.1
                }]
		};
		
		data.datasets[0].data = data.datasets[0].data.reverse();
		data.labels = data.labels.reverse();
		
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
		
		
		
		var data2 = {
			    labels: <?php echo json_encode($dia_t); ?>,
                datasets: [{
                    label: 'caudal mínimo até 30 dias registados (m3/h)',
                    data: <?php echo json_encode($values2); ?>,
                    borderColor: 'rgb(54, 162, 235)',
                    tension: 0.1
                }]
		};
		
		data2.datasets[0].data = data2.datasets[0].data.reverse();
		data2.labels = data2.labels.reverse();
		
        var ctx = document.getElementById('myChart2').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: data2,
            options: {
                scales: {
                    y: {
                        min: -1,
                        max: 1
                    }
                }
            }
        });
		
		
		
		var data3 ={
			    labels: <?php echo json_encode($dia_t); ?>,
                datasets: [{
                    label: 'volume acumulado até 30 dias registados (m3)',
                    data: <?php echo json_encode($values3); ?>,
                    borderColor: 'rgb(54, 162, 235)',
                    tension: 0.1
                }]
		};
		
		data3.datasets[0].data = data3.datasets[0].data.reverse();
		data3.labels = data3.labels.reverse();
		
        var ctx = document.getElementById('myChart3').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: data3,
            options: {
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
		
		
		
		var data4 = {
			    labels: <?php echo json_encode($dia_t); ?>,
                datasets: [{
                    label: 'caudal mínimo até 30 dias registados (m3/h)',
                    data: <?php echo json_encode($values2); ?>,
                    borderColor: 'rgb(54, 162, 235)',
                    tension: 0.1
                }]
		};
		
		data4.datasets[0].data = data4.datasets[0].data.reverse();
		data4.labels = data4.labels.reverse();
		
		var ctx = document.getElementById('myChart4').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: data4,
            options: {
                scales: {
                    y: {
						beginAtZero: true
                    }
                }
            }
        });
		
		
		
		var data5 = {
	            labels: <?php echo json_encode($dia_t2); ?>,
                datasets: [{
                    label: 'volume acumulado até 100 dias registados (m3)',
                    data: <?php echo json_encode($values5); ?>,
                    borderColor: '#ff7f0e',
                    tension: 0.1
                }]
		};
		
		data5.datasets[0].data = data5.datasets[0].data.reverse();
		data5.labels = data5.labels.reverse();
		
		var ctx = document.getElementById('myChart5').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: data5,
            options: {
                scales: {
                    y: {
						beginAtZero: false
                    }
                }
            }
        });
		
		
		
		var data6 = {
                labels: <?php echo json_encode($dia_t2); ?>,
                datasets: [{
                    label: 'caudal mínimo até 100 dias registados (m3/h)',
                    data: <?php echo json_encode($values6); ?>,
                    borderColor: '#ff7f0e',
                    tension: 0.1
                }]
 
		};
		
		data6.datasets[0].data = data6.datasets[0].data.reverse();
		data6.labels = data6.labels.reverse();
		
		var ctx = document.getElementById('myChart6').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: data6,
            options: {
                scales: {
                    y: {
						beginAtZero: true
                    }
                }
            }
        });
		
		
		
		var data7 = {
			    labels: <?php echo json_encode($diahora); ?>,
                datasets: [{
                    label: 'volume acumulado até 200 registos (m3)',
                    data: <?php echo json_encode($values7); ?>,
                    borderColor: '#000',
                    tension: 0.1
                }]
		};
		
		data7.datasets[0].data = data7.datasets[0].data.reverse();
		data7.labels = data7.labels.reverse();
		
		var ctx = document.getElementById('myChart7').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: data7,
            options: {
                scales: {
                    y: {
						beginAtZero: false
                    }
                }
            }
        });
    </script>
</body>
<footer style="font-family: myfont; padding: 6px 6vh;">
	<p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/"><a property="dct:title" rel="cc:attributionURL" href="https://github.com/JazzFuCore/SATAC">SATAC</a> by <a rel="cc:attributionURL dct:creator" property="cc:attributionName" href="https://github.com/JazzFuCore">Frederico Jorge Café</a> is licensed under <a href="https://creativecommons.org/licenses/by-sa/4.0/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">Creative Commons Attribution-ShareAlike 4.0 International<img src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" onerror="this.src='/img/cc.svg';" alt=""><img src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" onerror="this.src='/img/by.svg';" alt=""><img src="https://mirrors.creativecommons.org/presskit/icons/sa.svg?ref=chooser-v1" onerror="this.src='/img/sa.svg';" alt=""></a></p>
</footer>
</html>
