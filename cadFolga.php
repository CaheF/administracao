<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Folgas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
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
    <div class="container">
        <h2>Cadastro de Folga</h2>
        <form action="cadastrarFolga.php" method="POST">
            <label for="idFuncionario">ID do Funcionário:</label>
            <input type="number" name="idFuncionario" id="idFuncionario" required>

            <label for="dataFolga">Data da Folga:</label>
            <input type="date" name="dataFolga" id="dataFolga" required>

            <label for="motivo">Motivo (opcional):</label>
            <input type="text" name="motivo" id="motivo">

            <button type="submit">Cadastrar Folga</button>
        </form>
    </div>
</body>
</html>
