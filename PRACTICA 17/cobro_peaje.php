<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cobro de Peaje de Camiones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Cobro de Peaje de Camiones</h1>
    <form method="post">
        <label for="ejes">Número de Ejes:</label>
        <input type="number" id="ejes" name="ejes" required>
        <br>
        <label for="toneladas">Toneladas de Peso:</label>
        <input type="number" id="toneladas" name="toneladas" required>
        <br>
        <button type="submit" name="calcular">Calcular Peaje</button>
    </form>
    <div id="resultado">
        <h2>Resumen del Cobro</h2>
        <table>
            <tr>
                <th>Número de Camiones</th>
                <th>Peaje Total Recaudado (€)</th>
            </tr>
            <tr>
                <td><?php echo $numCamionesPasados; ?></td>
                <td><?php echo number_format($totalPeajeRecaudado, 2); ?></td>
            </tr>
        </table>
    </div>
</body>
</html>

<?php
class Camion {
    private $ejes;
    private $toneladas;

    public function __construct($ejes, $toneladas) {
        $this->ejes = $ejes;
        $this->toneladas = $toneladas;
    }

    public function calcularPeaje() {
        $peajeEjes = $this->ejes * 5;
        $peajeToneladas = $this->toneladas * 10;
        return $peajeEjes + $peajeToneladas;
    }
}

class CabinaPeaje {
    private $numCamionesPasados = 0;
    private $totalPeajeRecaudado = 0.00;

    public function procesarCamion($ejes, $toneladas) {
        $camion = new Camion($ejes, $toneladas);
        $peaje = $camion->calcularPeaje();

        $this->numCamionesPasados++;
        $this->totalPeajeRecaudado += $peaje;
    }

    public function getNumCamionesPasados() {
        return $this->numCamionesPasados;
    }

    public function getTotalPeajeRecaudado() {
        return $this->totalPeajeRecaudado;
    }
}

$cabina = new CabinaPeaje();

if (isset($_POST['calcular'])) {
    $ejes = $_POST['ejes'];
    $toneladas = $_POST['toneladas'];

    if (!empty($ejes) && !empty($toneladas)) {
        $cabina->procesarCamion($ejes, $toneladas);
    }
}

$numCamionesPasados = $cabina->getNumCamionesPasados();
$totalPeajeRecaudado = $cabina->getTotalPeajeRecaudado();
?>
