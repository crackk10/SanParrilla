<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Domicilios Sin Enviar</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0" style="display: block;">
    <table class="table table-sm table-hover">
      <thead>
        <tr>
          <th>Hora</th>
          <th>Cliente</th>
          <th>Forma de Pago</th>
          <th>Total</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($datos as $item)         
          <tr>
            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('h:i:s A')}}</td>        
            <td>{{$item->nombreCliente}}&nbsp{{$item->apellidoCliente}}</td>
            <td>{{$item->nombreTipoPago}}</td>
            <td>{{$item->total}}</td>          
            <td class="text-center py-0 align-middle">
              <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-info btnAsignarDomicilio" data-toggle="modal" data-target="#modalDomiciliario" id="{{ $item->id }}" data-toggle="tooltip" data-placement="left" title="Asignar Domiciliario">
                  <i class="fas fa-motorcycle"></i>
                </button>
                <button type="button" class="btn btn-danger btnAsignarDomicilio" data-toggle="modal" data-target="#modalCancelar" id="{{ $item->id }}" data-toggle="tooltip" data-placement="left" title="Cancelar Pedido">
                  <i class="fas fa-ban"></i>
                </button>
              </div>
            </td>
          </tr>
        @endforeach
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
{{-- paginacion --}}
<div class="d-flex justify-content-end text-center">
    {{ $datos->links() }}
</div>
