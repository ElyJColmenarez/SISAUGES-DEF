@foreach($data['registros'] as $persona)
    @foreach($data['registros2'] as $usuario)
        <tr class="gradeX">
            <td>{{$persona->cedula}}</td>
            <td>{{$persona->nombre}}</td>
            <td>{{$usuario->id_usuario}}</td>
            <td class="actions">
                <a href="#" class="btn btn-warning click" data-typeform="modify" data-taction="register-form" data-field-id="{{$usuario->id_usuario}}"><i class="fa fa-pencil"></i></a>
                <a href="#" class="btn btn-danger remove-row deleted-row" data-typeform="deleted" data-taction="register-form" data-field-id="{{$usuario->id_usuario}}"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
    @endforeach
@endforeach
