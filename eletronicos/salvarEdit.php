<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "estoque";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

    //Pega as novas informações enviadas de "edit.php" e colocá-as em uma variável
    $nome=$_POST['nome'];
    $descricao=$_POST['desc'];
    $quantidade=$_POST['qtd'];
    $preco=$_POST['preco'];
    $codigo = $_POST['id'];

    //Faz uma consulta sql de uptade com as novas informações enviadas
    $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', quantidade='$quantidade', preco='$preco'  WHERE id=$codigo";

    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
    } else {
    echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>