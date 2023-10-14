<?php
class Alumno {
    private $nombre;
    private $dni;
    private $calificaciones;

    public function __construct($nombre, $dni) {
        $this->nombre = $nombre;
        $this->dni = $dni;
        $this->calificaciones = [0, 0];
    }

    public function setCalificaciones($parcial1, $parcial2) {
        $this->calificaciones[0] = $parcial1;
        $this->calificaciones[1] = $parcial2;
    }

    public function calcularNotaMedia() {
        return array_sum($this->calificaciones) / count($this->calificaciones);
    }
}

class Curso {
    private $alumnos = [];

    public function agregarAlumno($alumno) {
        $this->alumnos[] = $alumno;
    }

    public function calcularNotaMediaCurso() {
        $total = 0;
        foreach ($this->alumnos as $alumno) {
            $total += $alumno->calcularNotaMedia();
        }
        return $total / count($this->alumnos);
    }
}

// Recoger datos del formulario
$nombre = $_POST['nombre'];
$dni = $_POST['dni'];
$parcial1 = floatval($_POST['parcial1']);
$parcial2 = floatval($_POST['parcial2']);

// Crear un alumno
$alumno = new Alumno($nombre, $dni);
$alumno->setCalificaciones($parcial1, $parcial2);

// Crear el curso y agregar el alumno
$curso = new Curso();
$curso->agregarAlumno($alumno);

// Calcular la nota media del curso
$notaMediaCurso = $curso->calcularNotaMediaCurso();

// Mostrar resultados
echo "Nota del alumno: " . $alumno->calcularNotaMedia() . "<br>";
echo "Nota media del curso: " . $notaMediaCurso;
?>
