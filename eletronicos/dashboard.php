<?php
    //Caso um usuário tente entrar no dashboard usando a url ele será redirecionado para a página principal
    session_start();
    if(!isset($_SESSION['status'])) {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wix+Madefor+Text:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
    <!--link para o css do dashboard-->
    <link rel="stylesheet" type="text/css" href="CSSDashboard.css">
</head>
<body>
    <?php
        // CONFIGURACAO DAS VARIAVEIS DE CONEXAO
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "estoque";
        
        // CRIANDO E TESTANDO A CONEXAO
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        mysqli_set_charset($conn, "utf8");

        //Seleciona tudo que há na tabela produtos
        $sql = "SELECT * FROM produtos";
        $result = mysqli_query($conn, $sql);

        //Se a consulta gerar resultado irá armazenar tudo na variável "saida"
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) $saida[] = $row;
        }
    ?>
    <header class="header">
        <!--Navbar com a logo e dois links para a página "sobre" e "contato"-->
        <nav class="nav">
            <img src="Captura_de_tela_2024-03-25_164301-removebg-preview.png" alt="">
            <ul class="nav-list">
                <li><a href="">Sobre</a></li>
                <li><a href="">Contato</a></li>
            </ul>
            <div>
                <!--Mensagem de Bem-Vindo personalizada com nome inserido no cadastro-->
                <p>Bem-Vindo <?php echo $_SESSION['nome']?></p>
            </div>
            <img src="profile-removebg-preview.png" alt="">
        </nav>
    </header>
    <br>
    <div class="card">
        <a href="adicionar.php" class="botao">Adicionar Produto</a>
        <br> <br>
        <a href="reset.php" class="botao">Apagar Tabela</a>
    </div>
    <div class="ordenacao">
        <!--Lógica para se a variável "saida" estiver vazia não apareça os botões de ordenação-->
        <?php if (!empty($saida)) {?>
            <!--Da linha 68 a 193 contém uma lógica de ordenação para cada coluna da tabela. Com base no desejo do
            usuário, a variável "saida" irá fazer uma consulta de ordenação, e se o usuário não solicitar nenhuma 
            ordenação a tabela aparecerá normalmente-->
            <div class="ordenacaoNomeSelect">
                <!--Aparecerá um botão select com duas escolhas de ordenação: ascendente e decrescente. Quando o 
                usuário clicar, recarregará a página e irá entrar no "if" com base no "name"
                enviado pelo formulário-->
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="ordenarNome">Ordenação(Nome):</label>
                    <select id="ordenarNome" name="ordenaNome">
                        <?php
                            $ordenaNome = array("Ascendente", "Decrescente"); 
                            foreach($ordenaNome as $ordenaNome2) {
                                //Faz aparecer os nomes ascendente e decrescente com base no array
                                echo "<option value=\"$ordenaNome2\">$ordenaNome2</option>";
                            }
                        ?>
                    </select>
                    <input type="submit" value="Remeter">
                </form>
                <?php
                    //Verifica se foi enviado alguma requisição "POST" pro servidor
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        //Verifica se existe algum 'ordenaNome' enviado para o servidor.
                        if (isset($_POST['ordenaNome'])) {
                            //Coloca o 'ordenaNome' enviado em uma variável
                            $pedidoDeOrdenacao = $_POST['ordenaNome'];
                            /*Se a variável "pedidoDeOrdenacao" for 'Ascende', fará uma lógica que irá fazer uma
                            pesquisa no banco de dados para ordenar de forma ascendente a tabela, e com a tabela agora
                            devidamente ordenada, alterará a variável "saida". A mesma lógica funciona para os outros
                            campos de ordenação e caso o pedido de ordenação for 'Decrescente'.*/
                            if ($pedidoDeOrdenacao == "Ascendente") {
                                $saida = array();
                                $sql = "SELECT * FROM produtos ORDER BY nome ASC";
                                $result = mysqli_query($conn, $sql);
                                
                                //VERIFICANDO SE A CONSULTA GEROU RESULTADOS
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) $saida[] = $row;
                                } 
                            } elseif ($pedidoDeOrdenacao == "Decrescente") {
                                $saida = array();
                                $sql = "SELECT * FROM produtos ORDER BY nome DESC";
                                $result = mysqli_query($conn, $sql);
                                
                                //VERIFICANDO SE A CONSULTA GEROU RESULTADOS
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) $saida[] = $row;
                                } 
                            }
                        }
                    }
                ?>
            </div>
            <div class="ordenacaoQuantidadeSelect">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="ordenarQuantidade">Ordenação(Quantidade):</label>
                    <select id="ordenarQuantidade" name="ordenaQuantidade">
                        <?php
                            $ordenaQuantidade = array("Ascendente", "Decrescente"); 
                            foreach($ordenaQuantidade as $ordenaQuantidade2) {
                                echo "<option value=\"$ordenaQuantidade2\">$ordenaQuantidade2</option>";
                            }
                        ?>
                    </select>
                    <input type="submit" value="Remeter">
                </form>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST['ordenaQuantidade'])) {
                            $pedidoDeOrdenacao = $_POST['ordenaQuantidade'];
                            if ($pedidoDeOrdenacao == "Ascendente") {
                                $saida = array();
                                $sql = "SELECT * FROM produtos ORDER BY quantidade ASC";
                                $result = mysqli_query($conn, $sql);
                                
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) $saida[] = $row;
                                } 
                            } elseif ($pedidoDeOrdenacao == "Decrescente") {
                                $saida = array();
                                $sql = "SELECT * FROM produtos ORDER BY quantidade DESC";
                                $result = mysqli_query($conn, $sql);
                                
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) $saida[] = $row;
                                } 
                            }
                        } 
                    } 
                ?>
            </div>
            <div class="ordenacaoPrecoSelect">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="ordenarPreco">Ordenação(Preço):</label>
                    <select id="ordenarPreco" name="ordenaPreco">
                        <?php
                            $ordenaPreco= array("Ascendente", "Decrescente"); 
                            foreach($ordenaPreco as $ordenaPreco2) {
                                echo "<option value=\"$ordenaPreco2\">$ordenaPreco2</option>";
                            }
                        ?>
                    </select>
                    <input type="submit" value="Remeter">
                </form>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST['ordenaPreco'])) {
                            $pedidoDeOrdenacao = $_POST['ordenaPreco'];
                            if ($pedidoDeOrdenacao == "Ascendente") {
                                $saida = array();
                                $sql = "SELECT * FROM produtos ORDER BY preco ASC";
                                $result = mysqli_query($conn, $sql);
                                
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) $saida[] = $row;
                                } 
                            } elseif ($pedidoDeOrdenacao == "Decrescente") {
                                $saida = array();
                                $sql = "SELECT * FROM produtos ORDER BY preco DESC";
                                $result = mysqli_query($conn, $sql);
                                
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) $saida[] = $row;
                                } 
                            }
                        }
                    } 
                ?>
            </div>
        <?php }?>
    </div>
    <div class="table-container">
        <table border="1">
            <tbody>
                <!--Se a variável "saida" estiver vazia ele não irá tentar imprimir a tabela, caso contrário,
                a tabela aparecerá normalmente-->
                <?php if (!empty($saida)) { ?>
                    <tr>
                        <th>Id:</th>
                        <th>Nome:</th>
                        <th>Descrição:</th>
                        <th>Quantidade:</th>
                        <th>Preço:</th>
                        <th>Operações:</th>
                    </tr>
                    <!--Itera sobre todos os elementos da variável "saida" para imprimi-la corretamente-->
                    <?php foreach ($saida as $produtos) { ?>
                        <tr>
                            <td><?php echo $produtos['id'] ?></td>
                            <td><?php echo $produtos['nome'] ?></td>
                            <td><?php echo $produtos['descricao'] ?></td>
                            <td><?php echo $produtos['quantidade'] ?></td>
                            <td>R$: <?php echo $produtos['preco'] ;?></td>
                            <!--Links para editar ou remover um elemento da tabela com base no ID-->
                            <td><a class="corDelete" href="remove.php?id=<?php echo $produtos['id']?>">Remover</a>/<a class="editarColor" href="editar.php?id=<?php echo $produtos['id']?>">Editar</a></td>
                        </tr>
                    <?php } ?>     
                <?php }
                else {  ?> 
                    <!--Como dito anteriormente, se a tabela estiver vazia não irá imprimi-la, por conseguinte
                    aparecerá uma imagem e uma mensagem informando que a tabela está vazia-->
                    <div class="cardVazia">
                        <p>Sua Tabela vazia😪 <br>Se tiver adicione produtos</p>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!--Destroi o conteúdo da variável $_POST para evitar problemas com ordenação-->
    <?php unset($_POST);?>
</body>
</html>