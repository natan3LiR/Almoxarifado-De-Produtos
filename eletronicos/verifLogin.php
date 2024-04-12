<?php
    session_start();
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

    //Pega as informações enviadas do "index.php" e as armazena em uma variável
    $email_usuario = $_POST['email_usuario'];
    $senha = $_POST['senha'];

    //Faz uma consulta sql com base no email e senha enviados
    $sql = "SELECT * FROM funcionarios WHERE email = '$email_usuario' AND senha = '$senha'";
    $result = mysqli_query($conn, $sql);
    /*Se a consulta gerar resultado ou seja, se o email e senha estiverem no banco de dados de funcionários
    ele irá redirecionar para o dashboard*/
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) $saida[] = $row;
        /* "$_SESSION['status']", é usada para verificar se o usuário está entrando no dashboard do site
        passando pelo caminho por mim dado. Se esse elemento não existir o usuário não conseguirá entrar
        no dashboard*/
        $_SESSION['status'] = 1;
        foreach ($saida as $nome){
            /*Itera sobre a variável "saida" e armazena o nome do usuário na $_SESSION para fazer um interface
            mais interativa no dsahboard*/
            $_SESSION['nome'] = $nome['nome'];
        }
        header('Location: dashboard.php');
        
    } else {
        /*Caso a consulta não gerar resultado o email ou a senha estão incorretos, então ele redirecionará
        para "index"*/
        $_SESSION['mensagem'] = "E-mail ou senha incorretos!";
        header('Location: index.php');
    }
    mysqli_close($conn);
?>
