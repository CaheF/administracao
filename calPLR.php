<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de PLR</title>
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
        .result {
            margin-top: 20px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cálculo de PLR</h2>
        <form action="calcularPLR.php" method="POST">
            <label for="idFuncionario">ID do Funcionário:</label>
            <input type="number" name="idFuncionario" id="idFuncionario" required>

            <button type="submit">Calcular PLR</button>
        </form>
        <?php if (isset($_GET['plr'])): ?>
            <div class="result">
                O PLR do funcionário <?php echo htmlspecialchars($_GET['idFuncionario']); ?> é: R$ <?php echo number_format($_GET['plr'], 2, ',', '.'); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
