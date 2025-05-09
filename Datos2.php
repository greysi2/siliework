<?php

$host = "localhost";
$user = "root";
$password = "1234";
$db = "anaV2";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT * FROM mensajes ORDER BY fecha_envio DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensajes Recibidos</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            padding: 30px;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #2980b9;
            color: white;
        }
        tr:hover {
            background-color: #ecf0f1;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>

<h1>Mensajes Recibidos</h1>

<?php
if ($resultado->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Email</th><th>Asunto</th><th>Mensaje</th><th>Fecha de Envío</th></tr>";
    while($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
        echo "<td>" . htmlspecialchars($fila["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($fila["asunto"]) . "</td>";
        echo "<td>" . nl2br(htmlspecialchars($fila["mensaje"])) . "</td>";
        echo "<td>" . $fila["fecha_envio"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No hay mensajes registrados aún.</p>";
}

$conn->close();
?>



</body>
</html>
