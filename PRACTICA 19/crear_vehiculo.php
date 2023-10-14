<?php
interface CapacidadLimite {
    const MAX_PASAJEROS_AUTOMOVIL = 5;
    const MAX_PASAJEROS_FURGONETA = 9;
    const MAX_PASAJEROS_CAMION = 3;
}

class VehiculoMotorizado {
    protected $fabricante;
    protected $modelo;
    protected $anioFabricacion;
    protected $kilometraje;

    public function __construct($fabricante, $modelo, $anioFabricacion, $kilometraje) {
        $this->fabricante = $fabricante;
        $this->modelo = $modelo;
        $this->anioFabricacion = $anioFabricacion;
        $this->kilometraje = $kilometraje;
    }

    public function toString() {
        return "Fabricante: " . $this->fabricante . "<br>Modelo: " . $this->modelo . "<br>Año de Fabricación: " . $this->anioFabricacion . "<br>Kilometraje: " . $this->kilometraje . " km";
    }
}

class Automovil extends VehiculoMotorizado implements CapacidadLimite {
    protected $estilo;

    public function __construct($fabricante, $modelo, $anioFabricacion, $kilometraje, $estilo) {
        parent::__construct($fabricante, $modelo, $anioFabricacion, $kilometraje);
        $this->estilo = $estilo;
    }

    public function toString() {
        return parent::toString() . "<br>Estilo: " . $this->estilo . "<br>Límite de Pasajeros: " . $this::MAX_PASAJEROS_AUTOMOVIL;
    }
}

class Motocicleta extends VehiculoMotorizado {
    protected $usoDedicado;

    public function __construct($fabricante, $modelo, $anioFabricacion, $kilometraje, $usoDedicado) {
        parent::__construct($fabricante, $modelo, $anioFabricacion, $kilometraje);
        $this->usoDedicado = $usoDedicado;
    }

    public function toString() {
        return parent::toString() . "<br>Uso Dedicado: " . $this->usoDedicado;
    }
}

class Camion extends VehiculoMotorizado implements CapacidadLimite {
    protected $remolques;
    protected $seguridad;

    public function __construct($fabricante, $modelo, $anioFabricacion, $kilometraje, $remolques, $seguridad) {
        parent::__construct($fabricante, $modelo, $anioFabricacion, $kilometraje);
        $this->remolques = $remolques;
        $this->seguridad = $seguridad;
    }

    public function toString() {
        return parent::toString() . "<br>Número de Remolques: " . $this->remolques . "<br>Seguridad: " . $this->seguridad . "<br>Límite de Pasajeros: " . $this::MAX_PASAJEROS_CAMION;
    }
}

$tipo_vehiculo = $_POST['tipo_vehiculo'];

if ($tipo_vehiculo === "Automovil") {
    $vehiculo = new Automovil("Ford", "Focus", 2022, 20000, "Sedán");
} elseif ($tipo_vehiculo === "Motocicleta") {
    $vehiculo = new Motocicleta("Yamaha", "YZF-R1", 2020, 10000, "Deportiva");
} elseif ($tipo_vehiculo === "Camion") {
    $vehiculo = new Camion("Volvo", "VNL", 2019, 50000, 2, "Alta");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Información del Vehículo</title>
</head>
<body>
    <div class="container">
        <h1>Información del Vehículo</h1>
        <p><?php echo $vehiculo->toString(); ?></p>
    </div>
</body>
</html>
