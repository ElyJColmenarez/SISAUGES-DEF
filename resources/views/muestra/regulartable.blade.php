
 <table class="table table-bordered table-striped mb-none">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Tipo</th>
            <th>Fecha de Recepción</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="table-t-body modalscript">

                           
    @foreach($data['registros'] as $muestra)

        <tr class="gradeX">
            <td>{{$muestra->codigo_muestra}}</td>
            <td>{{$muestra->tipo_muestra}}</td>
            <td>{{$muestra->fecha_recepcion}}</td>
            <td>{{$muestra->status}}</td>
            <td class="actions">
                <a href="#" class="btn btn-warning click" data-typeform="modify" data-taction="registerform" data-field-id="{{$muestra->id_muestra}}"><i class="fa fa-pencil"></i></a>
                <a href="#" class="btn btn-danger remove-row deleted-row" data-typeform="deleted" data-taction="registerform" data-field-id="{{$muestra->id_muestra}}"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>

    @endforeach

    </tbody>

</table>