<?php

class Employee {
    protected $id;
    protected $name;
    protected $position;
    protected $salary;
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Métodos para establecer y obtener propiedades...

    public function insertEmployee($name, $position, $salary) {
        $stmt = $this->pdo->prepare("INSERT INTO employees (name, position, salary) VALUES (:name, :position, :salary)");
        $stmt->execute(['name' => $name, 'position' => $position, 'salary' => $salary]);
        echo "¡{$name} ha sido registrado como empleado!";
    }

    public function getAllEmployees() {
        $stmt = $this->pdo->query("SELECT * FROM employees");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
