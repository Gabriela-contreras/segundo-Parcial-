<?php
class PartFutbol extends Partido
{
    private $cofMenores;
    private $cofJuveniles;
    private $cofMayores;

    public function __construct($idPartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesEquipo2)
    {

        parent::__construct($idPartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesEquipo2);
        $this->cofMenores = 0.13;
        $this->cofJuveniles = 0.19;
        $this->cofMayores = 0.27;
    }

    public function getCofMenores()
    {
        return $this->cofMenores;
    }

    public function setCofMenores($value)
    {
        $this->cofMenores = $value;
    }

    public function getCofJuveniles()
    {
        return $this->cofJuveniles;
    }

    public function setCofJuveniles($value)
    {
        $this->cofJuveniles = $value;
    }

    public function getCofMayores()
    {
        return $this->cofMayores;
    }

    public function setCofMayores($value)
    {
        $this->cofMayores = $value;
    }

    public function __toString()
    {
        $cadena = parent::__toString();
        $cadena .= "Cof Menores :" . $this->getCofMenores() . "\n" .
            "Cof juveniles :" . $this->getCofJuveniles() . "\n" .
            "Cof mayores :" . $this->getCofMayores() . "\n";
        return $cadena;
    }

    public function coeficientePartido()
    {

        $cantGoles = $this->getCantGolesE1() + $this->getCantGolesE2();
        $jugadores = $this->getObjEquipo1()->getCantJugadores() + $this->getObjEquipo2()->getCantJugadores();
        if ($this->getCofMenores()) {
            $result = $this->getCofMenores() * $cantGoles * $jugadores;
        } elseif ($this->getCofJuveniles()) {
            $result = $this->getCofJuveniles() * $cantGoles * $jugadores;
        } elseif ($this->getCofMayores()) {
            $result = $this->getCofMayores() * $cantGoles * $jugadores;
        }
        return $result;
    }
    
}
