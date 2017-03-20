@foreach($instituciones as $institucion)

    <tr class="gradeX">
        <td>{{$institucion->nombre_institucion}}</td>
        <td>{{$institucion->direccion_institucion}}</td>
        <td>{{$institucion->telefono_institucion}}</td>
        <td class="actions">
            <a href="#" class="btn btn-warning click" data-typeform="modify" data-taction="registerform" data-field-id="{{$institucion->id_institucion}}"><i class="fa fa-pencil"></i></a>
            <a href="#" class="btn btn-danger remove-row deleted-row" data-typeform="deleted" data-taction="registerform" data-field-id="{{$institucion->id_institucion}}"><i class="fa fa-trash-o"></i></a>
        </td>
    </tr>

@endforeach
