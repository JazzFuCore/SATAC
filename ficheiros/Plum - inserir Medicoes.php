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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];
    $file_name = $file["name"];
    $file_tmp = $file["tmp_name"];
	// Verifica se a extensão do arquivo é .xlsx
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name = "a.xlsx";
    if ($file_ext !== "xlsx") {
        echo "<p>Apenas arquivos .xlsx são permitidos.</p>";
        echo '<meta http-equiv="refresh" content="3;url=index.html">';
        exit();
    }

    echo '<a href="index.html"> <--  Voltar</a>';

    if (move_uploaded_file($file_tmp, $file_name)) {
        echo "<p>File uploaded successfully.</p>";

        // Execute Python script
        $output = shell_exec("conda run -n ab_1 python inserir_medicao_plum.py");
        echo "<pre>$output</pre>";
    } else {
        echo "<p>Failed to upload file.</p>";
    }
}
?>