<div class="card card-info table-sm">
  <div class="card-header">
    <h3 class="card-title">Platos</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0" style="display: block;">
    <table class="table" id="tablaPlatosFormularioRegistro">
      <thead>
        <tr>
          <th>Plato</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
          $total=0;
        ?>
        @if (isset($datos['plato']))
          @foreach ( $datos['plato'] as $nombreplato => $valoresPlato )
            <tr>
              <td>{{ $nombreplato }}</td>
              <?php
              $total += $valoresPlato['cantidad'] * $valoresPlato['precio'];
              ?>
            @foreach ( $valoresPlato as $clave )
              <td>{{ $clave }}</td>
              {{-- {{ $clave." : ". $valor }} --}}
            @endforeach
              <td class="text-right py-0 align-middle">
                <div class="btn-group btn-group-sm">
                  <button class="btn btn-danger btnEliminarPlatoCarrito" id="{{ $nombreplato }}">
                    <i class="fas fa-trash nav-icon"></i>
                  </button>
                </div>
              </td>
            </tr>
          @endforeach
        @endif
        <tr>
          <th colspan="3">
            <Strong>
              TOTAL : <span id="totalCarrito">{{ $total }} </span>
            </Strong>
          </th>
          <th>
            <button id="vaciarCarrito" type="button" class="btn btn-info btn-block btn-sm "><i class="fa fa-trash"></i>&nbsp Vaciar Carrito</button>
          </th>
        </tr>
                 
        </tbody>
         
    </table>
  </div>
  <!-- /.card-body -->
</div>
{{-- paginacion --}}



