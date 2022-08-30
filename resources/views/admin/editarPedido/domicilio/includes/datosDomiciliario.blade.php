@php
  $contador=0;
@endphp

  @foreach ($datos as $item)
    @php  
      if ($contador==0){
        echo "<div class='card-group col-lg-12'>";
      }
    @endphp
    <div class="card col-lg-3">
      <img src="{{ asset($item->fotoSeguridad) }}" alt="Foto Mensajero" class="card-img-top" style="height: 110px;">
      <div class="card-body mt-0 mb-0">
        <strong class="text-sm">{{ $item->nombreDomiciliario }}&nbsp{{ $item->apellidoDomiciliario }}</strong>
      </div>
      <div class="card-footer mt-0 mb-0">
        <small class="text-muted">
          <button type="button" class="btn btn-link btn-sm btnIdDomiciliario" id="{{ $item->id }}">
            Asignar Entrega <i class="fas fa-arrow-circle-right"></i>
          </button>
        </small>
      </div>
    </div>
    @php
    if ($contador ==3) {
      echo "</div>";
      $contador=0;
    }else {
      $contador++;
    } 
    @endphp

  @endforeach

