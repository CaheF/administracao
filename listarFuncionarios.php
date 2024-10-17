<?php
    include('back/conectar.php');
    include('menu.php');

    echo "<div class='tabela'>";
    $sql = "SELECT * FROM funcionarios";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        echo  "<table border ='1'>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de nascimento</th>
                    <th>Documento</th>
                    <th>Salário</th>     
                </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr> 
                <td>" .
                $row["idFuncionario"] . "</td>
                <td>" . 
                $row["nome"] . "</td>
                <td>" . 
                $row["dataNasc"] . "</td>
                <td>" . 
                $row["documento"] . "</td>
                <td>" . 
                $row["salario"] . "</td> 
        </td>";
    }
    echo "</table>";
} else {
    echo "Nenhum funcionario encontrado.";
}
echo "</div>";
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionarios</title>
    <link rel="stylesheet" href="CSS/menu.css">
    <link rel="stylesheet" href="CSS/listFun.css">
</head>
<body>
    
</body>
</html>