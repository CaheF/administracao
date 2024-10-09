<?php
// Incluir o arquivo de conexão
include 'conectar.php';

// Capturar dados do formulário
if (isset($_POST['nome']) && isset($_POST['dataNascimento']) && isset($_POST['departamento'])) {
    $nome = $_POST['nome'];
    $dataNascimento = $_POST['dataNascimento'];
    $departamento = $_POST['departamento'];

    // Verificar se todos os campos estão preenchidos
    if (!empty($nome) && !empty($dataNascimento) && !empty($departamento)) {
        // Inserir dados na tabela funcionarios
        $sql = "INSERT INTO funcionarios (nome, data_nascimento, departamento) 
                VALUES ('$nome', '$dataNascimento', '$departamento')";

        if ($conn->query($sql) === TRUE) {
            echo "Funcionário cadastrado com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Erro: Todos os campos devem ser preenchidos.";
    }
} else {
    echo "Erro: Dados não enviados corretamente.";
}

// Fechar conexão
$conn->close();
?>
