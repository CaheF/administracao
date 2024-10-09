<?php
// Incluir o arquivo de conexão
include 'conectar.php';

var_dump($_POST);


// Capturar dados do formulário
if (isset($_POST['idFuncionario']) && isset($_POST['dataFalta'])) {
    $idFuncionario = $_POST['idFuncionario'];
    $dataFalta = $_POST['dataFalta'];

    // Verificar se todos os campos estão preenchidos
    if (!empty($idFuncionario) && !empty($dataFalta)) {
        // Inserir dados na tabela faltas
        $sql = "INSERT INTO faltas (id_funcionario, data_falta) 
                VALUES ('$idFuncionario', '$dataFalta')";

        if ($conn->query($sql) === TRUE) {
            echo "Falta cadastrada com sucesso!";
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
