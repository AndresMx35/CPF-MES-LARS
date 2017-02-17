<?php
/**
 * Created by PhpStorm.
 * User: andresrodriguez
 * Date: 16/02/17
 * Time: 21:41
 */

function traerConstantesComplejidad($complejidad){
    $constantes = array();
    foreach ($complejidad as $item){
        switch ($item){
            case 'Entradas':case 'Consultas':
                $baja = 3;
                $media = 4;
                $alta = 6;
                break;
            case 'Salidas':
                $baja = 4;
                $media = 5;
                $alta = 7;
                break;
            case 'Archivos':
                $baja = 7;
                $media = 10;
                $alta = 15;
                break;
            case 'Interfaces':
                $baja = 5;
                $media = 7;
                $alta = 10;
                break;
            default:
                $baja = 0;
                $media = 0;
                $alta = 0;
                break;
        }
        $constantes['baja'.$item] = $baja;
        $constantes['media'.$item] = $media;
        $constantes['alta'.$item] = $alta;
    }
    return $constantes;
}

function puntosFuncionNoAjustados($parametros,$constantes,$valores){
    $sumatoria = 0;
    foreach ($parametros as $parametro){
        $sumatoria+=($constantes['baja'.$parametro]*$valores['baja'.$parametro])+($constantes['media'.$parametro]*$valores['media'.$parametro])+($constantes['alta'.$parametro]*$valores['alta'.$parametro]);
    }
    return $sumatoria;
}

function sumatoriaFactotesInfluencia($valores){
    $sumatoriaFI = 0;
    $contador = 1 ;
    while($contador <15){
        $sumatoriaFI+=$valores['c'.$contador++];
    }
    return $sumatoriaFI;
}

function factorCritico($sumatoriaFI){
    $factor = $sumatoriaFI*0.01+0.65;
    return $factor;
}

function puntosFuncionAjustados($PFNA,$factorCritico){
    $PFA = $PFNA*$factorCritico;
    return $PFA;
}

function sloc($lenguajes,$PFA){
    $sloc = array();
    foreach ($lenguajes as $lenguaje=>$valor){
        $sloc[$lenguaje] = $valor * $PFA;
    }
    return $sloc;
}

function ksloc($slocs){
    $ksloc = array();
    foreach ($slocs as $lenguaje=>$sloc){
        $ksloc[$lenguaje] = $sloc/1000;
    }
    return $ksloc;
}

function formarTablaLenguajes($lenguajes, $sloc, $ksloc){
    $cabeceras = '<div class="table-responsive">
    <table class="table table-condensed table stripped table-hover">
        <thead>
            <tr class=" bg-primary">
                <th class="text-uppercase"><small>Lenguaje</small></th>
                <th class="text-uppercase"><small>LDC/PF</small></th>
                <th class="text-uppercase"><small>SLOC</small></th>
                <th class="text-uppercase"><small>KSLOC</small></th>
            </tr>
        </thead>
        <tbody>';
    $cuerpo = '';
    $cierre = '</tbody></table></div>';
    foreach ($lenguajes as $lenguaje=>$valor){
        $cuerpo.= '
            <tr>
                <th class="text-uppercase"><strong>'.$lenguaje.'</strong></th>
                <th class="text-uppercase"><strong>'.$valor.'</strong></th>
                <th class="text-uppercase"><strong>'.number_format($sloc[$lenguaje],0,'.',',').'</strong></th>
                <th class="text-uppercase"><strong>'.number_format($ksloc[$lenguaje],2,'.',',').'</strong></th>
            </tr>';
    }
    $tabla = $cabeceras.$cuerpo.$cierre;
    return $tabla;
}

function calculoCostoPuntosFuncion($PFA, $costoPorPunto){
    $costoTotal = $PFA * $costoPorPunto;
    return $costoTotal;
}
?>



