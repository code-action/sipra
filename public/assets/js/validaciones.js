function noNumeros(obj, e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  opc=false;
  if (tecla < 47 || tecla > 58){
    opc=true;
  }
  return opc;
}
function siNumeros(obj, e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  opc=true;
  if (tecla < 47 || tecla > 58){
    opc=false;
  }
  return opc;
}
function aValido(obj, e,valor)
{
  tecla = (document.all) ? e.keyCode : e.which;
  opc=false;
  if (tecla > 47 && tecla < 58 && valor.length<4){
    opc=true;
  }
  return opc;
}

function codC(obj,e,valor){
  tecla = (document.all) ? e.keyCode : e.which;

  if(tecla<=47 || tecla>=58 && valor.length<1){
    return true;
  }
  else if(tecla > 47 && tecla < 58 && valor.length>0 && valor.length<6){
    return true;
  }else {
    return false;
  }
}

function cValido(obj,e,valor){
  tecla = (document.all) ? e.keyCode : e.which;

  if(tecla<=47 || tecla>=58 && valor.length<1){
    return true;
  }
  if(tecla<=47 || tecla>=58 && valor.length<2){
    return true;
  }
  else if(tecla > 47 && tecla < 58 && valor.length>1 && valor.length<7){
    return true;
  }else {
    return false;
  }
}
  var nextinput = 1;
function otroBoton(){
nextinput++;
campo = '<div class="form-group"><label class="col-sm-2 control-label">Carné:</label><div class="col-sm-9"><input class="form-control" onKeyPress="return cValido( this, event,this.value);" placeholder="Número de carné"></input></div></div>';
$("#otroB").append(campo);
}

function cambioBuscar(valor){
  var s = document.querySelector('#titulodos');
  var i = document.querySelector('#titulo');
  if(valor==3){
    s.setAttribute("style", "width:25%; display:inline");
    i.setAttribute("style", "display:none");
    $("#titulo").val("");
  }else{
    i.setAttribute("style", "width:25%; display:inline");
    s.setAttribute("style", "display:none");
    $("#titulo").val("");
  }
}
$(document).on('ready',function(){
$("#mayuscula").keyup(function(){
  cadena=$("#mayuscula").val();
  cadena=cadena.toUpperCase();
  $("#mayuscula").val(cadena);
});
});
