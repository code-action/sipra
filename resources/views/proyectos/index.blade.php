@php
  use App\Carrera;
  $blanco="";
@endphp
@extends('plantillas.menuc')
@section('contenidoPagina')
<div class="col-xs-12">
  <div class="content-panel">
    {!!Form::open(['route'=>'proyecto.index','method'=>'GET','role'=>'search','autocomplete'=>'off','class'=>'form-inline','id'=>'formulario'])!!}
      <h4><a href={!! asset('/ayudar/1') !!} target="blank_" class="tooltips" data-placement="right" data-original-title="Ayuda"><i class="fa fa-folder-open"></i></a> Proyectos registrados</h4>
            <div id="cambio">
              @if ($busqueda!=3)
                {!!Form::select('busqueda',['1'=>'Título','3'=>'Carrera','2'=>'Año'],$busqueda, ['placeholder' => 'Buscar por...','class'=>'form-control','onChange'=>'cambioBuscar(this.value);'])!!}
                {!! Form::text('titulo',$blanco,['class'=>'form-control','placeholder'=>'...','style'=>'width:25%; display:inline','id'=>'titulo']) !!}
                {!!Form::select('titulodos',Carrera::arrayCarrera(),null, ['placeholder' => 'Seleccione una carrera...','class'=>'form-control','style'=>'width:25%; display:none','id'=>'titulodos'])!!}
              @else
                {!!Form::select('busqueda',['1'=>'Título','3'=>'Carrera','2'=>'Año'],$busqueda, ['placeholder' => 'Buscar por...','class'=>'form-control','onChange'=>'cambioBuscar(this.value);'])!!}
                {!! Form::text('titulo',$blanco,['class'=>'form-control','placeholder'=>'...','style'=>'width:25%; display:none','id'=>'titulo']) !!}
                {!!Form::select('titulodos',Carrera::arrayCarrera(),null, ['placeholder' => 'Seleccione una carrera...','class'=>'form-control','style'=>'width:25%; display:inline','id'=>'titulodos'])!!}
              @endif
    {!! Form::submit('Buscar',['class'=>'btn btn-theme']) !!}
            </div>

    {!! Form::close() !!}
    <br>

    <table class="table table-hover">
      <thead>
        <tr>
          <th><a href="/sipra/public/proyecto/create">Nuevo</a></th>
          <th>Título</th>
          <th>Carrera</th>
          <th>Año</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <?php
        $a=1;
      ?>
      <tbody>
        @if(count($proyectos)>0)
        @foreach ($proyectos as $proy)
          <tr>
            <td>
              @php
                  $conteo=App\Documento::contador($proy->id);
                if ($conteo==0){
                  @endphp
                  <div class="tooltips" data-placement="right" data-original-title="No se encontró ningún documento">
                    <div class='alert-danger'>{{$a}}</div>
                  </div>
                  @php
                }elseif($conteo<4){
                  @endphp
                  <div class="tooltips" data-placement="right" data-original-title="Documentos incompletos">
                  <div class='alert-warning'>{{$a}}</div>
                </div>
                  @php
                }elseif($conteo==4){
                  @endphp
                  <div class="tooltips" data-placement="right" data-original-title="Documentos completos">
                  <div class='alert-success'>{{$a}}</div>
                </div>
                  @php
                }
              @endphp</td>
            <td >{{$proy->titulo}}</td>
            <td style="width:20%;">{{Carrera::find($proy->f_carrera)->nombre}}</td>
            <td>{{$proy->anio}}</td>
            <td style="width:25%;">@include('proyectos.formularios.eliminar')</td>
          </tr>
          <?php
            $a=$a+1;
          ?>
        @endforeach
      @else
        <tr>
              <td colspan="5">
                <center>
                  No hay registros que coincidan con los términos de búsqueda indicados
                </center>
              </td>
            </tr>
      @endif
      </tbody>
    </table>
    <div id="act">
      {!! str_replace ('/?', '?', $proyectos->appends(Request::only(['titulo']))->render ()) !!}
    </div>
  </div>
</div>
@stop
