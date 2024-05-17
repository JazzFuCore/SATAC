<style>
  a {
    color: #007bff;
    text-decoration: none;
    transition: color 0.3s ease;
    border: 1px solid #007bff;
    padding: 5px 10px;
    border-radius: 4px;
  }

  a:hover {
    color: #0056b3;
    border-color: #0056b3;
  }
</style>

<?php

if(isset($_POST['executar_python'])) {
    echo '<a href="index.html"> <--  Voltar</a><br>';

    // Executar o programa Python
    $output = shell_exec('conda run -n ab_1 python inserir_contador_temetra.py');
    echo "<pre>$output</pre>";
} else {
    echo '<meta http-equiv="refresh" content="3;url=index.html">';
}
?>