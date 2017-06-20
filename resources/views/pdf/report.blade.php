<!DOCTYPE html>
<html>
<head>
    <title>Documento</title>

    <style type="text/css">
        
        table{
            width: 100%;
            margin: 9px 0px;
            border-collapse: collapse;
        }

        table, th, td{
            border: solid 1px #000;
        }

        .muestras table, .muestras th, .muestras td{
            border: none!important;
        }

        .muestras{
          border: none;
        }

        body{
            font-size: 12px;
            font-family: arial;
        }

        td{
            font-size: 10px;
            padding-top: 1px;
            padding-bottom: 12px;
            padding-left: 4px;
        }

        td span{
            padding: 0px;
            margin: 0px;
            position: absolute;
            right: 0px;
            top: 0px;
        }

        .centrados{
            text-align: center;
        }
        .obscuros{
            background-color: rgb(178,178,178);
        }

        .icon{
            width: 100%;
            text-align:center;
        }

        .icon img{
          width: 60%;
        }

        p{
          font-weight: bold;

        }

    </style>
</head>
<body>

    <div class="icon">
        <img src="{{asset('assets/backgrounds/BANNER1.png')}}">
    </div>

    <table>
        <tbody>
            <tr>
                <th class="centrados">
                    Reporte realizado por el departamento de Microcopia Electronica de Barrido del Instituto Universitario Dr. Federico Rivero Palacio.
                </th>
            </tr>
        </tbody>
    </table>

    <table>
        <tbody>
            <tr class="obscuros">
                <th class="centrados">
                    Datos del Proyecto
                </th>
            </tr>
        </tbody>
    </table>


    <table>
        <tbody>
            <tr>
                <td colspan="2">
                    <span>Nombre del Proyecto</span>
                    <p>{{ $proyecto->nombre_proyecto }}</p>
                </td>
                <td>
                    <span>Fecha de emisión</span>
                    <p>{{ date('d/m/Y') }}</p>
                </td>
                <td>
                    <span>Fecha de solicitud del proyecto</span>
                    <p>{{ $proyecto->fecha_inicio }}</p>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center;">
                    <h3>Institución</h3>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <span>Nombre de la Institución</span>
                    <p>{{ $institucion->nombre_institucion }}</p>
                </td>
            </tr>

            <tr>
                <td colspan="4">
                    <span>Dirección de la Institución</span>
                    <p>{{ $institucion->direccion_institucion }}</p>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="text-align: center;">
                    <h3>Investigador</h3>
                </td>
            </tr>

            <tr>
                <td>
                    <span>Cedula</span>
                    <p>{{ $estudiante->cedula_persona }}</p>
                </td>
                <td>
                    <span>Nombre</span>
                    <p>{{ $persona->nombre }} {{ $persona->apellido }}</p>
                </td>
                <td>
                    <span>Carrera</span>
                    <p>{{ $estudiante->carrera_estudiante }}</p>
                </td>
                <td>
                    <span>Semestre</span>
                    <p>{{ $estudiante->semestre_estudiante }}</p>
                </td>
            </tr>
        </tbody>
    </table>


    <table>
        <tbody>
            <tr class="obscuros">
                <th class="centrados">
                    Muestras
                </th>
            </tr>
        </tbody>
    </table>

    <table class="muestras">
        
        <?php

          if (count($request->archivosincluidos)>0) {
            

            $muestras=array_chunk($request->archivosincluidos,4);

            foreach ($muestras as $key => $value) {
              
              echo "<tr>";

                foreach ($value as $key2 => $value2) {
                
                    $muestravalue=$mstr->find($value2);

                    $ruta=$muestravalue->ruta_img_muestra.$muestravalue->nombre_temporal_muestra;
                    $finfo = new finfo(FILEINFO_MIME);
                    $type = explode(';', $finfo->file($ruta));


                    if (explode('/', $type[0])[0]=='image') {

                      $extension=explode('.', $muestravalue->nombre_temporal_muestra);
                      $rutaweb=url($muestravalue->ruta_img_muestra.'visibles/'.str_replace($extension[1], 'jpg', $muestravalue->nombre_temporal_muestra));

                      echo "<td class='icon' style='width: 20%;'> <img style='width: 250px; height: 250px;' src='".$rutaweb."'> </td>";

                    }

                    

                }

              echo "</tr>";

            }


          }


        ?>

        <tr>
            <td></td>
        </tr>


    </table>





</body>
</html>