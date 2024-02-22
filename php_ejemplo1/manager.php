<?php

require_once 'Employee.php';

class Manager extends Employee {
    private $department;

    public function __construct($pdo) {
        parent::__construct($pdo);
    }

    // Métodos para establecer y obtener propiedades...

    public function insertManager($name, $position, $salary, $department) {
        $stmt = $this->pdo->prepare("INSERT INTO employees (name, position, salary, department) VALUES (:name, :position, :salary, :department)");
        $stmt->execute(['name' => $name, 'position' => $position, 'salary' => $salary, 'department' => $department]);
        echo "¡{$name} ha sido registrado como gerente!";
    }
}

?>
