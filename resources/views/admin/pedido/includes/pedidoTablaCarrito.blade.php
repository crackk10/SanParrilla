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
          <th></th>
          <th>#</th>
          <th>Plato</th>
          <th>Precio</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $total=0;
          $idRow=0;
          $cantidadPlatosCarrito=0;
        ?>
        @if (isset($datos['plato'])){{-- si esta definido en la session --}}
          @foreach ( $datos['plato'] as $nombreplato => $valoresPlato )
            <tr data-widget="expandable-table" aria-expanded="true" class="enCarrito">
              <td class="text-left py-0 align-middle">
                <div class="btn-group btn-group-sm">
                  <button class="btn btn-danger btnEliminarPlatoCarrito" id="{{ $nombreplato }}">
                    <i class="fas fa-trash nav-icon"></i>
                  </button>
                </div>
              </td>
              <?php
              if (isset($valoresPlato['precio'])) {
                $total += $valoresPlato['cantidad'] * $valoresPlato['precio'];
                $cantidadPlatosCarrito += $valoresPlato['cantidad'];
              }
              
              ?>
            @foreach ( $valoresPlato as $clave => $valor)           
              @if ($clave == "adicionales") {{-- si tiene adicionales entro a los bucles para adicionales --}}
                <tr class="expandable-body">
                  <td colspan="4">
                    <div class="p-0" style="">
                      <table class="table table-hover">
                        <tbody>
                          <tr>
                            <td></td>
                            <td></td>
                            <td>
                              @php  
                                foreach ($valor as $arrayAdicional => $adicional ){                    
                                  echo '<div class="d-flex flex-row bd-highlight">';
                                  foreach ($adicional as $claveAdicional => $valorAdicional){ 
                                    if ($claveAdicional=="nombreAdicional") {
                                    echo  '<div class="p-0 mt-0 mb-0 bd-highlight"><button class="btn btn-link btn-sm btnEliminarAdicionalCarrito" name="'.$nombreplato.'" id="'.$valorAdicional.'">x</button></div><div class="p-0 mt-0 mb-0 bd-highlight w-50 font-italic text-muted">'.$valorAdicional.'</div>';
                                      
                                    }
                                    if ($claveAdicional=="precioAdicional") {
                                      $total += $valorAdicional;
                                      echo'<div class="p-0 mt-0 mb-0 bd-highlight font-italic text-muted">'.$valorAdicional.'</div>';
                                    }
                                  }
                                  echo '</div>';        
                                }
                              @endphp
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </td>  
                </tr>
              @else
                @if ($clave=="nombre") {{-- si es el campo nombre agrego dos div para los adicionales --}}
                <td>
                    <div class="text-monospace">{{ $valor }}</div>
                </td>
                @else{{-- sino, simplemente imprimo los valores --}}
                  <td class="text-monospace">{{ $valor }}</td>
                @endif
              @endif
            @endforeach

            </tr>
          @endforeach
        @endif
        <tr>
          <th colspan="3">
            <Strong>
              # Platos : <span id="cantidadPlatosCarrito">{{ $cantidadPlatosCarrito }} </span> 
            </Strong>
          </th>

          <th>
             TOTAL : $<span id="totalCarrito">{{ $total }} </span>
            <button id="vaciarCarrito" type="button" class="btn btn-info btn-block btn-sm "><i class="fa fa-trash"></i>&nbsp Vaciar Carrito</button>
          </th>
        </tr>
                 
        </tbody>
         
    </table>
  </div>
  <!-- /.card-body -->
</div>
{{-- paginacion --}}


