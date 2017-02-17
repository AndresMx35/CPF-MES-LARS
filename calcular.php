<?php
/**
 * Created by PhpStorm.
 * User: andresrodriguez
 * Date: 16/02/17
 * Time: 21:40
 */

require ('funciones/funciones.php');
$lenguajes = array(
    '4GL'=>40,
    'Ada 83'=>71,
    'Ada 95'=>49,
    'APL'=>32,
    'BASIC - compilado'=>91,
    'BASIC - interpretado'=>128,
    'BASIC ANSI/Quick/Turbo'=>64,
    'C'=>128,
    'C++'=>29,
    'Clipper'=>19,
    'Cobol ANSI 85'=>91,
    'Delphi 1'=>29,
    'Ensamblador '=>320,
    'Ensamblador (Macro)'=>213,
    'Forth'=>64,
    'Fortran 77'=>105,
    'FoxPro 2.5'=>34,
    'Generador de Informes'=>80,
    'Hoja de Calculo'=>6,
    'Java'=>53,
    'Modula 2'=>80,
    'Oracle'=>40,
    'Oracle 2000'=>23,
    'Paradox'=>36,
    'Pascal '=>91,
    'Pascal Turbo 5'=>49,
    'Power Builder'=>16,
    'Prolog'=>64,
    'Visual Basic 3'=>32,
    'Visual C++'=>34,
    'Visual Cobol'=>20,
);
$parametros = array('Entradas', 'Consultas','Salidas','Archivos','Interfaces');
$constantesComplejidad = traerConstantesComplejidad($parametros);
$puntosFuncionNoAjustados = puntosFuncionNoAjustados($parametros,$constantesComplejidad,$_POST);
$sumatoriaFactoresInfluencia = sumatoriaFactotesInfluencia($_POST);
$factorCritico = factorCritico($sumatoriaFactoresInfluencia);
$puntosFuncionAjustados = puntosFuncionAjustados($puntosFuncionNoAjustados,$factorCritico);
$puntosFuncionAjustadosRedondeados = round($puntosFuncionAjustados);
$lineasCodigoFuente = sloc($lenguajes, $puntosFuncionAjustadosRedondeados);
$milesLineasCodigoFuente = ksloc($lineasCodigoFuente);
$tabla = formarTablaLenguajes($lenguajes,$lineasCodigoFuente, $milesLineasCodigoFuente);
$costoProyecto = calculoCostoPuntosFuncion($_POST['costoPuntoFuncion'],$puntosFuncionAjustadosRedondeados);
?>
<div class="row">
    <div class="col-sm-6 col-xs-12">
        
        <ul class="nav nav-pills  nav-stacked">
            <li class="active"><a href="#">Puntos de Función No Ajustados: <span class="badge"><?=$puntosFuncionNoAjustados?></span></a></li>
            <li class="active"><a href="#">Sumatoria Factores de Influencia: <span class="badge"><?=$sumatoriaFactoresInfluencia?></span></a></li>
            <li class="active"><a href="#">Factor Critico: <span class="badge"><?=$factorCritico?></span></a></li>
            <li class="active"><a href="#">Puntos de Función Ajustados (Sin Redondear): <span class="badge"><?=$puntosFuncionAjustados?></span></a></li>
            <li class="active"><a href="#">Puntos de Función Ajustados (Redondeados): <span class="badge"><?=$puntosFuncionAjustadosRedondeados?></span></a></li>
            <li class="active"><a href="#">Costo del Proyecto: <span class="badge">$ <?=number_format($costoProyecto,2,'.',',')?></span></a></li>

        </ul>

    </div>
    <div class="col-sm-6 col-xs-12">
        <?= $tabla;?>
    </div>
</div>

