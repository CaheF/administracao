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
        <label for="id_funcionario">Funcionário:</label><br>
        <select id="id_funcionario" name="id_funcionario" required>
            <?php
            // Conectar ao banco de dados para listar os funcionários
            $conn = new mysqli("localhost", "root", "", "hackathon");
            $sql = "SELECT id, nome FROM funcionarios";
            $result = $conn->query($sql);

            // Preencher o select com os nomes dos funcionários
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['id']."'>".$row['nome']."</option>";
                }
            } else {
                echo "<option value=''>Nenhum funcionário encontrado</option>";
            }
            $conn->close();
            ?>
        </select><br><br>

        <label for="data_falta">Data da Falta:</label><br>
        <input type="date" id="data_falta" name="data_falta" required><br><br>

        <input type="submit" value="Registrar Falta">
    </form>
</body>
</html
