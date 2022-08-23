<div class="modal fade" id="modal-clientes" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Buscar Clientes</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
            @include('admin/pedido/includes/clientes/pedidoFormularioBusquedaClientes')
        </div>
        <div id="datos" class="mt-2"></div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" id="cerrarModalCliente" data-dismiss="modal">Cerrar</button>
        <a href="{{route('cliente')}}" target="_blank" class="btn btn-info">Registrar Cliente</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>