<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rakkas&family=Wix+Madefor+Text:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-size: #88b257;
            font-family: "Wix Madefor Text", sans-serif;
        }

        .background {
            background-image: url(https://wallpaperaccess.com/full/1472763.jpg);
            filter: blur(10px);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 30%;
            border: 1px solid #ccc; 
            margin: 0 auto; 
            position: relative;
        }

        h1 {
            text-align: center;
            margin-top: 0; 
            padding-top: 0;
            color: #333; 
        }

        label {
            display: block;
            margin-bottom: 5px;
            color:black;
            border-radius:15px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            background-color: #f2f2f2;
            color:#333;
            border:1px solid #ccc;
            padding:8px;
            border-radius:15px;
            box-shadow: 0 0 5px rgba(0, 0, 0.1);
        }

        input[type="submit"],
        input[type="reset"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0056b3;
        }

        button {
            margin-bottom: 10px;
            width: 190px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 15px;
            box-sizing: border-box;
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        } 

        .logo {
            position: absolute;
            top: 53%; /* Ajuste conforme necessário */
            right: 4px; /* Ajuste conforme necessário */
            transform: translateY(-50%); /* Centraliza verticalmente */
        }


        .logo img {
            width: 215px; /* Defina a largura desejada */
            height: auto; /* Mantém a proporção de aspecto */
        }
        
    </style>
        
</head>
<body>
    <div class="background"></div> 
    <div class="card" > 
        <h1>Tikitim Hardware</h1>
        <p align="center">Cadastrar:</p>
        <!--Formulário para cadastrar um novo usuário na empresa-->
        <form action="cadastroPHP.php" method="post" height=10px>
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <label for="nome">Digite seu nome:</label>
            <input type="text" name="nome" id="nome" placeholder="ex:Pedro Thiago" pattern="[A-Za-zÀ-ú\s]+" required title="Apenas caracteres são permitidos">
            <label for="sobrenome">Digite seu sobrenome:</label>
            <input type="text" name="sobrenome" id="sobrenome" placeholder="ex:do Carmo" pattern="[A-Za-zÀ-ú\s]+" required title="Apenas caracteres são permitidos"> 
            <label for="email">Digite o seu e-mail:</label>
            <input type="email" name="email" id="email" required>
            <label for="senha">Digite sua senha:</label>
            <input type="password" name="senha" id="senha" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="Deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 ou mais caracteres">
            <br><br>
            <button type="submit" value="Cadastro">Cadastrar</button>
            <br>
            <button type="reset" id="Limpar">Limpar</button> 
            <p>
            <!--Manda uma mensagem de erro caso o email ou senha estiver errado ou se já estiver cadastrado-->
            <?php if(isset($_SESSION['mensagem'])) { ?>
                    <p class="alerta">
                        <?php 
                            echo $_SESSION['mensagem'];
                            unset($_SESSION['mensagem']);
                        ?>
                    </p>
                <?php }?>
            
        </p>
        </form>
    </div>
</body>
</html>
