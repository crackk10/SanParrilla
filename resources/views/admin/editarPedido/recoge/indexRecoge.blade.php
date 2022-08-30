@extends("theme.$theme.layout")
@section('titulo')
Recoger
@endsection
@section('metadata')
<meta name="csrf-token" content="{{csrf_token()}}"/> 
<script src="{{asset("assets/scripts/admin/editarPedido/listar.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/editarPedido/actualizarEstado.js")}}"></script> 
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
  @include('admin/editarPedido/modalCancelar')
<script>
  var idRecoge, data, estado;
  const urlListarRecoge = "{{route('recoge.listar')}}";
  const urlActualizarEstado = "{{ route('recoge.actualizarEstado') }}";
  var token = $("#token").val();
  $(document).ready(function () {
    listar(urlListarRecoge);
  });
  /* paginacion */
  $(document).on("click",".pagination li a",function(e){
    e.preventDefault();   
    var url = $(this).attr("href");                                      
    buscar(url);
  });
  /* paginacion */
  /* almacenar id del Recoge en una variable*/
  $(document).on("click",".btnAsignarId",function(e){
   idRecoge = $(this).attr('id'); 
  });

  /* Modificar Estado */
  $(document).on("click",".btnConfirmarPago",function(){
    idRecoge = $(this).attr('id');
    data ={ idPedido : idRecoge, estadoPedido : 3};
    estado = "pagado"
    actualizarEstado(data,urlActualizarEstado,token,estado);
    //esperar 0,5 segundos para actualizar la tabla
    setTimeout(function(){
      listar(urlListarRecoge);
    },500);
  });
/*   Cancelar pedido */
  $(document).on("click","#confirmar",function(){
    data ={ idPedido : idRecoge, estadoPedido : 5}
    estado = "cancelado"
    actualizarEstado(data,urlActualizarEstado,token,estado);
    //esperar 0,5 segundos para actualizar la tabla
    setTimeout(function(){
      listar(urlListarRecoge);
    },500);
  });
</script>
@endsection