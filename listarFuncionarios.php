<?php
include('back/conectar.php');
include('menu.php');

echo "<div class='tabela'>";
echo "<h2>Lista de Funcionários</h2>"; // Título da lista de funcionários
$sql = "SELECT * FROM funcionarios";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    echo  "<table border ='1'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Departamento</th>
                <th>Documento</th>
                <th>Salário</th>     
            </tr>";

    while ($row = $result->fetch_assoc()) {
        // Verificar se 'dataNasc' está definida antes de exibir
        $dataNasc = isset($row["dataNasc"]) ? $row["dataNasc"] : 'N/A';

        echo "<tr> 
                <td>" . $row["idFuncionario"] . "</td>
                <td>" . $row["nome"] . "</td>
                <td>" . $row["dataNascimento"] . "</td>
                <td>" . $row["departamento"] . "</td>
                <td>" . $row["documento"] . "</td>
                <td>" . $row["salario"] . "</td> 
            </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum funcionário encontrado.";
}
echo "</div>";
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários</title>
    <link rel="stylesheet" href="CSS/menu.css">
    <link rel="stylesheet" href="CSS/listFun.css">
</head>
<body>
    
</body>
</html>
