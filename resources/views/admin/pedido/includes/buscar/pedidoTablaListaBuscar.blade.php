<select name="nombresPlatos" id="nombresPlatos">
  @foreach ($datos as $item)
    @if ($item->estadoPlato==1)
      <option value="{{ $item->nombrePlato }}" class="platoAgregado" id="{{ $item->id }}">
        {{$item->nombreCategoriaPlato}}&nbsp - &nbsp 
        {{$item->nombreSubCategoriaPlato}}&nbsp - &nbsp 
        {{$item->precio}}
      </option>  
    @endif
  @endforeach 
</select>

