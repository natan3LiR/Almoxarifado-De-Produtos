<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            border: 1px solid #ccc; /* Adiciona uma borda */
            background-color: #88b257;
            border-radius: 15px;
            border: 8px solid white;
            position: relative;
            z-index: 1;
        }


        
        h1 {
            text-align: center;
            margin-top: 0; /* Remove a margem superior padrão do h1 */
            padding-top: 0; /* Remove o preenchimento superior padrão do h1 */
            color:white;
        }
        p {
            text-align: center;
            margin-bottom: 20px;
            color:white;
        }
        form {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color:white;
            border-radius:15px;
        }
        input[type="text"],
        input[type="number"],
        input{
            background-color: #f2f2f2;
            color:#333;
            border:1px solid #ccc;
            padding:8px;
            border-radius:15px;
            box-shadow: 0 0 5px rgba(0, 0, 0.1);
        }

        button {
            margin-bottom: 10px;
            width: calc(100% - 40px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 15px;
            box-sizing: border-box;
        }
        button {
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        } 
    </style>
</head>
<body>   
    <div class="background"></div>
    <div class="card">
        <h1>Tiquitim Hardware</h1>
        <p>Insira um novo produto na tabela</p>
        <!--Formulário para adicionar um novo produto-->
        <form action="createPHP.php" method="post">
            <div class= "form.container">
                <label for="nome">Nome do produto:</label>
                <!--"pattern" Faz com que só aceite caracteres no nome do produto-->
                <input type="text" id="nome" name="nome" pattern="[A-Za-zÀ-ú\s]+" required title="Apenas caracteres são permitidos">
                <br>
                <br>
                <label for="desc">Descrição</label>
                <input type="text" id="desc" name="desc">
                <br>
                <br>
                <label for="qtd">Quantidade:</label>
                <input type="number" id="qtd" name="qtd" min="1" required>
                <br>
                <br>
                <label for="preco">Preço:</label>
                <input type="number" id="preco" name="preco" min="1" required>
                <br>
                <br>
                <button type="submit">Inserir produto</button>
                <p>
            </div>
        </form>
    </div>    
</body>
</html>
