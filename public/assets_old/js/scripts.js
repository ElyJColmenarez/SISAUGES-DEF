$(document).ready(function(){


	var fecha=new Date();


	function estylepag(){

		var ancho=$('.estilospaginador ul').width();

		$('.estilospaginador').attr('style','position: relative; width: '+ancho+'px; margin: auto;')

	}


	estylepag();

	$('.buscador-muest').on('click',function(){

		$('.busquedas').submit();

	});

	$('.mi-chosen').on('focus',function(){

		event.preventDefault();
		var llave=$(this).data('location');
		$('#location'+llave).attr('class','buscadores');

	});

	$('.mi-chosen').on('keyup',function(event){

    	event.preventDefault();
    	var llave=$(this).data('location');
    	var aux=$('#location'+llave).html();
    	if ($(this).val().length>=1) {

    		var form=$('.busquedas');
			var urls=form.attr('action');

			urls=urls.split('/');

    		urls=urls[0]+'/'+urls[1]+'/'+urls[2]+'/muestras/buscar';


			var moneda=$('#mimoneda input').val();


    		$('#location'+llave).attr('class','buscadores');

        	$.ajax({
	            url:urls,
	            cache: false,
	            data:{'valor':$(this).val(),'_token':moneda,'bus':llave},
	            type:"POST",
	            dataType: "json",
	            success: function(data) {
	            	$('#location'+llave).empty();
		            $('#location'+llave).append(data.resultado);

	            }
	            
	        });

    	}else{

    		$('#location'+llave).attr('class','oculto1');
    		$('#location'+llave).empty();
    		$('#location'+llave).html(aux);
    	}


    });



    $('.mi-chosen-dos').on('keyup',function(event){

    	event.preventDefault();
    	var llave=$(this).data('location');
    	var str1=$(this).val().toUpperCase();
    	if ($(this).val().length>=1) {

    		$('#location'+llave).attr('class','buscadores');

    		$('.referencias').each(function(){

    			var str2=$(this).data('valortx').toUpperCase();

    			if (str2.search(str1)==-1) {
    				$(this).attr('style',"display:none;");
    			}else{
    				$(this).attr('style',"display:block;");
    			}

    		});

    	}else{
    		$('#location'+llave).attr('class','oculto1');
    	}


    });


    function busca_relaciones_actividad(){

    	var form=$('.muestraform');
		var urls=form.attr('action');
		var buscador=$('.res2').val();

		urls=urls.split('/');

    	urls=urls[0]+'/'+urls[1]+'/'+urls[2]+'/muestras/ajaxrelacionesact';

		var moneda=$('#mimoneda input').val();

    	$.ajax({
            url:urls,
            cache: false,
            data:{'_token':moneda,'bus':buscador},
            type:"POST",
            dataType: "json",
            success: function(data) {
            	$('.estatusact p').text(data.act);
            	$('.sectact p').text(data.sect);
            	$('.repreci').text(data.cirepre);
            	$('.reprenom').text(data.nomrepre);
            }
            
        });
    }


    $('.oculto1').on('click','li',function(event){
		event.preventDefault();

		

		var llave=$(this).data('ids');
		var nameact=$('#lock'+llave).attr('name');

			$('#lock'+llave).val($(this).data('valortx'));
			$('#t_lock'+llave).val($(this).data('value'));
			$('#lock'+llave).attr('data-valores',$(this).data('value'));
			$('#location'+llave).attr('class','oculto1');

			if (nameact.search('tipo_actividad')>-1) {

				$('#lock'+llave).attr('data-valr',($(this).data('ids2')));
				$('#finact').attr('value',$('#lock'+llave).data('valr'));

				
			};


	})


	$('.res2').on('change',function(){
		busca_relaciones_actividad();
	});


	if ($('.res2').length>0) {

		busca_relaciones_actividad();
	};



	function validarEmail( email ) {
	    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	    if ( !expr.test(email) ){
	    	return 1;
	    }else{
	    	return 0;
	    }
	        
	}

	$('.solomails').on('change',function(){

		var retorno=validarEmail($(this).val());

		if (retorno==1) {
			$(this).attr('style','border-color:red;');
			$(this).val('');
		}else{
			$(this).attr('style','');
		}

	});

	$('.solo-numero').keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9]/g, '');
	});


	$('.solomaximo').keyup(function (){
	    var max=$(this).data('max');

		if ($(this).val().length>max) {
			$(this).val($(this).val().substr(0,max));
		};
	});


	$('.validadorformularios input').on('keyup',function(){

		var tama=$(this).val().length;

		var lastch=$(this).val().substr(tama-2,tama);


		if (lastch=='  ') {
			$(this).val($(this).val().substr(0,tama-1));
		};

	});

	$('.alfanumericos').keyup(function (){

		var vsCadena = $(this).val().toString();

        if (vsCadena.match(/[^A-Za-z]/g)) {
        	vsCadena=vsCadena.replace(/[^A-Za-z]/g, '')
        };

        $(this).val(vsCadena);

	});


	function alertaprincipal(){
		var tipo=parseInt($('#alerta').data('estado'));
		var clase=parseInt($('#alerta').data('clase'));
		var str="";

		if (tipo==1) {
			if (clase==0) {
				str='alert alert-success';
				$('#alerta strong').text('Bien hecho');
				$('#alerta span').text('Operacion realizada con Exito');
			};
			if(clase==1){
				str='alert alert-danger';
				$('#alerta strong').text('Error');
				$('#alerta span').text('La operacion a fallado');
			};

			$('#alerta').attr('class',str);
			$('#alerta').fadeIn(function(){
				setTimeout(function(){$('#alerta').fadeOut();},3000);
			});


		};

	};

	alertaprincipal();



	$('#ocultar_escr').on('click',function(event){
		event.preventDefault();

		$('#wrapper').attr('style',"padding:0px!important");
		$('#page-wrapper').attr('style',"padding-left:45px!important");
		$('#eltraslado').fadeOut(function(){
			$('#eltraslado2').fadeIn();
		});

	});

	$('#eltraslado2').on('click',function(event){
		event.preventDefault();

		
		$('#eltraslado2').fadeOut(function(){
			$('#eltraslado').fadeIn();
			$('#wrapper').attr('style',"");
			$('#page-wrapper').attr('style',"");
		});

	});

	
	$('#inicio_mues_bus').datetimepicker({
	  format:'d-m-Y',
	  timepicker:false,
	  maxDate:fecha,
	  scrollInput:false,
	  onChangeDateTime:function(dp,input){
	    $('#fin_mues_bus').datetimepicker('setOptions',{minDate: $('#inicio_mues_bus').datetimepicker('getValue')});
	  }
	});

	$('#fin_mues_bus').datetimepicker({
	  format:'d-m-Y',
	  timepicker:false,
	  maxDate:fecha,
	  scrollInput:false,
	});


	$('#fecha_analisis').datetimepicker({
	  format:'d-m-Y',
	  timepicker:false,
	  maxDate:fecha,
	  scrollInput:false,

	});


	$('#fecha_recepcion').datetimepicker({
	  format:'d-m-Y',
	  timepicker:false,
	  maxDate:fecha,
	  scrollInput:false,
	  onChangeDateTime:function(dp,input){
	  	
	    $('#fecha_analisis').datetimepicker('setOptions',{minDate: $('#fecha_recepcion').datetimepicker('getValue')});
	  }
	});

	$('#imagenescarga').on('click',function(event){
		event.preventDefault();
		$('#filebutton').click();
	});


	function showMyImage(fileInput) {

        var files = fileInput[0].files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("thumbnil");       
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }



    function borrar_img(){

		var form=$('.muestraform');
    	var url=form.attr('action');

    	var info= new FormData();

    	var moneda=$('#mimoneda input').val();

		info.append('_token',moneda);
		info.append('rutamuestra',$('#rutamuestra').attr('value'));

    	url=url.split('/');

    	url=url[0]+'/'+url[1]+'/'+url[2]+'/muestras/ajaxborrarimg';


    	$.ajax({
		    url: url, 
		    type: "POST",             
		    data: info,
		    contentType: false,
		    dataType: "json",       
		    cache: false,             
		    processData:false, 
		    success: function(data) {


		    }
		});

    }



    function borrar_img_iniciado(){
    	var x=document.getElementById("imgconttemp");
    	var y=document.getElementById("rutamuestra");

    	if (x||y) {
    		borrar_img();
    	};
    }


	$('#filebutton').on('change',function(){

		var form=$('.muestraform');
		var data=new FormData(form[0]);
		var errores=0;

		$('#miniaturas img').each(function(){
			$(this).attr('class','select-no');
		});


		var extpermitidas=new Array('jpeg','tiff','png','gif','bmp');

		for (var i = 0; i < extpermitidas.length; i++) {
			for (var j = 0; j < $('#filebutton')[0].files.length; j++) {

				if ($('#filebutton')[0].files[j].type!='image/'+extpermitidas[i]) {
					errores++;
					msn="El archivo cargado, no es valido.";
				};

			};
		};

		var totalerr=extpermitidas.length*$('#filebutton')[0].files.length;

		if (errores<totalerr) {
			errores=0;
		};

		for (var i = 0; i < $('#filebutton')[0].files.length; i++) {
			
			if ($('#filebutton')[0].files[i].size >5000000) {
				errores++;
				msn="El archivo es superior a 5MB";
			}

		};


		console.log(errores);

		if (errores==0)
		{

			if ($('#filebutton')[0].files.length>0 && $('#filebutton')[0].files.length!=$('#contenedordatos').attr('data-compro')) {
				$('#contenedordatos').attr('data-insp', $('#filebutton')[0].files.length-1);
				$('#contenedordatos').attr('data-compro', $('#filebutton')[0].files.length-1);

				$('#contenedordatos').fadeOut(function(){
					$('#contenedorcarga').fadeIn();
				});

			};

			var moneda=$('#mimoneda input').val();

			console.log(moneda);

			var url=form.attr('action');
			var borradores=[];

			url=url.split('/');

    		url=url[0]+'/'+url[1]+'/'+url[2]+'/muestras/ajaxvalidar';

			for (var i = 0; i < $('#filebutton')[0].files.length; i++) {
				
				setTimeout(ajaxdatos(i,moneda,url),200);

			};
		}else{

			$('#alerta').attr('class','alert alert-danger');
			$('#alerta strong').text('Error');
			$('#alerta span').text(msn);
			$('#alerta').fadeIn(function(){
				setTimeout(function(){$('#alerta').fadeOut();},3000);
			});

		}
		
	});

	
	function ajaxdatos(i,moneda,url){


					var info= new FormData();

					info.append('_token',moneda);
					info.append('filebutton',$('#filebutton')[0].files[i]);
					info.append('posi',i);
					info.append('igobli',$('#idobligatorio').data('id'));

					$.ajax({
					    url: url, 
					    type: "POST",             
					    data: info,
					    contentType: false,
					    dataType: "json",       
					    cache: false,             
					    processData:false, 
					    success: function(data) {

					    	$('#thumbnil').attr('src',data.ruta);
					    	$('.imgcargada').fadeIn();
					    	$('#rutamuestra').val($('#rutamuestra').val()+';'+data.rutaori);
					    	$('#rutamuestra2').val($('#rutamuestra2').val()+';'+data.rutatrue);

					    	if ($('#contenedordatos').attr('data-insp')==data.pos) {

					    		$('#miniaturas').append('<div class="col-md-6" id="imgpos'+i+'"><span data-posi="'+i+'" data-oriurl="'+data.rutaori+'">X</span><img data-oriurl="'+data.rutaori+'" src="'+data.ruta+'" class="select-si"></div>');

					    		$('#contenedorcarga').fadeOut(function(){
									$('#contenedordatos').fadeIn();
								});

					    	}else{
					    		$('#miniaturas').append('<div class="col-md-6" id="imgpos'+i+'"><span data-posi="'+i+'" data-oriurl="'+data.rutaori+'">X</span><img data-oriurl="'+data.rutaori+'" src="'+data.ruta+'" class="select-no"></div>');
					    	}


					    }
					});

	}

	$('#miniaturas').on('click','img',function(){

		$('#miniaturas img').each(function(){
			$(this).attr('class','select-no');
		});

		$(this).attr('class','select-si');

		$('#thumbnil').attr('src',$(this).attr('src'));
	});


	$('#miniaturas').on('click','span',function(){

		var info= new FormData();
		var moneda=$('#mimoneda input').val();
		var form=$('.muestraform');
		var url=form.attr('action');
		url=url.split('/');
		url=url[0]+'/'+url[1]+'/'+url[2]+'/muestras/ajaxborrarsingle';

		info.append('_token',moneda);
		info.append('file',$(this).data('oriurl'));



		var count=0;

    	$('#imgpos'+$(this).attr('data-posi')).fadeOut(function(){
    		$('#imgpos'+$(this).attr('data-posi')).remove();
    	});
    	$('#miniaturas img').each(function(){
    		if ($(this).attr('class')=='select-si') {
    			count++;
    		};
    	});

    	if (count==0) {
    		$('#miniaturas img').each(function(){
    			if (count==0) {
    				$('#thumbnil').attr('src',$(this).attr('src'));
    				$('#thumbnil').attr('class','select-si');
    				count++;
    			};
    		});
    	};



		$.ajax({
	    url: url, 
	    type: "POST",             
	    data: info,
	    contentType: false,
	    dataType: "json",       
	    cache: false,             
	    processData:false, 
	    success: function(data) {
	    }
	});
		

	});

	$('#boton-inst').on('click',function(event){

		event.preventDefault();

		var form=$('.busqueda-inst');
		var data=form.serialize();
		var url=form.attr('action');

		$.ajax({
		    url: url, 
		    type: "POST",             
		    data: data,      
		    cache: false,              
		    success: function(data) {

		    	$('.borrables').remove();

		    	$('.table').append(data);

		    }
		});

	})


	function trueform(){

		for (var i = 0; i < 7; i++) {
			$('#env'+i).val($('.res'+i).val());
		};

		$('.trueformsend').submit();
	}


	$('#singlebutton').on('click',function(event){
		event.preventDefault();

		var formulario=$('.validadorformularios form .camporequerido');
		var error=0;

		formulario.each(function(){

			if ($(this).val()=="") {
				error++;
				var etiqueta=$(this).data('etiqueta');

				$('#etiquetarequerida-'+etiqueta).attr('style','color:red!important;');

				if ($(this).attr('type')=='file') {

					$('#imagenescarga').attr('style','border-color:red;');

				};

			}else{

				$(this).attr('style','');

				if ($(this).attr('type')=='file') {

					$('#imagenescarga').attr('style','');
					
				};

			}

		});

		if (error!=0) {
			
			$('#alerta').attr('class','alert alert-danger');
			$('#alerta strong').text('Error');
			$('#alerta span').text('Complete los campos obligatorios');
			$('#alerta').fadeIn(function(){
				setTimeout(function(){$('#alerta').fadeOut();},3000);
			});

		}else{
			
			if ($('.validadorformularios form').attr('data-valid')=='encontrado') {

				trueform();

			}else{
				$('.validadorformularios form').submit();
			}

		}

	});


	$('.formulariosajax form').on('submit',function(event){

		event.preventDefault();

		$('.formulariosajax form button').click();


	});






	$(".my_select_box").chosen({
	    no_results_text: "Oops, nothing found!",
	    width: "100%"
	  });












})