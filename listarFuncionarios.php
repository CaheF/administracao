<?php
include('back/conectar.php');

echo "<div class='tabela'>";
echo "<h2>Lista de Funcionários</h2>"; // Título da lista de funcionários
$sql = "SELECT f.nome, f.documento, d.nome AS departamento, f.dataNasc, f.salario,
        COUNT(DISTINCT ft.idFolga) AS folga,
        COUNT(DISTINCT fa.idFaltas) AS faltas
        FROM funcionarios f
        LEFT JOIN folga ft ON f.idFuncionario = ft.idFuncionario
        LEFT JOIN faltas fa ON f.idFuncionario = fa.idFuncionario
        LEFT JOIN departamento d ON f.departamento = d.idDepartamento
        GROUP BY f.idFuncionario";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    echo  "<table border ='1'>
            <tr>
                <th>Nome</th>
                <th>Documento</th>
                <th>Departamento</th>
                <th>Data de Nascimento</th>
                <th>Salário</th>
                <th>Faltas</th>     
                <th>Folgas</th>
            </tr>";

            while ($row = $result->fetch_assoc()) {
                $dataNasc = isset($row["dataNasc"]) ? $row["dataNasc"] : 'N/A';
            
                echo "<tr> 
                        <td>" . $row["nome"] . "</td>
                        <td>" . $row["documento"] . "</td>
                        <td>" . $row["departamento"] . "</td> <!-- Mostrando o nome do departamento -->
                        <td>" . $dataNasc . "</td>
                        <td>" . $row["salario"] . "</td> 
                        <td>" . $row["faltas"] . "</td>
                        <td>" . $row["folga"] . "</td>
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
    <link rel="icon" href="images/pngMaleta.png">
</head>
<body>    
</body>
</html>
<?php
    include('menu.php');
?>
