<link rel="stylesheet" href="css/imc.css">
<?php
// Recebe os dados do formulário
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$altura = $_POST['altura'];
$peso = $_POST['peso'];

// Calcula o IMC
$imc = $peso / ($altura * $altura); // Corrigi a fórmula aqui

// Define a categoria do IMC
if ($imc < 18.5) {
    $categoria = "Abaixo do peso";
} elseif ($imc >= 18.5 and $imc < 25) {
    $categoria = "Peso normal";
} elseif ($imc >= 25 and $imc < 30) {
    $categoria = "Sobrepeso";
} elseif ($imc >= 30 and $imc < 35) {
    $categoria = "Obesidade grau I";
} elseif ($imc >= 35 and $imc < 40) {
    $categoria = "Obesidade grau II";
} else {
    $categoria = "Obesidade grau III";
}

// Cria a conexão com o banco de dados MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imc_db";

$conn = new mysqli($servername, $username, $password);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Cria o banco de dados se ele não existir
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === FALSE) {
    die("Erro ao criar o banco de dados: " . $conn->error);
}

// Seleciona o banco de dados
$conn->select_db($dbname);

// Cria a tabela se ela não existir
$sql = "CREATE TABLE IF NOT EXISTS pessoas (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    idade INT NOT NULL,
    altura DECIMAL(4,2) NOT NULL,
    peso DECIMAL(5,2) NOT NULL,
    imc DECIMAL(4,2) NOT NULL,
    categoria VARCHAR(20) NOT NULL
)";


if ($conn->query($sql) === FALSE) {
    die("Erro ao criar a tabela: " . $conn->error);
}

// Insere os dados da pessoa na tabela
$sql = "INSERT INTO pessoas (nome, idade, altura, peso, imc, categoria)
VALUES ('$nome', '$idade', '$altura', '$peso', '$imc', '$categoria')"; // Adicionei a categoria aqui
if ($conn->query($sql) === FALSE) {
    die("Erro ao inserir os dados: " . $conn->error);
}

// Consulta os dados da tabela
$sql = "SELECT * FROM pessoas";
$result = $conn->query($sql);

// Fecha a conexão
$conn->close();

// Exibe o resultado na tela
echo "<h1>Resultado do IMC</h1>";
echo "<p>Nome: $nome</p>";
echo "<p>Idade: $idade anos</p>";
echo "<p>Altura: $altura m</p>";
echo "<p>Peso: $peso kg</p>";
echo "<p>IMC: ".number_format($imc, 2)."</p>";
echo "<p>Categoria: $categoria</p>";

// Exibe os resultados anteriores em uma tabela
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