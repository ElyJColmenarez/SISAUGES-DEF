<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>MUESTRA</title>
    {!! Html::style('assets/css/pdf.css') !!}
  </head>
  <body>
    <header>
      <div id="logo">
        <img src="{{ url('/') }}/assets/complementos/BANNER1.png">
      </div>
      <h1>Reporte de Muestras</h1>
      <div id="campo-inst">
        <div>IUT. Federico Rivero Palcio</div>
        <div>XXXXX<br /> XXXXXX</div>
        <div>(000) 000-0000</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      <hr>
      <div id="campo-pro">
        <div><span>ACTIVIDAD</span><?php echo $request->actividad; ?></div>
        <div><span>REPRESENTANTE</span> <?php echo $request->representante; ?></div>
        <div><span>INSTITUCIÓN</span><?php echo $request->indtitucion; ?> </div>
        <div><span>FECHA DE EMISIÓN</span> <?php date('d-m-Y'); ?></div>
        <div><span>FECHA DE MUESTREO</span> <?php echo $data1->fecha_analisis; ?></div>
      </div>
    </header>

    <div id="imagen-muestra">
      <img src="<?php echo url('/storage').'/'.$data1->tipo_muestra; ?>">
    </div>

    <main>
      <table>
        <thead>
          <tr>
            <th>DESCRIPCIÓN</th>
            <th>TECNICA DE ESTUDIO</th>
            <th>NOMBRE IMAGEN</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td ><?php echo $data1->descripcion_muestra; ?></td>
            <td ><?php echo $request->tecnica; ?></td>
            <td ><?php echo $data1->nombre_original_muestra; ?></td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>ANEXO:</div>
        <div class="notice">Texto de Relleno</div>
      </div>
    </main>


    <footer>
      Todos los derechos Reservados
    </footer>
  </body>
</html>