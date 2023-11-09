
<?php
// Recebe o id da pessoa a ser excluída
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

// Exclui os dados da pessoa pelo id
$sql = "DELETE FROM pessoas WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    // Se a exclusão foi bem sucedida, exibe uma mensagem de sucesso e um link para voltar à página anterior
    header("Location: excluido.php");
} else {
    // Se a exclusão falhou, exibe uma mensagem de erro e um link para voltar à página anterior
    echo "<p>Erro ao excluir os dados: " . $conn->error . "</p>";
    echo "<a href='javascript:history.back()'>Voltar</a>";
}

// Fecha a conexão
$conn->close();
?>