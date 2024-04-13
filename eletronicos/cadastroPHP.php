<?php

    session_start();
    // Configuração das variáveis de conexão
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "estoque";

    // Criando e testando a conexão
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_set_charset($conn, "utf8");

    //Armazena as informações passadas no cadastro e as armazena em uma variável
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    //Verifica se o email já está cadastrado no código
    $sql = "SELECT * FROM funcionarios WHERE email = '$email'";
    $result = $conn->query($sql);
    //Se o email já existir, ele irá redirecionar para a página de login e mandar uma mensagem pedindo que insira a senha
    if ($result->num_rows > 0) {
        $_SESSION['mensagem'] = "E-mail já cadastrado, por favor insira a sua senha!";
        header('Location: index.php');
    } else {

        //Montagem da consulta SQL e execução
        $sql = "INSERT INTO `funcionarios`(`nome`, `sobrenome`, `email`, `senha`) VALUES ('$nome','$sobrenome','$email','$senha')";

        //Já caso o email não exista ele vai criar uma no conta no banco de dados "funcionários"
        if (mysqli_query($conn, $sql)) {
            echo "Dados inseridos com sucesso!";
            unset($_SESSION['mensagem']);
            header("Location: index.php");
        } else echo "Erro ao inserir dados: " . mysqli_error($conn);  
    }
    mysqli_close($conn); 
?>