
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
                    $extension=explode('.', $aux[0]->nombre_temporal_muestra);
                    $rutaweb=url($aux[0]->ruta_img_muestra.'visibles/'.str_replace($extension[1], 'jpg', $aux[0]->nombre_temporal_muestra));
                }else{
                    $rutaweb=asset('assets/images/nodisponible.svg');
                }

            ?>
            <td><div class="tbl-imgcontainer"><img src="{{ $rutaweb }}"></div></td>
            <td>{{$muestra->codigo_muestra}}</td>
            <td>{{$muestra->tipoMuestra()->first()->descripcion_tipo_muestra}}</td>
            <td>{{$muestra->fecha_recepcion}}</td>
            <td>@if($muestra->estatus==1) Activo @else Inactivo @endif</td>
            <td>{{ count($aux) }}</td>
            <td class="actions">
                <a href="#" class="btn btn-warning click" data-typeform="modify" data-taction="registerform" data-field-id="{{$muestra->id_muestra}}"><i class="fa fa-pencil"></i></a>
                <a href="#" class="btn btn-danger remove-row deleted-row" data-typeform="deleted" data-taction="registerform" data-field-id="{{$muestra->id_muestra}}"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>

    @endforeach

    </tbody>

</table>