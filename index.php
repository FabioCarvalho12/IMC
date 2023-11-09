<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Calcular IMC </title>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        form {
            width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
        }

        button {
            display: block;
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            background-color: #0099ff;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <h1>Cálculo do IMC</h1>
    <form action="imc.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" min="0" required>

        <label for="altura">Altura (em metros):</label>
        <input type="number" id="altura" name="altura" min="0" step="0.01" required>

        <label for="peso">Peso (em quilogramas):</label>
        <input type="number" id="peso" name="peso" min="0" step="0.01" required>

        <button type="submit">Calcular</button>
        
    </form>
    <form action="lista" method="post">
        <button type="submit">Lista</button>
    </form>
</body>
</html>