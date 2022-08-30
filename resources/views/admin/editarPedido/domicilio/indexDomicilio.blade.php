@extends("theme.$theme.layout")
@section('titulo')
Domicilios
@endsection
@section('metadata')
<meta name="csrf-token" content="{{csrf_token()}}"/> 
<script src="{{asset("assets/scripts/admin/editarPedido/listar.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/editarPedido/domicilio/datosDomiciliario.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/editarPedido/domicilio/actualizarMensajero.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/editarPedido/cancelar.js")}}"></script> 
<script src="{{asset("assets/scripts/buscar.js")}}"></script> 
@endsection
@section('contenido')
  <div class="row">
    <div class="col-lg-1">
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-10">
      <div class="card card-info card-outline mt-1">
        <div class="card-body">
          {{-- Aqui se imprime la tabla --}}
          <div id="datos"></div>

        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
  <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
  @include('admin/editarPedido/domicilio/includes/modalDomiciliario')
  @include('admin/editarPedido/modalCancelar')
<script>
  var idDomicilio;
  const urlListarDomicilio = "{{route('domicilio.listar')}}";
  const urlDomiciliario = "{{route('domicilio.datosDomiciliario')}}";
  const urlActualizarDomiciliario = "{{ route('domicilio.actualizarDomiciliario') }}";
  const urlCancelarDomicilio = "{{ route('domicilio.cancelar') }}";
  $(document).ready(function () {
    listar(urlListarDomicilio);
    datosDomiciliario(urlDomiciliario);
  });
  /* paginacion */
  $(document).on("click",".pagination li a",function(e){
    e.preventDefault();   
    var url = $(this).attr("href");                                      
    buscar(url);
  });
  /* paginacion */
  /* almacenar id del domicilio en una variable*/
  $(document).on("click",".btnAsignarDomicilio",function(e){
   idDomicilio = $(this).attr('id'); 
  });
  /* Modificar Domiciliario */
  $(document).on("click",".btnIdDomiciliario",function(e){
    e.preventDefault();
    var data ={ idPedido : idDomicilio, idDomiciliario : $(this).attr('id')}
    var token = $("#token").val();
    ActualizarMensajero(data,urlActualizarDomiciliario,token);
    //esperar 0,5 segundos para actualizar la tabla
    setTimeout(function(){
      listar(urlListarDomicilio);
    },500);
  });
  /*   Cancelar pedido */
  $(document).on("click","#confirmar",function(e){
    e.preventDefault();
    var data ={ idPedido : idDomicilio, estadoPedido : 5}
    var token = $("#token").val();
    cancelar(data,urlCancelarDomicilio,token);
    //esperar 0,5 segundos para actualizar la tabla
    setTimeout(function(){
      listar(urlListarDomicilio);
    },500);
  });
</script>
@endsection