<div class="card-body table-responsive p-0" style="height: 500px;">
  <table class="table table-head-fixed  table-hover">
    <thead>
      <tr class="bg-info">
        <th class="bg-info">Plato</th>
        <th class="bg-info">Precio</th>
        <th class="bg-info">Descripcion</th>
        <th class="bg-info">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($datos as $item)
        @if ($item->estadoPlato=="1")
              
          <tr data-widget="expandable-table" aria-expanded="false">     
            <td >
              <img src="{{ asset($item->fotoPlato) }}" class="img-thumbnail" alt="Imagen Plato">
            </td>
            <td><Strong>${{$item->precio}}</Strong></td>
            <td>
              <strong>{{$item->nombrePlato}}</strong>
              <br>
              {{$item->descripcion}}
            </td>
            <td >
              <form  class="formularioCarrito">  
                <div class="input-group">
                  <input type="number" name="cantidad" id="cantidad" value="1" class="form-control" aria-describedby="btnAgregar">
                  <div class="input-group-append">
                    <input type="submit" value="Agregar" name="btnAgregar" id="btnAgregar" class="btn btn-info ">
                  </div>
                </div>
                <input type="hidden" name="idPlato" id="producto" value="{{$item->id}}">
                <input type="hidden" name="precio" id="precio" value="{{$item->precio}}">
                <input type="hidden" name="nombre" id="nombre" value="{{$item->nombrePlato}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
              </form> 
            </td>
          </tr>
          <tr class="expandable-body d-none">
            <td colspan="4">
              <div class="p-0" colspan="3">
                <table class="table table-hover">
                  <tr>
                    <td > 
                      <strong>Adicionales:</strong> 
                      @if (isset($item->adicionales))
                          @for ($a = 0; $a < count($item->adicionales); $a++)
                            @if ($item->adicionales[$a]->estadoAdicional == 1)
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" data-adicionales name="adicionales[]" type="checkbox" value="{{ $item->adicionales[$a]->id}}" id="{{ $item->adicionales[$a]->id}}">
                                  <label class="form-check-label" for="{{ $item->adicionales[$a]->id}}">
                                    {{ $item->adicionales[$a]->nombreAdicional}}
                                  </label>
                              </div> 
                            @endif
                          @endfor       
                      @endif
                    </td>
                  </tr>
                </table>
              </div>
            </td>
          </tr>
        @endif 
      @endforeach 
    </tbody>
  </table>
</div>