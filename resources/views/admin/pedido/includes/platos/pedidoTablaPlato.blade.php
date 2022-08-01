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
      <tr>
        @foreach ($datos as $item)
          @if ($item->estadoPlato=="1")        
          <tr>     
            <td style="width : 300px; height:200px;"><img src="{{ asset($item->fotoPlato) }}" class="img-thumbnail" alt="Imagen Plato"  width="300" height="300"></td>
            <td><Strong>${{$item->precio}}</Strong></td>
            <td style="width : 100 ">
              <strong>{{$item->nombrePlato}}</strong>
              <br>
              {{$item->descripcion}}</td>
            <td style="width : 200px ">
              <form  class="form-inline formularioCarrito">
                <input type="hidden" name="idPlato" id="producto" value="{{$item->id}}">
                <input type="number" name="cantidad" style="width : 50px " id="cantidad" value="1" class="form-control">
                <input type="hidden" name="precio" id="precio" value="{{$item->precio}}">
                <input type="hidden" name="nombre" id="nombre" value="{{$item->nombrePlato}}">
                <input type="submit" value="Agregar" name="btnAgregar" id="btnAgregar" class="btn btn-info">
                <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
              </form>
            </td>
          </tr>
          @endif  
        @endforeach
      </tr>
      
    </tbody>
  </table>
</div>
