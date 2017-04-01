 <table class="table table-bordered table-striped mb-none">
    <thead>
        <tr>
            <th>Modulo</th>
            <th>Operador</th>
            <th>Descripción</th>
            <th>usuario</th>
            <th>fecha</th>
        
        </tr>
    </thead>
    <tbody class="table-t-body modalscript">                    


@foreach($data['registros'] as $data)

    <tr class="gradeX">
        <td>{{$data->modulo}}</td>
        <td>{{$data->operacion}}</td>
        <td>{{$data->descripcion}}</td>
        <td>{{$data->usuario}}</td>
        <td>{{$data->fecha}}</td>
       
    </tr>

@endforeach


</tbody>

</table>