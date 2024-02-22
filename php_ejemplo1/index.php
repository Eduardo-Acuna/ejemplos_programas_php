<?php

require_once 'manager.php';

// Establecer la conexión a la base de datos
$host = 'localhost';
$dbname = 'nombre_base_de_datos';
$username = 'usuario';
$password = 'contraseña';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar: " . $e->getMessage());
}

// Crear instancias de Manager y Employee
$manager = new Manager($pdo);
$employee = new Employee($pdo);

// Insertar empleados en la base de datos
$employee->insertEmployee('Juan', 'Desarrollador', 50000);
$manager->insertManager('María', 'Gerente de Proyecto', 80000, 'Desarrollo');

// Obtener todos los empleados de la base de datos
$employees = $employee->getAllEmployees();
foreach ($employees as $emp) {
    echo "ID: {$emp['id']}, Nombre: {$emp['name']}, Cargo: {$emp['position']}, Salario: {$emp['salary']}<br>";
}

?>
