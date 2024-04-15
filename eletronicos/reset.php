<?php
        /* Quando a pessoa clicar em "apagar tabela" será redirecionada para está página onde irá apagar 
        totalmente os conteúdos da tabela e resetar o id*/
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

        //MONTAGEM DA CONSULTA SQL E EXECUCAO
        $sql = "SET FOREIGN_KEY_CHECKS = 0";

        //VERIFICANDO SE A CONSULTA GEROU RESULTADOS
        if (mysqli_query($conn, $sql)) {
            echo "Dados deletados com sucesso!";
        } else echo "Erro ao deletar tablela: " . mysqli_error($conn);

        $sql = "TRUNCATE TABLE produtos";

        if (mysqli_query($conn, $sql)) {
            echo "Dados deletados com sucesso!";
        } else echo "Erro ao deletar tablela: " . mysqli_error($conn);

        $sql = "ALTER TABLE produtos AUTO_INCREMENT = 1;";

        if (mysqli_query($conn, $sql)) {
            echo "Dados deletados com sucesso!";
        } else echo "Erro ao deletar tablela: " . mysqli_error($conn);

        $sql = "SET FOREIGN_KEY_CHECKS = 1;";

        if (mysqli_query($conn, $sql)) {
            echo "Dados deletados com sucesso!";
        } else echo "Erro ao deletar tablela: " . mysqli_error($conn);

        header("Location: dashboard.php")
    ?>