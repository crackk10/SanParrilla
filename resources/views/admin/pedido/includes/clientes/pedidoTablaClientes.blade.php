<div class="card-body table-responsive p-0" style="height: 300px;">
  <table class="table table-head-fixed  table-hover">
    <thead>
      <tr class="bg-info">
          <th class="bg-info">&nbsp Nombre</th>
          <th class="bg-info">&nbsp Telefono</th>
          <th class="bg-info">&nbsp Direccion</th>
          <th class="bg-info">&nbsp Barrio</th>
          <th class="bg-info"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        @foreach ($datos as $item)
          <tr id="fila{{$item->id}}"> 
            <td>{{$item->nombreCliente}}&nbsp{{$item->apellidoCliente}}</td>
            <td> | {{$item->telefonoCliente}}</td>
            <td> | {{$item->direccion}}</td>
            <td> | {{$item->barrio}}</td>
            <th class="text-right py-0 align-middle">
              <div class="btn-group btn-group-sm">
                <button class="btn btn-info agregarClienteForm" id="{{$item->id}}">
                  <i class="fas fa-user-check nav-icon"></i>
                </button>
              </div>
            </th>
          </tr> 
        @endforeach
      </tr>
    </tbody>
  </table>
</div>