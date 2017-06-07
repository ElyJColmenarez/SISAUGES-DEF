jQuery(document).ready(function() {


    /*Vadilations*/


        /*Campos de Correo*/

        function validarEmail(inp) {
            expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            
            if ( !expr.test(inp) ){
                
                inp.val('');
                return inp;
            }else{
                return inp;
            }

                
        };

        /*Campos Numericos*/


        function validarNumeros(inp){
            inp.value = (inp.value + '').replace(/[^0-9]/g, '');
            return inp;

        };   


        /*Campos de Caracteres*/

        function validarCaracteres(inp){

            var aux = inp.val().toString();

            if (aux.match(/[^A-Za-z]/g)) {
                inp.val(aux.replace(/[^A-Za-z]/g, ''));
            };

            return inp;

        };

        /*Campos con Limites de Tamaño*/


        function validarLimites(inp,vars){

            var lim= vars.split(',');

            var retorno=0;

            if (inp.val().length>lim[1]) {
                retorno=1;
            }

            if (inp.val().length>lim[0]) {
                retorno=1;
            }

            return retorno;

        }

        /*Campos Obligatorios*/

        function validarObligatorio(inp){

            var vl1=validarNumeros(inp);
            var vl2=validarCaracteres(inp);

            if (vl1.val().length==0 && vl2.val().length==0) {
                return 0;
            }else{
                return 1;
            }

        }

    /*Validacion General*/
    
    function validacionGeneral(form){

        var retorno=[];
        var pos=0;

        $(form+" .form-control").each(function(){

            var error=0;

            var inp=$(this);

            if ($(this).data('solonumero')) {

                inp=validarNumeros(inp);

                if (inp.val().length==0) {
                    error++;
                    
                }

            }

            if ($(this).data('solocaracteres')) {

                inp=validarCaracteres(inp);

                if (inp.val().length==0) {
                    error++;
                }

            }

            if ($(this).data('solocorreo')) {
                    
                inp=validarEmail(inp);

                if (inp.val().length==0) {
                    error++;
                }

            }

            if ($(this).data('limites')) {
                
                if (validarLimites($(this),$(this).data('limites'))!=0) {
                    error++;
                }

            }


            if ($(this).data('obligatorio') || $(this).val().length>1) {
                
                if (error>0 || inp.val().trim() === '') {
                    retorno[pos]=$(this);
                }

            }

            pos++;


        });

        return retorno;

    }    

	
    /*Ajax regular form section request*/

    $('.modalscript').on('click','a.click',function(event){

        event.preventDefault();

        var form=$('#principalform');

        $('#principalform> input[name=typeform]').attr('value',$(this).data('typeform'));
        $('#principalform> input[name=field_id]').attr('value',$(this).data('field-id'));

        var inform= form.serializeArray();

        var taction=form.attr('action').replace('#', $(this).data('taction'));

        var promise=$.ajax({

            url:taction,
            cache: false,
            data:inform,
            type:"POST",
            dataType: "json",
            beforeSend: function(){},
            success:    function(data){

            	if (data.result) {
            		$('#modalForm').empty();
            		$('#modalForm').append(data.html);
            		$('.openmodalbtn').click();
            	}

            },
            error:      function(){}

        });

    }).on('click','a.deleted-row',function(event){

        event.preventDefault();

        var form=$('#principalform');

        $('#modalForm').removeClass('modal-block-danger modal-block-warning modal-block-success  modal-block-primary');

        $('#modalForm').addClass('modal-block-warning');

        $('#principalform> input[name=typeform]').attr('value',$(this).data('typeform'));
        $('#principalform> input[name=field_id]').attr('value',$(this).data('field-id'));

        var inform= form.serializeArray();

        var taction=form.attr('action').replace('#', $(this).data('taction'));

        var promise=$.ajax({

            url:taction,
            cache: false,
            data:inform,
            type:"POST",
            dataType: "json",
            beforeSend: function(){},
            success:    function(data){

                if (data.result) {
                    $('#modalForm').empty();
                    $('#modalForm').append(data.html);
                    $('.openmodalbtn').click();
                }

            },
            error:      function(){}

        });

    });


    /*Modal Dismiss*/


    $('#modalForm').on('click','.dismisslastmodal',function(event){
                   
        event.preventDefault();

        var num= (parseInt($('#modalsteps').attr('data-laststep'))-1);

        $('#modalsteps').attr('data-laststep', parseInt($('#modalsteps').attr('data-laststep'))-1 );

        var form=$('#principalform');



        var strcadena=''+$('#lastmodalstep'+num+' form').attr('action')+'';


        if (strcadena.indexOf('crear')> -1) {

            var taction=$('#lastmodalstep'+num+' form input[name=extra_url]').val();
            $('#principalform> input[name=typeform]').attr('value','add');
            $('#principalform> input[name=field_id]').attr('value','0');

        }else{

            var taction=$('#lastmodalstep'+num+' form input[name=extra_url]').val();
            $('#principalform> input[name=typeform]').attr('value','modify');
            $('#principalform> input[name=field_id]').attr('value',$('#lastmodalstep'+num+' form input[name=field_id]').val());

        }



        var inform= form.serializeArray();

        if (num>0) {

            inform.push({name: 'stepform', value: 'true'});
            inform.push({name: 'finlabel', value: $('#lastmodalstep'+num+' button[name=nextstep]').attr('data-finlabel')});

        }

        

        var promise=$.ajax({

            url:taction,
            cache: false,
            data:inform,
            type:"POST",
            dataType: "json",
            beforeSend: function(){},
            success:    function(data){

                if (data.result) {
                    $('#modalForm .mdl-truebody').slideUp('fast','swing',function(){

                        $('#modalForm').empty();
                        $('#modalForm').append('<div class="ocultos">'+data.html+'</div>');

                        var principalsets=$('#principalmodalvalues').serializeArray();

                        $('#principalmodalvalues').empty();

                        jQuery.each(principalsets,function( i, val ){

                            $('#modalForm #'+val.name).val(val.value);

                        });

                        $('#lastmodalstep'+num).remove();
                        $('#modalForm .modalmicroform > .waitingimg').slideUp('fast','swing',function(){
                            $('#modalForm .mdl-truebody').slideDown('fast','swing',function(){
                                $('#modalForm > .ocultos').slideDown('fast','swing');
                            });
                            
                        });

                    });
                }

            },
            error:      function(){}

        });

        

    });

    $('#modalForm').on('click','.mld-dismiss-fin',function(event){
        location.reload();  
    });


    /*Ajax modal form section request*/

    
    $('#modalForm').on('click','button[name=nextstep]',function(event){

        event.preventDefault();

        var altaction=$(this).val();

        var principalsets=$('#modalForm .modalmicroform').serializeArray();

        $('#principalmodalvalues').empty();

        jQuery.each(principalsets,function( i, val ){

            $('#principalmodalvalues').append('<input type="hidden" name="'+val.name+'" value="'+val.value+'">');

        });

        var form=$('#principalform');

        $('#principalform> input[name=typeform]').attr('value','add');
        $('#principalform> input[name=field_id]').attr('value','0');

        var inform= form.serializeArray();

        inform.push({name: 'stepform', value: 'true'})
        inform.push({name: 'finlabel', value: $(this).attr('data-finlabel')})

        var promise=$.ajax({

            url:altaction,
            cache: false,
            data:inform,
            type:"POST",
            dataType: "json",
            beforeSend: function(){
                $('#modalForm .mdl-truebody').slideUp('fast','swing',function(){
                    $('#modalForm .modalmicroform > .waitingimg').slideDown('fast','swing');
                });
            },
            success:    function(data){

                if (data.result) {

                    $('#modalsteps').append(
                        '<div id="lastmodalstep'+$('#modalsteps').attr('data-laststep')+'">'+$('#modalForm').html()+'</div>'

                    );

                    $('#modalsteps').attr('data-laststep',(parseInt($('#modalsteps').attr('data-laststep'))+1));

                    $('#modalForm .modalmicroform > .waitingimg').slideUp('fast','swing',function(){
                        $('#modalForm').empty();
                        $('#modalForm').append('<div class="ocultos">'+data.html+'</div>');
                        $('#modalForm > .ocultos').slideDown('fast','swing');
                        
                    });


                    $('.openmodalbtn').click();
                }

            },
            error:      function(){

                $('#modalForm').removeClass('modal-block-danger modal-block-warning modal-block-success  modal-block-primary');

                $('#modalForm').addClass('modal-block-danger');

                $('#modalForm .result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-times-circle');
                $('#modalForm .msn-alerta-header').text('Ocurrio un error!');
                $('#modalForm .msn-alerta-body').text('La solicitud no se pudo completar, recargue la pagina he intente mas tarde...');

                $('#modalForm .mld-dismiss-fin').attr('class','btn btn-danger regresar');

                $('#modalForm .modalmicroform > .waitingimg').slideUp('fast','swing',function(){
                    $('#modalForm .result-mdl').slideDown('fast','swing');
                });

            }

        });

    });


    $('#modalForm').on('click','button[name=finregistro]',function(event){

        event.preventDefault();

        $('#modalForm').removeClass('modal-block-danger modal-block-warning modal-block-success  modal-block-primary');

        var form=new FormData($('#modalForm .modalmicroform')[0]);

        var validacion=validacionGeneral('#modalForm .modalmicroform');


        if (validacion.length==0) {

            var promise=$.ajax({

                url:$('#modalForm .modalmicroform').attr('action'),
                cache: false,
                data:form,
                type:"POST",
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function(){
                	$('#modalForm .mdl-truebody').slideUp('fast','swing',function(){
                		$('#modalForm .modalmicroform > .waitingimg').slideDown('fast','swing');
                	});
                },
                success:    function(data){

                	if (data.resultado=='success') {

                		$('#modalForm').addClass('modal-block-success');

                		$('#modalForm .result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-check');
                		$('#modalForm .msn-alerta-header').text('Solicitud completa!');
                		$('#modalForm .msn-alerta-body').text(data.mensaje);
                		$('#modalForm .truebtndissmis > button').attr('class','btn btn-success modal-dismiss mld-dismiss-fin');


                	}else{

                		if (data.resultado=='warning'){

                			$('#modalForm').addClass('modal-block-warning');

                			$('#modalForm .result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-warning');
    	            		$('#modalForm .msn-alerta-header').text('Alerta!');
    	            		$('#modalForm .msn-alerta-body').text(data.mensaje);

    	            		$('#modalForm .mld-dismiss-fin').attr('class','btn btn-warning regresar');

                		}else{

                			$('#modalForm').addClass('modal-block-danger');

                			$('#modalForm .result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-times-circle');
    	            		$('#modalForm .msn-alerta-header').text('Ocurrio un error!');
    	            		$('#modalForm .msn-alerta-body').text(data.mensaje);

    	            		$('#modalForm .mld-dismiss-fin').attr('class','btn btn-danger regresar');

                		}
                	}

                	setTimeout(function(){

    	            	$('#modalForm .modalmicroform > .waitingimg').slideUp('fast','swing',function(){
    	            		$('#modalForm .result-mdl').slideDown('fast','swing');
    	            	});

    	            },1200);
                	
                },
                error:      function(){

                	$('#modalForm').addClass('modal-block-danger');

        			$('#modalForm .result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-times-circle');
            		$('#modalForm .msn-alerta-header').text('Ocurrio un error!');
            		$('#modalForm .msn-alerta-body').text('La solicitud no se pudo completar, recargue la pagina he intente mas tarde...');

            		$('#modalForm .mld-dismiss-fin').attr('class','btn btn-danger regresar');

            		$('#modalForm .modalmicroform > .waitingimg').slideUp('fast','swing',function(){
                		$('#modalForm .result-mdl').slideDown('fast','swing');
                	});

                }

            });

        }else{
            $('#modalForm').addClass('modal-block-danger');

            $('#modalForm > section > form > div.result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-times-circle');
            $('.msn-alerta-header').text('Ocurrio un error!');
            $('.msn-alerta-body').text('La solicitud no se pudo completar, recargue la pagina he intente mas tarde...');

            $('#modalForm .mld-dismiss-fin').attr('class','btn btn-danger regresar');

            $('#modalForm .mdl-truebody').slideUp('fast','swing',function(){
                $('#modalForm .result-mdl').slideDown('fast','swing');
            });
        }  

        //Table data update

    });


    //voy x aqui

    $('#modalForm').on('click','button[name=lastcallmodal]',function(event){

        event.preventDefault();

        $('#modalForm').removeClass('modal-block-danger modal-block-warning modal-block-success  modal-block-primary');

        var form=new FormData($('#modalForm .modalmicroform')[0]);

        var validacion=validacionGeneral('#modalForm .modalmicroform');

        if (validacion.length==0) {

            var promise=$.ajax({

                url:$('#modalForm .modalmicroform').attr('action'),
                cache: false,
                data:form,
                type:"POST",
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#modalForm .mdl-truebody').slideUp('fast','swing',function(){
                        $('#modalForm .modalmicroform > .waitingimg').slideDown('fast','swing');
                    });
                },
                success:    function(data){


                    if (data.resultado=='success') {

                        $('#modalForm').addClass('modal-block-success');

                        $('#modalForm .result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-check');
                        $('#modalForm .msn-alerta-header').text('Solicitud completa!');
                        $('#modalForm .msn-alerta-body').text(data.mensaje);
                        $('#modalForm .truebtndissmis > button').attr('class','btn btn-success dismisslastmodal');

                        $('#principalmodalvalues input[name='+data.keystone+']').val(data.obj);

                    }else{

                        if (data.resultado=='warning'){

                            $('#modalForm').addClass('modal-block-warning');

                            $('#modalForm .result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-warning');
                            $('#modalForm .msn-alerta-header').text('Alerta!');
                            $('#modalForm .msn-alerta-body').text(data.mensaje);

                            $('#modalForm .mld-dismiss-fin').attr('class','btn btn-warning regresar');

                        }else{

                            $('#modalForm').addClass('modal-block-danger');

                            $('#modalForm .result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-times-circle');
                            $('#modalForm .msn-alerta-header').text('Ocurrio un error!');
                            $('#modalForm .msn-alerta-body').text(data.mensaje);

                            $('#modalForm .mld-dismiss-fin').attr('class','btn btn-danger regresar');

                        }
                    }

                    setTimeout(function(){

                        $('#modalForm .modalmicroform > .waitingimg').slideUp('fast','swing',function(){
                            $('#modalForm .result-mdl').slideDown('fast','swing');
                        });

                    },1200);
                    
                },
                error:      function(){


                    $('#modalForm').addClass('modal-block-danger');

                    $('#modalForm .result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-times-circle');
                    $('#modalForm .msn-alerta-header').text('Ocurrio un error!');
                    $('#modalForm .msn-alerta-body').text('La solicitud no se pudo completar, recargue la pagina he intente mas tarde...');

                    $('#modalForm .mld-dismiss-fin').attr('class','btn btn-danger regresar');

                    $('#modalForm .modalmicroform > .waitingimg').slideUp('fast','swing',function(){
                        $('#modalForm .result-mdl').slideDown('fast','swing');
                    });

                }

            });

        }else{
            $('#modalForm').addClass('modal-block-danger');

            $('#modalForm > section > form > div.result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-times-circle');
            $('.msn-alerta-header').text('Ocurrio un error!');
            $('.msn-alerta-body').text('La solicitud no se pudo completar, recargue la pagina he intente mas tarde...');

            $('#modalForm .mld-dismiss-fin').attr('class','btn btn-danger regresar');

            $('#modalForm .mdl-truebody').slideUp('fast','swing',function(){
                $('#modalForm .result-mdl').slideDown('fast','swing');
            });
        } 

        //Table data update

    });


    /*Ajax table pagination request*/

    $('.paginator').on('click','a',function(event){

        event.preventDefault();

        var form=$('#principalform');

        var promise=$.ajax({

            url:form.attr('action'),
            cache: false,
            data:form.serializeArray(),
            type:"POST",
            dataType: "json",
            beforeSend: function(){},
            success:    function(){},
            error:      function(){}

        });

    });


    /*Extra Modal Functions*/


    $('#modalForm').on('click','button.regresar',function(event){

    	event.preventDefault();

		$('.result-mdl').slideUp('fast','swing',function(){

			$('#modalForm').removeClass('modal-block-danger modal-block-warning modal-block-success  modal-block-primary');

			$('#modalForm').addClass($('.result-mdl').data('tmodalorigin'));

			$('.mdl-truebody').slideDown('fast','swing');

		});   	

    });

    /*Ajax table search functions*/
    
    $('.advanced-search-proyect').on('click',function(event){

        event.preventDefault();

        if ($(this).attr('data-show')==0) {
            $('.form'+$(this).data('formid')).slideUp('slow','swing');
            $('.hiddenformsearch').slideDown('slow','swing');
            $(this).text('Busqueda simple');
            $(this).attr('data-show','1');
        }else{
            $('.form'+$(this).data('formid')).slideDown('slow','swing');
            $('.hiddenformsearch').slideUp('slow','swing');
            $(this).text('Busqueda avanzada');
            $(this).attr('data-show','0');
        }

    });
    
    $('.start-search-proyect').on('click',function(event){

        event.preventDefault();


        if ($('.advanced-search-proyect').attr('data-show')==0) {

            $('.formsimple').submit();

        }else{

            $('.searchform').submit();

        }

    });

    /*Relation Modals*/



     $('#modalForm').on('click','button[name=relationadd]',function(event){

        event.preventDefault();

        var relationid=$(this).attr('data-relation');

        var valoreal=$('#relacion-'+relationid+' select').val();

        var cont=0;

        $('#relacion-'+relationid+' table tbody tr').each(function(){


            if ($(this).attr('data-trueid')==valoreal) {cont++;}

        });

        if (cont==0 && valoreal.length>0) {


            var htmlsect="<tr id='tablereg"+valoreal+"'  data-trueid='"+valoreal+"'>";
            htmlsect=htmlsect+"<td>"+$('#relacion-'+relationid+' select option[value='+valoreal+']').text()+"</td>";
            htmlsect=htmlsect+'<td class="tableregularbtns"><a href="#" class="btn btn-primary remove-row deleted-row ocultos" data-visible="false" data-trueid="'+valoreal+'"><i class="fa fa-eye"></i></a>';
            htmlsect=htmlsect+'<a href="#" class="btn btn-danger remove-row deleted-row btnborrar" data-field-id="'+valoreal+'"  data-trueid="'+valoreal+'"><i class="fa fa-trash-o"></i></a></td>';
            htmlsect=htmlsect+"</tr>";

            $('#relacion-'+relationid+' table tbody').append(htmlsect);

            $('#relacion-'+relationid+' div.added').append('<input type="hidden" name="addenin'+relationid+'[]" value="'+valoreal+'" id="addin'+valoreal+'-'+relationid+'">');

        }


        
     });



    /*Muestras Functions*/

    $('#modalForm').on('click','button[name=cargaimg]',function(event){

        event.preventDefault();

        $('#modalForm .ocultos input').click();

    });

    $('#modalForm').on('change','.ocultos input',function(event){

        event.preventDefault();

        var f = new Date();

        $('#modalForm .muestra-seccion table.newrecords tbody').empty();

        for (var i = 0; i < $(this)[0].files.length; i++) {

            var aux= $(this)[0].files[i];

            var htmlsect="<tr id='tablereg"+i+"'>";
            htmlsect=htmlsect+"<td>"+aux.name+"</td>";
            htmlsect=htmlsect+"<td>"+aux.type+"</td>";
            htmlsect=htmlsect+"<td>"+(aux.size/1000)+"KB</td>";
            htmlsect=htmlsect+"<td>"+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+"</td>";
            htmlsect=htmlsect+'<td><a href="#" class="btn btn-primary remove-row deleted-row ocultos" data-visible="false" data-field-url="'+aux.mozFullPath+'"><i class="fa fa-eye"></i></a>';
            htmlsect=htmlsect+'<a href="#" class="btn btn-danger remove-row deleted-row" data-field-id="'+i+'"  data-trueid="'+i+'"><i class="fa fa-trash-o"></i></a></td>';
            htmlsect=htmlsect+"</tr>";

            $('#modalForm .muestra-seccion table.newrecords  tbody').append(htmlsect);
        }


    });

    $('#modalForm').on('click','.btnborrar',function(event){

        event.preventDefault();

        var obj=$(this);

        var relationid=$(this).attr('data-relation');

        $('#tablereg'+$(this).attr('data-field-id')).fadeOut(function(){
            $(this).remove();

            $('#modalForm .added #addin'+$(this).attr('data-trueid')+'-'+relationid).remove();

            $('#modalForm .deleted').append('<input type="hidden" name="deletein'+relationid+'[]" value="'+$(this).attr('data-trueid')+'">');

        });

    });


    $('#modalForm').on('click','.muestra-seccion table tbody tr td:nth-child(5) a:nth-child(2)',function(event){

        event.preventDefault();

        var obj=$(this);

        $('#tablereg'+$(this).attr('data-field-id')).fadeOut(function(){
            $(this).remove();

            console.log($(this).attr('data-trueid'));

            if (obj.attr('data-trueid')) {

                $('#modalForm .muestra-seccion .borrados').append('<input type="hidden" name="borrados[]" value="'+$(this).attr('data-trueid')+'">');
            }


            if (obj.attr('data-existfile')) {

                $('#modalForm .muestra-seccion .borrados').append('<input type="hidden" name="borrados_existentes[]" value="'+$(this).attr('data-trueid')+'">');
            }


        });

    });


    $('#modalForm').on('click','.muestra-seccion table tbody tr td:nth-child(5) a:nth-child(1)',function(event){

        event.preventDefault();

        if ($(this).attr('data-visible')=='true') {
            $('.waitingprev > img').attr('src',$(this).attr('data-field-url'));
        }

        $('.mdl-truebody').slideUp('fast','swing',function(){
            $('#modalForm .imgpreview').slideDown('fast','swing');
        });

    });

    $('#modalForm').on('click','.imgpreview button',function(event){

        event.preventDefault();

        $('#modalForm .imgpreview').slideUp('fast','swing',function(){

            $('.mdl-truebody').slideDown('fast','swing');
        });
    });

    $('body').on('click', '.datepkr', function() {

        $(this).datepicker({
            format:'dd-mm-yyyy'
        });
        $(this).datepicker('show');
    });



});
