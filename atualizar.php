<link rel="stylesheet" href="css/resul.css">
<?php
// Recebe os dados do formulário de edição
$id = $_POST['id'];
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$altura = $_POST['altura'];
$peso = $_POST['peso'];
$categoria = $_POST['categoria']; // Adicionei a categoria aqui

// Calcula o IMC
$imc = $peso / ($altura * $altura);

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

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Atualiza os dados da pessoa pelo id
$sql = "UPDATE pessoas SET nome = '$nome', idade = '$idade', altura = '$altura', peso = '$peso', imc = '$imc', categoria = '$categoria' WHERE id = $id"; // Adicionei a categoria aqui
if ($conn->query($sql) === TRUE) {
    // Se a atualização foi bem sucedida, exibe uma mensagem de sucesso e um link para voltar à página anterior
    header("Location: atualizado.php");
} else {
    // Se a atualização falhou, exibe uma mensagem de erro e um link para voltar à página anterior
    echo "<p>Erro ao atualizar os dados: " . $conn->error . "</p>";
    echo "<a href='javascript:history.back()'>Voltar</a>";
}

// Fecha a conexão
$conn->close();

?>