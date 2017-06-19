
 <table class="table table-bordered table-striped mb-none">
    <thead>
        <tr>
            <th>Miniatura</th>
            <th>Codigo</th>
            <th>Tipo</th>
            <th>Fecha de Recepción</th>
            <th>Status</th>
            <th>Numero de Archivos</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="table-t-body modalscript">

                           
    @foreach($data['registros'] as $muestra)

        <tr class="gradeX">
            <?php 

                $aux=$muestra->archivo()->get();




                if (count($aux)>0) {


                    foreach ($aux as $muestrakey => $muestravalue) {
                    
                        $ruta=$muestravalue->ruta_img_muestra.$muestravalue->nombre_temporal_muestra;
                        $finfo = new finfo(FILEINFO_MIME);
                        $type = explode(';', $finfo->file($ruta));


                        if (explode('/', $type[0])[0]!='image') {
                            $rutaweb=asset('assets/images/nodisponible.svg');
                        }else{
                            $extension=explode('.', $muestravalue->nombre_temporal_muestra);
                            $rutaweb=url($muestravalue->ruta_img_muestra.'visibles/'.str_replace($extension[1], 'jpg', $muestravalue->nombre_temporal_muestra));

                            break 1;
                        }
                    }

                }else{
                    $rutaweb=asset('assets/images/nodisponible.svg');
                }

            ?>
            <td><div class="tbl-imgcontainer"><img src="{{ $rutaweb }}"></div></td>
            <td>{{$muestra->codigo_muestra}}</td>
            <td> @if(!empty($muestra->id_tipo_muestra)) {{$muestra->tipoMuestra()->first()->descripcion_tipo_muestra}} @endif</td>
            <td>{{$muestra->fecha_recepcion}}</td>
            <td>@if($muestra->estatus==1) Activo @else Inactivo @endif</td>
            <td>{{ count($aux) }}</td>
            <td class="actions">

                @if(Auth::user()->id_rol != 4)

                    <a href="#" class="btn btn-warning click" data-typeform="modify" data-taction="registerform" data-field-id="{{$muestra->id_muestra}}"><i class="fa fa-pencil"></i></a>
                    <a href="#" class="btn btn-danger remove-row deleted-row" data-typeform="deleted" data-taction="registerform" data-field-id="{{$muestra->id_muestra}}"><i class="fa fa-trash-o"></i></a>
                    <a href="{{ url('/muestra/report/'.$muestra->id_muestra) }}" class="btn btn-info down" target="_blank" data-typeform="downfile" data-taction="requestdownfile" data-field-id="{{$muestra->id_muestra}}"><i class="fa fa-cloud-download"></i></a>

                @else

                    <a href="#" class="btn btn-primary click" data-typeform="modify" data-taction="registerform" data-field-id="{{$muestra->id_muestra}}"><i class="fa fa-eye"></i></a>
                    <a href="{{ url('/muestra/report/'.$muestra->id_muestra) }}" class="btn btn-info down" target="_blank" data-typeform="downfile" data-taction="requestdownfile" data-field-id="{{$muestra->id_muestra}}"><i class="fa fa-cloud-download"></i></a>

                @endif

            </td>
        </tr>

    @endforeach

    </tbody>

</table>