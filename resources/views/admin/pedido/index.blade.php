@extends("theme.$theme.layout")
@section('titulo')
Inicio
@endsection
@section('metadata')
<meta name="csrf-token" content="{{csrf_token()}}"/> 
<script src="{{asset("assets/scripts/admin/pedido/pedidoBuscarPlatos.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/pedido/rellenarSelectTipoPago.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/pedido/rellenarSelectTipoPedido.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/carrito/addCarrito.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/carrito/eliminarPlatoCarrito.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/carrito/eliminarAdicionalCarrito.js")}}"></script> 
<script src="{{asset("assets/scripts/admin/carrito/vaciarCarrito.js")}}"></script>
<script src="{{asset("assets/scripts/admin/pedido/guardarFormulario.js")}}"></script>  
<script src="{{asset("assets/scripts/buscar.js")}}"></script> 
@endsection
@section('contenido')
  <div class="row">
    <div class="col-lg-1">
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-10">
      <div class="card card-info card-outline mt-1">
        <div class="card-header h-25">
            @include('admin/pedido/includes/buscar/pedidoFormularioBusquedaPlatos')
        </div>
        <div class="card-body">
          {{-- formulario de guardado --}}
          <form id="formulario" autocomplete="off" enctype="multipart/form-data" class="form-inline">
            @include('admin/pedido/includes/modalFormulario')  
          </form>
          {{-- boton para abrir el formulario --}}
          <button type="button" id="opcionCrear" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
            Nuevo pedido
            <i class="fa fa-cart-plus">
              <span class="badge badge-danger navbar-badge" id="cantidadPlatos">
                0
              </span>
            </i>           
          </button>
        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
  @include('admin/pedido/includes/platos/modalPlatos')
  @include('admin/pedido/includes/clientes/modalClientes')
<script>
  var token = $("#token").val();
  const urlFormulario = "{{route('pedido.guardar')}}";
  const urlBuscarPlatos = "{{route('pedido.buscarPlatos')}}";
  const urlListar = "{{route('pedido.cliente')}}";
  const urlAddCarrito = "{{route('carrito.addPlatoCarrito')}}";
  const urlEliminarCarrito = "{{route('carrito.eliminarPlatoCarrito')}}";
  const urlVaciarCarrito = "{{route('carrito.vaciarCarrito')}}";
  const urlEliminarAdicionalCarrito = "{{route('carrito.eliminarAdicionalCarrito')}}";
  var formulario;
  $(document).ready(function () {
    var urlTipoPago = "{{route('pedido.tipoPago')}}";
    var urlTipoPedido = "{{route('pedido.tipoPedido')}}";
    rellenarSelectTipoPago(urlTipoPago);
    rellenarSelectTipoPedido(urlTipoPedido);
    var data=null;
    addPlatoCarrito(data,urlAddCarrito,token );
  });
  /* buscar platos para el list o el modal*/
  $("#inputBuscarPlatos").keyup(function (evento) {
    $("#opcion").val("lista");
    pedidoBuscarPlatos(urlBuscarPlatos);
  });
  $('#btnBuscarPlatos').on('click', function(){
    $("#opcion").val("modal");
    pedidoBuscarPlatos(urlBuscarPlatos);
    $('#inputBuscarPlatos').val('');
  });
  /* buscar Clientes */
  $("#inputBuscarClientes").keyup(function (evento) {
    var largoFiltro = $("#inputBuscarClientes").val();
    if (largoFiltro.length>=6) {
      buscar(urlListar);
    }
  });
  /* agregar cliente al formulario */
  $(document).on("click",".agregarClienteForm",function(){
    var idBoton = $(this).attr('id');
    var txt=$('#fila'+idBoton+' td:not(:last-child)').text();
    $('#cliente').html('');
    $("#cliente").append("<option seleted value="+idBoton+">"+txt+"</option>");
    $('#inputBuscarClientes').val('');
    $("#cerrarModalCliente").trigger('click');
  });
  /* Eliminar cliente del formulario */
  $(document).on("click","#eliminarClienteForm",function(){
    $('#cliente').html('');
  });
  /* agregar platos al carrito*/
  $(document).on("submit",".formularioCarrito",function(e){
    e.preventDefault();
    $("#cerrarModalPlatos").trigger('click');
    var formulario = $(this);
    /* agrego todos los input que esten cheked(adicionales) al formulario(add carrito) */                          
    $('input[data-adicionales]:checked').each(function() {
      formulario.append($(this));
    });    
    var data = formulario.serialize(); 
    addPlatoCarrito(data,urlAddCarrito,token);
  });
  /* eliminar platos del carrito */
  $(document).on("click",".btnEliminarPlatoCarrito",function(e){
    e.preventDefault();
    /* session_destoy(); */
    var data ={nombre: $(this).attr('id')}
    eliminarPlatoCarrito(data,urlEliminarCarrito,token);  
  });
  /* vaciar el carrito */
  $(document).on("click","#vaciarCarrito",function(e){
    e.preventDefault();
    /* session_destoy(); */
    var data =null;   
    $('#cantidadPlatos').html("0");
    vaciarCarrito(data,urlVaciarCarrito,token);  
  });
  /* eliminar adionales del carrito */
  $(document).on("click",".btnAsignarDomicilio",function(e){
    e.preventDefault();
    /* session_destoy(); */
    var data ={ nombreAdicional : $(this).attr('id'),
                nombrePlato : $(this).attr('name')
              }
    eliminarAdicionalCarrito(data,urlEliminarAdicionalCarrito,token);  
  });
  /* registro del formulario */
  $('#formulario').on('submit', function(e){
    e.preventDefault();
    var formulario = $('#formulario')[0];
    var data = $("#formulario").serialize();
    var tipo = "post";
    EnvioFormulario(data,urlFormulario,token,tipo);                            
  });
</script>
@endsection