<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Categoria</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0" style="display: block;">
    <table class="table">
      <thead>
        <tr>
          <th>id</th>
          <th>Nombre</th>
          <th>Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($datos as $item)
          <tr>
            <th scope="row">
              {{$item->id}}
            </th>        
            <td>{{$item->nombreCategoriaPlato	}}</td>
            <td>{{$item->nombreEstado}}</td>
            <td class="text-right py-0 align-middle">
              <div class="btn-group btn-group-sm">
                <a href="{{route('categoria.editar',$item->id)}}" 
                  id="{{ $item->id }} " class="actualizar btn btn-info" value="{{route('categoria.actualizar',$item->id)}}"
                  data-toggle="modal" data-target="#modal-lg">
                      <i class="fas fa-eye"></i>
                </a>
                <a href="{{route('categoria.eliminar',$item->id)}}"  class="eliminar btn btn-danger" 
                    data-toggle="modal" data-target="#exampleModalCenter">
                      <i class="fas fa-trash"></i>
                </a>
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
