
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tabela.css">
    <title>Document</title>
</head>
<body>
    <a href="index.php"> voltar</a>
</body>
</html>
<?php
// Cria a conexão com o banco de dados MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imc_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
// Consulta os dados da tabela
$sql = "SELECT * FROM pessoas";
$result = $conn->query($sql);

// Fecha a conexão
$conn->close();


// Exibe os resultados anteriores em uma tabela
echo "<h2>Resultados Anteriores</h2>";
echo "<table border='1' align='center'>";
echo "<tr><th>Nome</th><th>Idade</th><th>Altura</th><th>Peso</th><th>IMC</th><th>Categoria</th><th>Ações</th></tr>"; // Adicionei uma coluna para as ações e outra para a categoria
if ($result->num_rows > 0) {
    // Percorre os resultados e exibe cada linha na tabela
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["nome"]."</td><td>".$row["idade"]."</td><td>".$row["altura"]."</td><td>".$row["peso"]."</td><td>".$row["imc"]."</td><td>".$row["categoria"]."</td>"; // Adicionei dois botões para excluir e editar os dados e a categoria
        echo "<td><a href='excluir.php?id=".$row["id"]."'>Excluir</a> | <a href='editar.php?id=".$row["id"]."'>Editar</a></td></tr>"; // Os botões levam para páginas que executam as ações
    }
} else {
    // Se não houver resultados, exibe uma mensagem
    echo "<tr><td colspan='7'>Nenhum resultado encontrado</td></tr>";
}
echo "</table>";


?>