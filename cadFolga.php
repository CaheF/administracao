<?php
include ('back/conectar.php'); // Conexão com o banco de dados

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomeFuncionario = $_POST['nomeFuncionario'];
    $departamento = $_POST['departamento'];
    $dataFolga = $_POST['dataFolga'];
    $motivo = $_POST['motivo'] ?? null;

    // Buscar o ID do funcionário pelo nome e departamento
    $sql = "SELECT idFuncionario FROM funcionarios WHERE nome = ? AND departamento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nomeFuncionario, $departamento);
    $stmt->execute();
    $stmt->bind_result($idFuncionario);
    $stmt->fetch();
    $stmt->close();

    if ($idFuncionario) {
        // Inserir a folga no banco de dados
        $sql = "INSERT INTO folga (idFuncionario, dataFolga, motivo) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $idFuncionario, $dataFolga, $motivo);

        if ($stmt->execute()) {
            $message = "Folga cadastrada com sucesso!";
        } else {
            $message = "Erro ao cadastrar folga: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Funcionário não encontrado.";
    }


}

// Buscar os departamentos do banco de dados
$sqlDepartamentos = "SELECT idDepartamento, nome FROM departamento";
$resultDepartamentos = $conn->query($sqlDepartamentos);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Folgas</title>
    <link rel="stylesheet" href="CSS/menu.css">
    <link rel="stylesheet" href="CSS/cadFolga.css">
    <link rel="icon" href="images/pngMaleta.png">
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
        input, select, button {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            width: 100%;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registrar Folga</h2>
        <form action="" method="POST">
            <label for="nomeFuncionario">Nome do Funcionário:</label>
            <input type="text" name="nomeFuncionario" id="nomeFuncionario" required>

            <label for="departamento">Departamento:</label>
            <select name="departamento" id="departamento" required>
                <option value="">Selecione o Departamento</option>
                <?php
                // Loop para listar todos os departamentos disponíveis
                if ($resultDepartamentos->num_rows > 0) {
                    while($row = $resultDepartamentos->fetch_assoc()) {
                        echo "<option value='".$row['idDepartamento']."'>".$row['nome']."</option>";
                    }
                } else {
                    echo "<option value=''>Nenhum departamento encontrado</option>";
                }
                ?>
            </select>

            <label for="dataFolga">Data da Folga:</label>
            <input type="date" name="dataFolga" id="dataFolga" required>

            <label for="motivo">Motivo (opcional):</label>
            <input type="text" name="motivo" id="motivo">

            <button type="submit">Cadastrar Folga</button>
        </form>
        <?php if (isset($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
    include('menu.php');
?>
