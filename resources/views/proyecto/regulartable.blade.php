
 <table class="table table-bordered table-striped mb-none">
    <thead>
        <tr>
            <th>Nombre del Proyecto</th>
            <th>Estatus del Proyecto</th>
            <th>Fecha de Recepción</th>
            <th>Fecha de Finalización</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="table-t-body modalscript">

                           
    @foreach($data['registros'] as $proyecto)

        <tr class="gradeX">
            <td>{{$proyecto->nombre_proyecto}}</td>
            <td>{{$proyecto->estatus_proyecto}}</td>
            <td>{{$proyecto->fecha_inicio}}</td>
            <td>{{$proyecto->fecha_final}}</td>
            <td class="actions">

                @if(Auth::user()->id_rol != 4)
                    <a href="#" class="btn btn-warning click" data-typeform="modify" data-taction="registerform" data-field-id="{{$proyecto->id_proyecto}}"><i class="fa fa-pencil"></i></a>
                    <a href="#" class="btn btn-danger remove-row deleted-row" data-typeform="deleted" data-taction="registerform" data-field-id="{{$proyecto->id_proyecto}}"><i class="fa fa-trash-o"></i></a>
                    <a href="#" class="btn btn-info click" data-typeform="report" data-taction="registerform" data-field-id="{{$proyecto->id_proyecto}}"><i class="fa fa-file-text"></i></a>

                @else

                    <a href="#" class="btn btn-primary click" data-typeform="modify" data-taction="registerform" data-field-id="{{$proyecto->id_proyecto}}"><i class="fa fa-eye"></i></a>

                @endif

                
            </td>
        </tr>

    @endforeach

    </tbody>

</table>