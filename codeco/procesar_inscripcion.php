<?php

$servername = "localhost";
$username = "root";    
$password = "1234";
$database = "anaV";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


function limpiar($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}


if (isset($_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['telefono'], $_POST['cedula'], $_POST['fecha_nacimiento'])) {





    $nombre  = limpiar($_POST['nombre']);
    $apellido = limpiar($_POST['apellido']);
    $correo = limpiar($_POST['correo']);
    $telefono = limpiar($_POST['telefono']);
    $cedula = limpiar($_POST['cedula']);
    $fecha_nacimiento = limpiar($_POST['fecha_nacimiento']);






  
    if (empty($nombre) || empty($apellido) || empty($correo) || empty($cedula) || empty($fecha_nacimiento)) {
        die("Error: Todos los campos marcados como obligatorios deben llenarse.");
    }


    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("Error: El formato del correo electrónico no es válido.");
    }

 
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellido, correo, telefono, cedula, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }


    $stmt->bind_param("ssssss", $nombre, $apellido, $correo, $telefono, $cedula, $fecha_nacimiento);


    if ($stmt->execute()) {
        echo "¡exioto.";
    } else {
        echo "Error al insertar los datos: " . $stmt->error;
    }

    
    $stmt->close();
} else {
    echo "No se han enviado los datos del formulario correctamente.";
}


$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Inscripción</title>
</head>

<style> 

button {
    position: relative;
    left:20%;
    top:13%;
    width: 800px;
    height: 600px;
    padding: 15px 30px;
    font-size: 18px;
    font-weight: bold;
    color: #fff;
    border: none;
    border-radius: 50px;
    background: linear-gradient(-45deg, #ff3d00, #00c853, #2196f3, #f50057);
    background-size: 400% 400%;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    animation: gradientBG 10s ease infinite;
}

button::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.5s ease;
}

button:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    animation: shake 0.5s ease-in-out;
}

button:hover::before {
    width: 300px;
    height: 300px;
    opacity: 0;
}

button:active {
    transform: scale(0.95);
    box-shadow: 0 5px 10px rgba(0,0,0,0.2);
}

@keyframes gradientBG {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

@keyframes shake {
    0%, 100% { transform: translateY(-5px) scale(1.05) rotate(0deg); }
    25% { transform: translateY(-5px) scale(1.05) rotate(-2deg); }
    75% { transform: translateY(-5px) scale(1.05) rotate(2deg); }
}

@keyframes glow {
    0%, 100% { box-shadow: 0 0 20px rgba(33, 150, 243, 0.5); }
    50% { box-shadow: 0 0 40px rgba(244, 67, 54, 0.7); }
}

button:hover {
    animation: gradientBG 10s ease infinite, shake 0.5s ease-in-out, glow 2s ease-in-out infinite;
}

@keyframes fallingMoney {
    0% {
        transform: translateY(-100vh) rotate(0deg);
        opacity: 1;
    }
    100% {
        transform: translateY(100vh) rotate(360deg);
        opacity: 0;
    }
}

.money {
    position: fixed;
    z-index: 999;
    pointer-events: none;
    width: 50px;
    height: 20px;
    background: linear-gradient(45deg, #85bb65, #4c8c4a);
    border-radius: 2px;
    animation: fallingMoney 3s linear forwards;
}

button {
    position: relative;
    padding: 15px 30px;
    font-size: 18px;
    font-weight: bold;
    color: #fff;
    border: none;
    border-radius: 50px;
    background: linear-gradient(-45deg, #ff3d00, #00c853, #2196f3, #f50057);
    background-size: 400% 400%;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    animation: gradientBG 10s ease infinite;
}

</style>
<body>
    
<!--volver al inicio-->


<a href="codecoins.html"><button>Volver al inicio</button></a>



<script>
function createMoney() {
    const money = document.createElement('div');
    money.className = 'money';
    money.style.left = `${Math.random() * 100}vw`;
    document.body.appendChild(money);
    
    
    setTimeout(() => {
        money.remove();
    }, 3000);
}

document.querySelector('button').addEventListener('mouseenter', () => {
    
    for(let i = 0; i < 1; i++) {
        setTimeout(() => {
            createMoney();
        }, i * 100);
    }
});
</script>


</body>
</html>