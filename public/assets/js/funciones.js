function tiposB(id){
	$('#tipos').empty();
  	$('#tipos').append('<option value="">[Seleccione una opción]</option>');
	$.get('/FINANCIERO/public/tipos/tipos/'+id,function(data){
    $.each(data, function(index, subcatObj){
    $('#tipos').append('<option value="'+subcatObj.id+'">'+subcatObj.nombre+'</option>');

    });
  });

}

function grados(id){
  $('#nMaterias').empty();
  $('#nMaterias').append('<option value="0">[Seleccione materia]</option>');
$.get('/ARNICOMA/public/notas/ver/'+id,function(data){
    $.each(data, function(index, subcatObj){
      $('#nGrados').append('<option value="'+subcatObj.id+'">'+subcatObj.nombreGrado+'</option>');

    });
  });  
}

function cantidadVal( obj, e,valor){
  cadena="%f";
  opc = false;
  tecla = (document.all) ? e.keyCode : e.which;
  var cad=valor+String.fromCharCode(tecla);

  var res = cad.split(".");

  if (cadena == "%d")
    if (tecla > 47 && tecla < 58)
      opc = true;
    if (cadena == "%f"){
      if (tecla > 47 && tecla < 58)
        opc = true;
      if (obj.value.search("[.*]") == -1 && obj.value.length != 0)
        if (tecla == 46)
          opc = true;
      }
      if(res.length>1){
        if(res[1].length>2){
          return false;

        }
      }
      return opc;
    }

    function validarTel(obj, e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  val= tecla;
  tecla = String.fromCharCode(tecla);
  aux=false;
  if(valor==''){
    if(tecla=='2' || tecla=='7' || tecla=='6'){
      aux=true;
    }
  }else if(valor[0]==2 || valor[0]==7 || valor[0]==6){
    if(val > 47 && val < 58){
      if(valor.length<4){
        aux=true;
      }   
    }
  }
  if(valor.length==4 && tecla=='-'){
    aux=true;
  }else{
    if(val > 47 && val < 58){
      if(valor.length>4 && valor.length<9){
        aux=true;
      }
    }
  }
  return aux;
}