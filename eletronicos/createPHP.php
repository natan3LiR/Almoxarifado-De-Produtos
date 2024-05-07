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

    //Recebe as informações do novo produto enviadas do documento "adicionar.php"
    $nome = $_POST['nome'];
    $descricao = $_POST['desc'];
    $qtd = (int)$_POST['qtd'];
    $preco = (float)$_POST['preco'];
    //MONTAGEM DA CONSULTA SQL E EXECUCAO
    $sql = "INSERT INTO `produtos`(`nome`, `descricao`, `quantidade`, `preco`) VALUES ('$nome','$descricao','$qtd','$preco')";

    //Insere os produtos na tabela "produtos"
    if (mysqli_query($conn, $sql)) {
        echo "Dados inseridos com sucesso!";
    } else echo "Erro ao inserir dados: " . mysqli_error($conn);

    mysqli_close($conn);
    header("Location: dashboard.php")
?>