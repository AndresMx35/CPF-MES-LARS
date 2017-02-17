<?php
/**
 * Created by PhpStorm.
 * User: andresrodriguez
 * Date: 16/02/17
 * Time: 19:27
 */
function encabezado()
{ ?>
    <!doctype html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Calculadora de Puntos de Función | Métricas y Estmación de Software | Luis Andrés Rodríguez
            Santoyo</title>
        <link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="dist/css/bootstrap-material-design.min.css"/>
        <link rel="stylesheet" type="text/css" href="dist/css/ripples.min.css"/>
        <link rel="stylesheet" type="text/css" href="dist/css/snackbar.css"/>
    </head>
    <body>
    <div class="container-fluid">
<?php } ?>

<?php

function piePagina(){
    setlocale(LC_TIME, "es_ES");
    ?>
    <div class="row text-center">
        <div class="alert alert-default col-md-offset-3 col-md-6 col-sm-offset-1 col-sm-10 col-xs-12 ">
            <span class="label label-inverse">Luis Andrés Rodríguez Santoyo</span><br>
            <label>13120158</label> |
            <label>Ingeniería en Tecnologías de Información y Comunicaciones</label> |
            <label><?= date('F, Y') ?></label>
        </div>
    </div>
    </div>
    <script src="dist/js/jquery-3.1.1.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/js/material.min.js"></script>
    <script src="dist/js/ripples.min.js"></script>
    <script src="dist/js/snackbar.min.js"></script>
    <script>
        $.material.init();
    </script>

    </body>
    </html>
<?php } ?>