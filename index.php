<?php
/**
 * Created by PhpStorm.
 * User: andresrodriguez
 * Date: 16/02/17
 * Time: 19:11
 */


require('funciones/plantilla.php');
encabezado();
$tabla = array('Entradas', 'Consultas', 'Salidas', 'Archivos', 'Interfaces');
$contador = 1;
?>
<div class="panel panel-inverse">
    <div class="panel-heading text-center jumbotron">
        <h1 class="panel-title">Calculadora de Puntos de Función</h1>
    </div>
    <div class="panel-body">

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-inverse ">
                <div class="panel-heading " role="tab" id="cabeceraCalculadora" data-toggle="collapse"
                     data-parent="#accordion" href="#cuerpoCalculadora" aria-expanded="true"
                     aria-controls="cuerpoCalculadora">
                    <h4 class="panel-title ">Calculadora</h4>
                </div>
                <div id="cuerpoCalculadora" class="panel-collapse collapse in" role="tabpanel"
                     aria-labelledby="cabeceraCalculadora">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-offset-9 col-xs-3">
                                <button type="button" class="btn btn-block btn-default btn-inverse btn-raised"
                                        data-toggle="modal" data-target="#informacionConstantes">Valores
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-stripped table-condensed table-hover">
                                        <thead>
                                        <tr class="active">
                                            <th class="text-uppercase">
                                                <small>Concepto</small>
                                            </th>
                                            <th class="text-uppercase">
                                                <small>Complejidad Baja</small>
                                            </th>
                                            <th class="text-uppercase">
                                                <small>Complejidad Media</small>
                                            </th>
                                            <th class="text-uppercase">
                                                <small>Complejidad Alta</small>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($tabla as $concepto) { ?>
                                            <tr>
                                                <th class="text-uppercase">
                                                    <small><?= $concepto ?></small>
                                                </th>
                                                <th class="text-uppercase"><input type="number"
                                                                                  name="baja<?= $concepto ?>" step="1"
                                                                                  min="0" value="0"
                                                                                  class="input-sm form-control"
                                                                                  required></th>
                                                <th class="text-uppercase"><input type="number"
                                                                                  name="media<?= $concepto ?>" step="1"
                                                                                  min="0" value="0"
                                                                                  class="input-sm form-control"
                                                                                  required></th>
                                                <th class="text-uppercase"><input type="number"
                                                                                  name="alta<?= $concepto ?>" step="1"
                                                                                  min="0" value="0"
                                                                                  class="input-sm form-control"
                                                                                  required></th>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-xs-12">
                                    <label class="text-uppercase label label-inverse">
                                        <small>Costo por Punto de Función:</small>
                                    </label>
                                    <input type="number" class="form-control" step="0.5" value="0.0" min="0"
                                           placeholder="Opcional" name="costoPuntoFuncion"/>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-stripped table-hover">
                                        <tbody>
                                        <?php while ($contador < 15) { ?>
                                            <tr>
                                                <th class="text-uppercase">
                                                    <small>c<sub><?= $contador ?></sub></small>
                                                </th>
                                                <th class="text-uppercase"><input type="number"
                                                                                  name="c<?= $contador++ ?>" step="1"
                                                                                  min="0" max="5" value="3"
                                                                                  class="input-sm form-control"
                                                                                  required></th>
                                                <th class="text-uppercase">
                                                    <small>c<sub><?= $contador ?></sub></small>
                                                </th>
                                                <th class="text-uppercase"><input type="number"
                                                                                  name="c<?= $contador++ ?>" step="1"
                                                                                  min="0" max="5" value="3"
                                                                                  class="input-sm form-control"
                                                                                  required></th>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12">
                                <button type="button" class="btn btn-raised btn-inverse btn-block" name="calcular">
                                    Calcular
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-inverse">
                <div class="panel-heading" role="tab" id="cabeceraResultados" data-toggle="collapse"
                     data-parent="#accordion"
                     href="#cuerpoResultados" aria-expanded="false" aria-controls="cuerpoResultados">
                    <h4 class="panel-title">Resultados</h4>
                </div>
                <div id="cuerpoResultados" class="panel-collapse collapse" role="tabpanel"
                     aria-labelledby="cabeceraResultados">
                    <div class="panel-body" id="contenidoResultado">
                        <div class="row">
                            <div class="col-xs-12">
                                <h1>Sin resultado :'(</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
piePagina();
?>
<script>
    var controles = $('input');

    $('[name="calcular"]').click(function () {
        if (verificarVacio()) {
            calcular();
        } else {
            $.snackbar({
                content: 'No se puede realizar la operación. Uno o más campos están vacios.',
                style: 'toast',
                time: '5'
            });
        }
    });

    function verificarVacio() {
        var bandera = true;
        controles.each(function (llave, valor) {
            var valor = $.trim($(this).val());
            if (valor === '') bandera = false;
        });
        return bandera;
    }
    function obtenerDatos() {
        var datos = {};
        controles.each(function (indice, valor) {
            datos[$(this).attr('name')] = $(this).val();
        });
        return datos;
    }

    function calcular() {
        var datosFormulario;
        var error = '<div class="row"> ' + '   <div class="col-xs-12 text-center"> ' + '<h1>Ha ocurrido un error :\'(</h1>' + '</div> ' + '</div>';
        var cargar = '<div class="row"> ' + '   <div class="col-xs-12 text-center"> ' + '<h1>Cargando...</h1>' + '       <div class="progress progress-striped active"> ' + '<div class="progress-bar" style="width: 100%"></div> ' + '</div>' + '</div> ' + '</div>';
        $('#cuerpoResultados').collapse('show');
        $('#contenidoResultado').html(cargar);
        $('#cuerpoCalculadora').collapse('hide');
        datosFormulario = obtenerDatos();
        $.post("calcular.php", datosFormulario).done(function (x) {
            $('#contenidoResultado').html(x);
        })
            .fail(function () {
                $('#contenidoResultado').html(error);
            });
    }
</script>

<div class="modal " id="informacionConstantes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Valores de Constantes</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h3>Parametros Significativos</h3>
                        <div class="table-responsive">
                            <table class="table table-stripped table-condensed table-hover">
                                <thead>
                                <tr class="active">
                                    <th class="text-uppercase">
                                        <small>Concepto</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>Complejidad Baja</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>Complejidad Media</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>Complejidad Alta</small>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th class="text-uppercase">
                                        <small>Entradas</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x3</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x4</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x6</small>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-uppercase">
                                        <small>Consultas</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x3</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x4</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x6</small>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-uppercase">
                                        <small>Salidas</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x4</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x5</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x7</small>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-uppercase">
                                        <small>Archivos</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x7</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x10</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x15</small>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-uppercase">
                                        <small>Interfaces</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x5</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x7</small>
                                    </th>
                                    <th class="text-uppercase">
                                        <small>x10</small>
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <h3>Factores de Influencia</h3>
                    <div class="table-responsive">
                        <table class="table table-stripped table-condensed table-hover">
                            <thead>
                            <tr class="active">
                                <th class="text-uppercase">
                                    <small>Código</small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Factor</small>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>1</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Comunicación de Datos</small>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>2</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Funciones Distribuidas</small>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>3</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Rendimiento</small>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>4</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Configuración Usada Fuertemente</small>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>5</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Tasa de Transacciones</small>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>6</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Entrada de Datos en Linea</small>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>7</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Eficiencia del Usuario Final</small>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>8</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Actualización en Linea</small>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>9</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Procesamiento Complejo</small>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>10</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Reusabilidad</small>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>11</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Facilidad de Instalación</small>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>12</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Facilidad de Operación</small>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>13</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Sitios Múltiples</small>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase">
                                    <small>C<sub>14</sub></small>
                                </th>
                                <th class="text-uppercase">
                                    <small>Facilidad de Cambios</small>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-raised" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>