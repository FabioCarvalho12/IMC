<link rel="stylesheet" href="css/editar.css">
<?php


// Recebe o id da pessoa a ser editada
$id = $_GET['id'];

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

// Consulta os dados da pessoa pelo id
$sql = "SELECT * FROM pessoas WHERE id = $id";
$result = $conn->query($sql);

// Verifica se encontrou algum resultado
if ($result->num_rows > 0) {
    // Obtém os dados da pessoa em um array associativo
    $row = $result->fetch_assoc();

    // Atribui os dados às variáveis
    $nome = $row['nome'];
    $idade = $row['idade'];
    $altura = $row['altura'];
    $peso = $row['peso'];
    $imc = $row['imc'];

    // Fecha a conexão
    $conn->close();

    // Exibe o formulário de edição com os dados preenchidos
    echo "<h1>Editar Dados</h1>";
    echo "<form action='atualizar.php' method='post'>";
    echo "<input type='hidden' name='id' value='$id'>"; // Envia o id como um campo oculto
    echo "<p>Nome: <input type='text' name='nome' value='$nome' required></p>";
    echo "<p>Idade: <input type='number' name='idade' value='$idade' required></p>";
    echo "<p>Altura: <input type='number' name='altura' value='$altura' step='0.01' required></p>";
    echo "<p>Peso: <input type='number' name='peso' value='$peso' step='0.01' required></p>";
    echo "<p><input type='submit' value='Atualizar'></p>";
    echo "</form>";
} else {
    // Se não encontrou nenhum resultado, exibe uma mensagem de erro
    echo "<p>Nenhum dado encontrado para o id informado</p>";
}
?>