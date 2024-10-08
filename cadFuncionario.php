<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionários</title>
</head>
<body>
    <h2>Cadastro de Funcionários</h2>
    <form action="cadFuncionario.php" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="dataNascimento">Data de Nascimento:</label><br>
        <input type="date" id="dataNascimento" name="dataNascimento" required><br><br>

        <label for="departamento">Departamento:</label><br>
        <input type="text" id="departamento" name="departamento" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
