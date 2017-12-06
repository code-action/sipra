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
  var carne_agregados=[];
  $("#mayuscula").keyup(function(){
    cadena=$("#mayuscula").val();
    cadena=cadena.toUpperCase();
    $("#mayuscula").val(cadena);
  });
  $('#carrera').on('change',function(e){
    $("#horas").removeAttr("readonly");
    var obtener=$("#carrera").find('option:selected');
    idcarrera=obtener.val();
    if(idcarrera!=0){
      ruta="/sipra/public/obtenerhoras/"+idcarrera;
      $.get(ruta,function(res){
        $('#horas').val(res);
        $('#limite').val(res);
    });
  }else{
    $('#horas').val("");
    $("#horas").attr("readonly","readonly");
  }
  });
  $('#agregar').click(function(){
    var carne= $('#t_carne').val();
    if(validar()==true && !carne_agregados.includes(carne)){
    var nombre= $('#t_nombre').val();
    var apellido= $('#t_apellido').val();
    var id=$('#auxiliar').val();
    var tabla= $('#tablaEstudiantes');
    agregar="<tr><td>"+carne+"</td>"+
            "<td>"+nombre+"</td>"+
            "<td>"+apellido+"</td>"+
            "<td>"+"<input type='hidden' name='id[]' value='"+id+"'/>"+
            "<input type='hidden' name='carne[]' value='"+carne+"'/>"+
            "<input type='hidden' name='nombre[]' value='"+nombre+"'/>"+
            "<input type='hidden' name='apellido[]' value='"+apellido+"'/>"+
            "<button type='button' name='button' class='btn btn-xs btn-danger' id='eliminar_estudiante'>"+
            "<i class='fa fa-trash-o'></i>"+
            "</button>"+
            "</td></tr>";
    carne_agregados.push(carne);
    tabla.append(agregar);
    limpiar();
  }else if(carne_agregados.includes(carne)){
    var unique_id = $.gritter.add({
      // (string | mandatory) the heading of the notification
      title: 'Carné ya existe!',
      // (string | mandatory) the text inside the notification
      text: 'Estudiante con ese carné ya fue agregado',
      // (string | optional) the image to display on the left
      image: '',
      // (bool | optional) if you want it to fade out on its own or just sit there
      sticky: false,
      // (int | optional) the time you want it to be alive for before fading out
      time: '7000',
      // (string | optional) the class name you want to apply to that specific message
      class_name: 'gritter-light'
  });
  }
  });
    $('#limpiar').click(function(){
      limpiar();
    });
    $("#tablaEstudiantes").on('click','#eliminar_estudiante',function(e){
      e.preventDefault();
      var carne = $(this).parents('tr').find('input:eq(1)').val();
      var indice = carne_agregados.indexOf(carne);
    carne_agregados.splice(indice);
      $(this).parent('td').parent('tr').remove();
    });
    $("#t_carne").keyup(function(){
      carne=$('#t_carne').val();
      carne=carne.toUpperCase();
      $('#t_carne').val(carne);
      var ruta="/sipra/public/buscarEstudiante/"+carne;
      $.get(ruta,function(res){
        if(res!='0' && res!='n' && !carne_agregados.includes(carne)){
          var nombre= $('#t_nombre').val(res.nombre);
          var apellido= $('#t_apellido').val(res.apellido);
          var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Coincidencia encontrada!',
            // (string | mandatory) the text inside the notification
            text: 'Este estudiante ya esta en otro proyecto, si desea agregarlo haga click sobre el botón "Agregar"',
            // (string | optional) the image to display on the left
            image: '',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '7000',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'gritter-light'
        });
        $('#auxiliar').val(res.id);
        }
        if(res=='n'){
          var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Coincidencia encontrada!',
            // (string | mandatory) the text inside the notification
            text: 'Este estudiante ya esta en otro proyecto, ya estan completas las horas',
            // (string | optional) the image to display on the left
            image: '',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '7000',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'gritter-light'
        });
        limpiar();
        }
        if(res=='0'){
          $('#auxiliar').val("");
        }
      });
    });
});
function validar(){
  var carne= $('#t_carne').val();
  var nombre= $('#t_nombre').val();
  var apellido= $('#t_apellido').val();
  if(carne.length!=7 || nombre.length<3 || apellido.length<3){
    return false;
  }else{
    return true;
  }
}
function limpiar(){
  $('#t_carne').val("");
  $('#t_nombre').val("");
  $('#t_apellido').val("");
}
