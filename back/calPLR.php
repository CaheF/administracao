<?php
include 'conexao.php'; // Conexão com o banco de dados

function calcularPLR($idFuncionario, $plrBase = 10000) {
    global $conn;

    // Consultar a quantidade de folgas do funcionário
    $sql = "SELECT COUNT(*) AS totalFolgas FROM folga WHERE idFuncionario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idFuncionario);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    $totalFolgas = $result['totalFolgas'];
    
    // Calcular bonificação de 1% por folga, com limite de 15%
    $bonificacao = min($totalFolgas * 0.01, 0.15) * $plrBase;
    $plrFinal = $plrBase + $bonificacao;

    return $plrFinal;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idFuncionario = $_POST['idFuncionario'];
    $plr = calcularPLR($idFuncionario);

    // Redireciona de volta com os resultados
    header("Location: /caminho/para/o/formulario.html?idFuncionario=$idFuncionario&plr=$plr");
    exit();
}
?>
