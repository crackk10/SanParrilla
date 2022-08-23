@extends("theme.$theme.layout")
@section('titulo')
Adicionales
@endsection
@section('metadata')
<script src="{{asset("assets/$theme/plugins/bs-custom-file-input/bs-custom-file-input.js")}}"></script>
<meta name="csrf-token" content="{{csrf_token()}}"/> 
<script src="{{asset("assets/scripts/admin/adicional/rellenarFormulario.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/adicional/rellenarSelectSubCategoria.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/adicional/guardarAdicional.js")}}"></script> 
<script src="{{asset("assets/scripts/buscar.js")}}"></script> 
<script src="{{asset("assets/scripts/eliminar.js")}}"></script> 
<script src="{{asset("assets/scripts/editar.js")}}"></script> 
@endsection
@section('contenido')
  <div class="row">
    <div class="col-lg-1">
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-10">
      <div class="card card-info card-outline mt-1">
        <div class="card-header h-25">
            @include('admin/adicional/includes/formularioBusqueda')
        </div>
        <div class="card-body">
          {{-- Aqui se imprime la tabla --}}
          <div id="datos"></div>
          {{-- formulario de guardado --}}
          <form id="formulario" autocomplete="off" enctype="multipart/form-data" class="form-inline">
            @include('admin/adicional/includes/modalFormulario')  
          </form>
          {{-- boton para abrir el formulario --}}
          <button type="button" id="opcionCrear" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
            Nuevo Adicional
          </button>
        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
  @include('admin/adicional/includes/modalConfirmDelet')

<script>
  $(document).ready(function () {
    bsCustomFileInput.init();
    var url = "{{route('adicional.subCategoria')}}";
    rellenarSelectSubCategoria(url);
  });
  var token = $("#token").val();
  var urlEliminar;
  var urlEditar;
  var urlFormulario;
  var tipo;
  const urlListar = "{{route('adicional.listar')}}";
  /* Cambiar urlFormulario a guardar*/   
  $(document).on("click","#opcionCrear",function(e){
    urlFormulario="{{route('adicional.guardar')}}";
    tipo="POST"
    document.getElementById("formulario").reset(); 
  });
  /* Rellenar datos para editar y cambio urlformulario a actualizar*/   
  $(document).on("click",".actualizar",function(e){
    e.preventDefault();         
    /* tomo el valores impresos en el link */
    tipo="PUT"
    var id = $(this).attr("id");
    urlEditar=$(this).attr("href");
    urlFormulario=$(this).attr("value");
    Editar(urlEditar,id);                                      
  });
  /* registro del formulario */
  $('#formulario').on('submit', function(e){
    e.preventDefault();
    var formulario = $('#formulario')[0];
    var data;
    if (tipo=="POST") {
      data = new FormData(formulario);
      EnvioFormulario(data,urlFormulario,token,tipo);  
    } else {
      data = new FormData(formulario);
      data.append("_method", "PUT");
      EnvioFormulario(data,urlFormulario,token,tipo);
    }                              
  });
  /* buscar */
  $("#buscar").keyup(function (evento) {
    buscar(urlListar);
  });
  /* filtro */
  $('#filtro').on('change',function(){                                    
    buscar(urlListar);
  });
  /* paginacion */
  $(document).on("click",".pagination li a",function(e){
    e.preventDefault();   
    var url = $(this).attr("href");                                      
    buscar(url);
  });
  /* Eliminar elementos de la lista */   
  $(document).on("click",".eliminar",function(e){
    e.preventDefault();   
    urlEliminar = $(this).attr("href");                                      
  });
  $('#confirmar').on('click', function(){
    eliminar(urlEliminar,token);
  });
</script>
@endsection