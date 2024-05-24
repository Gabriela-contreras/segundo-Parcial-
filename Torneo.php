<?php
// Implementar la clase Torneo que contiene la colección de partidos y un importe que será parte del premio. 
// Cuando un Torneo es creado la colección de partidos debe ser creada como una colección vacía.
// Implementar la jerarquía de herencia que crea necesaria para modelar los Partidos.
class Torneo
{

    private $colPartidos;
    private $importe;


    public function __construct($colPartidos, $importe)
    {

        $this->colPartidos = $colPartidos;
        $this->importe = $importe;
    }

    public function getColPartidos()
    {
        return $this->colPartidos;
    }

    public function setColPartidos($value)
    {
        $this->colPartidos = $value;
    }

    public function getImporte()
    {
        return $this->importe;
    }

    public function setImporte($value)
    {
        $this->importe = $value;
    }


    public function ArraytoString($array)
    {
        $result = "";
        foreach ($array as $element) {
            $result = $result . $element . " ";
        }
        return $result;
    }


    public function __toString()
    {
        return "Datos Torneo:" .
            $this->ArraytoString($this->getColPartidos()) . "\n" .
            "Importe : " . $this->getImporte();
    }


    /**
     * Implementar el método ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) 
     * en la  clase Torneo el cual recibe por parámetro 2 equipos, la fecha en la que se realizará 
     * el partido y si se trata de un partido de futbol o basquetbol . El método debe crear y retornar 
     * la instancia de la clase Partido que corresponda y almacenarla en la colección de partidos del Torneo.
     * Se debe chequear que los 2 equipos tengan la misma categoría e igual cantidad de jugadores, 
     * caso contrario no podrá ser registrado ese partido en el torneo.  
     */
    public function ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido)
    {
        $colPartidas = $this->getColPartidos();

        $idPartido = 1;
        if (count($colPartidas) != 0) {
            $idPartido = count($colPartidas) + 1;
        }

        $tipoCategoriaEquipo1 = $OBJEquipo1->getObjCategoria()->getidcategoria();
        $tipoCategoriaEquipo2 = $OBJEquipo2->getObjCategoria()->getidcategoria();

        $cantIntegrantesEquipo1 = $OBJEquipo2->getCantJugadores();
        $cantIntegrantesEquipo2 = $OBJEquipo2->getCantJugadores();

        $newPartido = "no se puede registrar";

        if ($tipoCategoriaEquipo1 == $tipoCategoriaEquipo2 && $cantIntegrantesEquipo1 == $cantIntegrantesEquipo2) {
            $newPartido = new Partido($idPartido, $fecha, $OBJEquipo1, 0, $OBJEquipo2, 0, $tipoPartido);
            $colPartidas[] = $newPartido;
            $this->setColPartidos($colPartidas);
        }

        return $newPartido;
    }






    // Implementar el método darGanadores($deporte) en la clase Torneo que recibe por parámetro si se trata de un partido
    //  de fútbol o de básquetbol y en  base  al parámetro busca entre esos partidos 
    // los equipos ganadores ( equipo con mayor cantidad de goles). El método retorna una colección con los objetos de los equipos encontrados.
    public function darGanadores($deporte)
    {
        $colEquipos = [];
        foreach ($this->getColPartidos() as $partido) {


            if ($deporte == "futbol" && $partido instanceof PartFutbol) {

                $equipo = $partido->darEquipoGanador();
                array_push($colEquipos, $equipo);
            } elseif ($deporte == "basquetbol" && $partido instanceof PartBasquet) {

                $equipo = $partido->darEquipoGanador();
                array_push($colEquipos, $equipo);
            }
        }
        return $colEquipos;
    }


    //     Implementar el método calcularPremioPartido($OBJPartido) que debe retornar un arreglo asociativo donde una de sus claves
    //      es ‘equipoGanador’  y contiene la referencia al equipo ganador; y la otra clave es ‘premioPartido’ que contiene el valor
    //       obtenido del coeficiente del Partido por el importe configurado para el torneo. 
    // (premioPartido = Coef_partido * ImportePremio)


    public function calcularPremioPartido($OBJPartido)
    {
        if ($OBJPartido instanceof PartFutbol) {
            $deporte = "futbol";
        } elseif ($OBJPartido instanceof PartBasquet) {
            $deporte = "basquet";
        }
        $premio = $OBJPartido->coeficientePartido() * $this->getImporte();
        $ganador = $this->darGanadores($deporte);
        $arr = ["equipoGanador" => $ganador, "premioPartido" => $premio];

        return $arr;
    }
}
