
 <table class="table table-bordered table-striped mb-none">
    <thead>
        <tr>
            <th>Cedula</th>
            <th>Nombre</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="table-t-body modalscript">

        @foreach($data['registros'] as $tutor)


                <tr class="gradeX">
                    <td>{{$tutor->persona->cedula}}</td>
                    <td>{{$tutor->persona->nombre}}</td>
                    <td class="actions">
                        <a href="#" class="btn btn-warning click" data-typeform="modify" data-taction="registerform" data-field-id="{{$tutor->id_tutor}}"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-danger remove-row deleted-row" data-typeform="delete" data-taction="registerform" data-field-id="{{$tutor->id_tutor}}"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>

        @endforeach

    </tbody>

</table>