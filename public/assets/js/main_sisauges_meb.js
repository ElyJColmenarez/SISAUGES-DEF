jQuery(document).ready(function() {

	
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


    /*Ajax modal form section request*/

    


    $('#modalForm').on('click','button[name=finregistro]',function(event){

        event.preventDefault();

        var form=new FormData($('#modalmicroform')[0]);

        var promise=$.ajax({

            url:$('#modalmicroform').attr('action'),
            cache: false,
            data:form,
            type:"POST",
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function(){
            	$('#mdl-truebody').slideUp('fast','swing',function(){
            		$('#modalmicroform > .waitingimg').slideDown('fast','swing');
            	});
            },
            success:    function(data){


            	$('#modalForm').removeClass('modal-block-danger modal-block-warning modal-block-success  modal-block-primary');


            	if (data.resultado=='success') {

            		$('#modalForm').addClass('modal-block-success');

            		$('#result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-check');
            		$('.msn-alerta-header').text('Solicitud completa!');
            		$('.msn-alerta-body').text(data.mensaje);
            		$('#mld-dismiss-fin').attr('class','btn btn-success modal-dismiss');

                   $('#modalForm').on('click','#mld-dismiss-fin',function(event){
                        location.reload();  
                     }) 

            	}else{

            		if (data.resultado=='warning'){

            			$('#modalForm').addClass('modal-block-warning');

            			$('#result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-warning');
	            		$('.msn-alerta-header').text('Alerta!');
	            		$('.msn-alerta-body').text(data.mensaje);

	            		$('#mld-dismiss-fin').attr('class','btn btn-warning regresar');

            		}else{

            			$('#modalForm').addClass('modal-block-danger');

            			$('#result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-times-circle');
	            		$('.msn-alerta-header').text('Ocurrio un error!');
	            		$('.msn-alerta-body').text(data.mensaje);

	            		$('#mld-dismiss-fin').attr('class','btn btn-danger regresar');

            		}
            	}

            	setTimeout(function(){

	            	$('#modalmicroform > .waitingimg').slideUp('fast','swing',function(){
	            		$('#result-mdl').slideDown('fast','swing');
	            	});

	            },1200);
            	
            },
            error:      function(){

            	$('#modalForm').addClass('modal-block-danger');

    			$('#result-mdl > div > div > div.modal-icon > i').attr('class','fa fa-times-circle');
        		$('.msn-alerta-header').text('Ocurrio un error!');
        		$('.msn-alerta-body').text('La solicitud no se pudo completar, recargue la pagina he intente mas tarde...');

        		$('#mld-dismiss-fin').attr('class','btn btn-danger regresar');

        		$('#modalmicroform > .waitingimg').slideUp('fast','swing',function(){
            		$('#result-mdl').slideDown('fast','swing');
            	});

            }

        });

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

		$('#result-mdl').slideUp('fast','swing',function(){

			$('#modalForm').removeClass('modal-block-danger modal-block-warning modal-block-success  modal-block-primary');

			$('#modalForm').addClass($('#result-mdl').data('tmodalorigin'));

			$('#mdl-truebody').slideDown('fast','swing');

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


    /*Muestras Functions*/

    $('#modalForm').on('click','button[name=cargaimg]',function(event){

        event.preventDefault();

        $('#modalForm .ocultos input').click();

    });

    $('#modalForm').on('change','.ocultos input',function(event){

        event.preventDefault();

        var f = new Date();

        $('#modalForm .muestra-seccion table tbody').empty();

        for (var i = 0; i < $(this)[0].files.length; i++) {

            var aux= $(this)[0].files[i];

            var htmlsect="<tr id='tablereg"+i+"' data-regid='"+i+"'>";
            htmlsect=htmlsect+"<td>"+aux.name+"</td>";
            htmlsect=htmlsect+"<td>"+aux.type+"</td>";
            htmlsect=htmlsect+"<td>"+(aux.size/1000)+"KB</td>";
            htmlsect=htmlsect+"<td>"+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+"</td>";
            htmlsect=htmlsect+'<td><a href="#" class="btn btn-primary remove-row deleted-row" data-visible="false" data-field-url="'+aux.mozFullPath+'"><i class="fa fa-eye"></i></a>';
            htmlsect=htmlsect+'<a href="#" class="btn btn-danger remove-row deleted-row" data-field-id="'+i+'"><i class="fa fa-trash-o"></i></a></td>';
            htmlsect=htmlsect+"</tr>";

            $('#modalForm .muestra-seccion table tbody').append(htmlsect);
        }


    });


    $('#modalForm').on('click','.muestra-seccion table tbody tr td:nth-child(5) a:nth-child(2)',function(event){

        event.preventDefault();

        $('#tablereg'+$(this).attr('data-field-id')).fadeOut(function(){
            $(this).remove();
            $('#modalForm .ocultos input')[0].files[$(this).attr('data-regid')];
            $('#modalForm .muestra-seccion .borrados').append('<input type="hidden" name="borrados[]" value="'+$(this).attr('data-regid')+'">');
        });

    });

    $('#modalForm').on('click','.muestra-seccion table tbody tr td:nth-child(5) a:nth-child(1)',function(event){

        event.preventDefault();

        if ($(this).attr('data-visible')=='true') {
            $('.waitingprev > img').attr('src',$(this).attr('data-field-url'));
        }

        $('#mdl-truebody').slideUp('fast','swing',function(){
            $('#modalForm .imgpreview').slideDown('fast','swing');
        });

    });

    $('#modalForm').on('click','.imgpreview button',function(event){

        event.preventDefault();

        $('#modalForm .imgpreview').slideUp('fast','swing',function(){

            $('#mdl-truebody').slideDown('fast','swing');
        });
    });

    $('body').on('click', '.datepkr', function() {

        $(this).datepicker({
            format:'dd-mm-yyyy'
        });
        $(this).datepicker('show');
    });



});
