<!-- /campo nombre y apellido -->
<div class="row">
  {{-- campo nombre --}}
  <div class="form-group col-lg-6">
      <label for="nombreDomiciliario" class="col-lg-3 control-label requerido">Nombres</label>
      <input  type="text" id="nombreDomiciliario" name="nombreDomiciliario" class="form-control col-lg-9"  value="{{old('nombreDomiciliario')}}" >
  </div>
  {{-- campo nombre --}}
  {{-- campo apellido --}}
  <div class="form-group col-lg-6">
    <label for="apellidoDomiciliario" class="col-lg-3 control-label requerido">Apellidos</label>
    <input  type="text" id="apellidoDomiciliario" name="apellidoDomiciliario" class="form-control col-lg-9"  value="{{old('apellidoDomiciliario')}}" >
  </div>
  {{-- campo apellido --}}
</div>
<!-- campo nombre y apellido -->
<!-- /campo documento y telefono -->
<div class="row mt-2">
  {{-- campo documento --}}
  <div class="form-group col-lg-6">
    <label for="documentoDomiciliario" class="col-lg-3 control-label requerido">Documento</label>
    <input  type="number" id="documentoDomiciliario" name="documentoDomiciliario" class="form-control col-lg-9"  value="{{old('documentoDomiciliario')}}" >
  </div>
  {{-- campo documento --}}
  {{-- campo telefono --}}
  <div class="form-group col-lg-6">
    <label for="telefonoDomiciliario" class="col-lg-3 control-label ">Telefono</label>
    <input  type="number" id="telefonoDomiciliario" name="telefonoDomiciliario" class="form-control col-lg-9"  value="{{old('telefonoDomiciliario')}}" >
  </div>
  {{-- campo telefono --}}
</div>
<!-- campo documento y telefono -->
<!-- /campo estado y cargar foto-->
<div class="row mt-2">
  {{-- campo estado --}}
  <div class="form-group col-lg-6">
      <label for="estadoDomiciliario" class="col-lg-3 control-label requerido">Estado</label>
      <select class="form-control col-lg-9" id="estadoDomiciliario" name="estadoDomiciliario" >
          <option value="" disabled selected>Seleccione un Estado</option>
          <option value="1">Activo</option>
          <option value="2">Inactivo</option>
      </select>
  </div>
  {{-- campo estado --}}
  {{-- campo foto --}}
  <div class="form-group col-lg-6">
    <label for="fotoSeguridad" class="col-lg-3 control-label ">Foto</label>
    <div class="custom-file col-lg-9">
      <input  type="file" id="fotoSeguridad" name="fotoSeguridad" class="custom-file-input"  value="{{old('fotoSeguridad')}}" accept="image/*">
      <label class="custom-file-label" for="fotoSeguridad" id="labelBorrable"></label>
    </div>
  </div>
  {{-- campo foto --}}

</div>
<!-- campo estado y cargar foto-->


{{-- tomar foto --}}
<div class="d-flex justify-content-center bd-highlight mb-2 mt-3">
  <div class="p-2 bd-highlight">
    <!-- Stream video via webcam -->
    <div class="video-wrap" style="vertical-align: inherit;">
      <video id="video" class="rounded border-bottom-0 border border-info " playsinline autoplay></video>
    </div>
    <!-- Trigger canvas web API -->
    <button id="snap" class="btn btn-info block" type="button">Capturar</button>
  </div>
  <div class="p-2 bd-highlight">
    <div style="vertical-align: inherit;">
      <!-- Webcam video snapshot -->
      <img src="{{asset("assets/$theme/dist/img/boxed.jpg")}}" alt="foto de mensajero" width="200" height="170" class="rounded border-bottom-0 border border-info" id="blah">
      <canvas id="canvas" width="200" height="170" class="border border-info" style="display: none"></canvas>
    </div>
  </div>
</div>
{{-- tomar foto --}}



<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

<script>
  'use strict';

  const video = document.getElementById('video');
  const canvas = document.getElementById('canvas');
  const snap = document.getElementById("snap");
  const errorMsgElement = document.querySelector('span#errorMsg');

  const constraints = {
    audio: false,
    video: {
      width: 200, height: 170
    }
  };

  // Access webcam
  async function init() {
    try {
      const stream = await navigator.mediaDevices.getUserMedia(constraints);
      handleSuccess(stream);
    } catch (e) {
      errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
    }
  }

  // Success
  function handleSuccess(stream) {
    window.stream = stream;
    video.srcObject = stream;
  }

  // Load init
  init();

  // Draw image
  var context = canvas.getContext('2d');
  snap.addEventListener("click", function() {
    
    context.drawImage(video, 0, 0, 200, 170);
    /* Convertir la imagen a Base64 */
    var  dataUrl = canvas.toDataURL();
          let enlace = document.createElement('a');
          // El título
          enlace.download = "ImagenMensajero.png";
          // Convertir la imagen a Base64 y ponerlo en el enlace
          enlace.href = dataUrl; 
          // Hacer click en él
          enlace.click();
    
  });  
</script>


