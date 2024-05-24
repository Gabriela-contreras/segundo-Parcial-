<?php
class PartBasquet extends Partido
{

    private $CofP;
    private $cantidadInfracciones;

    public function __construct($idPartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGoles2, $cantidadInfracciones)
    {
        parent::__construct($idPartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGoles2);
        $this->cantidadInfracciones = $cantidadInfracciones;
        $this->CofP = parent::getCoefBase() - (0.75 * $cantidadInfracciones);
    }

    public function getCofP()
    {
        return $this->CofP;
    }

    public function setCofP($value)
    {
        $this->CofP = $value;
    }


    public function getCantidadInfracciones()
    {
        return $this->cantidadInfracciones;
    }

    public function setCantidadInfracciones($value)
    {
        $this->cantidadInfracciones = $value;
    }


    public function __toString()
    {
        $cadena = parent::__toString();
        $cadena .= "coeficiente :" . $this->coeficientePartido() . "\n" .
            "Cantidad Infracciones : " . $this->getCantidadInfracciones();
        return $cadena;
    }


    public function coeficientePartido()
    {
        $cof = parent::coeficientePartido();
        $cofBasquet = $cof - (0.75 * $this->getCantidadInfracciones());
        return $cofBasquet;
    }
}
