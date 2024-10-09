<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Faltas</title>
</head>
<body>
    <h2>Registrar Falta</h2>
    <form action="cadFalta.php" method="POST">
    <label for="idFuncionario">ID do Funcionário:</label><br>
    <input type="text" id="idFuncionario" name="idFuncionario" required><br><br>

    <label for="dataFalta">Data da Falta:</label><br>
    <input type="date" id="dataFalta" name="dataFalta" required><br><br>

    <input type="submit" value="Cadastrar Falta">
</form>
</body>
</html
