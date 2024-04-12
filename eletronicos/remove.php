<?php
    // CONFIGURACAO DAS VARIAVEIS DE CONEXAO
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "estoque";

    // CRIANDO E TESTANDO A CONEXAO
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_set_charset($conn, "utf8");

    //Insere o id enviado do "dashboard.php" na variável delete
    $delete = $_GET['id'];
    
    //Faz uma consulta sql para deletar o produto com base no id
    $sql = "DELETE FROM produtos WHERE id = $delete;";
    $result = mysqli_query($conn, $sql);

    //VERIFICANDO SE A CONSULTA GEROU RESULTADOS
    if ($result) {
        echo "Registro deletado com sucesso";
    } else {
        echo "Erro ao deletar registro: " . mysqli_error($conn);
    }

    //ENCERRA A CONEXAO
    mysqli_close($conn);
    header("Location: dashboard.php"); 
?>