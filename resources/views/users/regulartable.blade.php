
 <table class="table table-bordered table-striped mb-none">
    <thead>
        <tr>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Nombre de Usuario</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="table-t-body modalscript">

        @foreach($data['registros'] as $usuario)


                <tr class="gradeX">
                    <td>{{$usuario->cedula_persona}}</td>
                    <td>{{$usuario->persona->nombre}}</td>
                    <td>{{$usuario->username}}</td>
                    <td class="actions">
                        <a href="#" class="btn btn-warning click" data-typeform="modify" data-taction="registerform" data-field-id="{{$usuario->id_usuario}}"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-danger remove-row deleted-row" data-typeform="delete" data-taction="registerform" data-field-id="{{$usuario->id_usuario}}"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>

        @endforeach


    </tbody>

</table>