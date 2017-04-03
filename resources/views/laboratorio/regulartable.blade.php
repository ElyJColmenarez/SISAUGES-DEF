 <table class="table table-bordered table-striped mb-none">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Ubicacion</th>
            <th>Telefono</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="table-t-body modalscript">                    


@foreach($data['registros'] as $data)

    <tr class="gradeX">
        <td>{{$data->nombre_laboratorio}}</td>
        <td>{{$data->ubicacion_laboratorio}}</td>
        <td>{{$data->telefono_laboratorio}}</td>
        <td> @if ($data->estatus == 1)  
        		{{ 'activo'  }}
 			 @else
 			 	{{ 'inactivo '}}
        	 @endif 
        	</td>
        <td class="actions">
            <a href="#" class="btn btn-warning click" data-typeform="modify" data-taction="registerform" data-field-id="{{$data->id_laboratorio}}"><i class="fa fa-pencil"></i></a>
            <a href="#" class="btn btn-danger remove-row deleted-row" data-typeform="deleted" data-taction="registerform" data-field-id="{{$data->id_laboratorio}}"><i class="fa fa-trash-o"></i></a>
        </td>
    </tr>

@endforeach


</tbody>

</table>