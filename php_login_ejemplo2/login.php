<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'nombre_base_de_datos';
    private $username = 'usuario';
    private $password = 'contraseña';
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error al conectar: " . $e->getMessage());
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
}

class Usuario {
    private $username;
    private $password;
    protected $pdo;

    public function __construct($username, $password, $pdo) {
        $this->username = $username;
        $this->password = $password;
        $this->pdo = $pdo;
    }

    public function verificarCredenciales() {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE username = :username AND password = :password");
        $stmt->execute(['username' => $this->username, 'password' => $this->password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}

// Verifica si se enviaron datos de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Instancia la clase Database
    $db = new Database();
    $pdo = $db->getPDO();

    // Instancia la clase Usuario
    $usuario = new Usuario($username, $password, $pdo);

    // Verifica las credenciales del usuario
    $user = $usuario->verificarCredenciales();

    // Si se encontró un usuario, redirige a una página de bienvenida
    if ($user) {
        header("Location: bienvenida.php");
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos');</script>";
    }
}
?>
