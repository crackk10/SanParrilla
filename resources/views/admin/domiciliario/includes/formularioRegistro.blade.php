<!-- /campo nombre y apellido -->
<div class="row">
  <div class="col-lg-6">
    {{-- campo nombre --}}
    <div class="form-group">
        <label for="nombreDomiciliario" class="col-lg-12 control-label requerido">Nombres</label>
        <div class="col-lg-12">
        <input  type="text" id="nombreDomiciliario" name="nombreDomiciliario" class="form-control"  value="{{old('nombreDomiciliario')}}" >
        </div>
    </div>
    {{-- campo nombre --}}
  </div>
  <div class="col-lg-6">
    {{-- campo apellido --}}
    <div class="form-group">
      <div class="form-group">
        <label for="apellidoDomiciliario" class="col-lg-12 control-label requerido">Apellidos</label>
        <div class="col-lg-12">
          <input  type="text" id="apellidoDomiciliario" name="apellidoDomiciliario" class="form-control"  value="{{old('apellidoDomiciliario')}}" >
        </div>
      </div>
    </div>
    {{-- campo apellido --}}
  </div>
</div>
<!-- campo nombre y apellido -->




<!-- /campo documento y telefono -->
<div class="row">
  <div class="col-lg-6">
    {{-- campo documento --}}
    <div class="form-group">
      <label for="documentoDomiciliario" class="col-lg-12 control-label requerido">Documento</label>
      <div class="col-lg-12">
        <input  type="number" id="documentoDomiciliario" name="documentoDomiciliario" class="form-control"  value="{{old('documentoDomiciliario')}}" >
      </div>
    </div>
    {{-- campo documento --}}
  </div>
  <div class="col-lg-6">
    {{-- campo telefono --}}
    <div class="form-group">
      <div class="form-group">
        <label for="telefonoDomiciliario" class="col-lg-12 control-label ">Telefono</label>
        <input  type="number" id="telefonoDomiciliario" name="telefonoDomiciliario" class="form-control"  value="{{old('telefonoDomiciliario')}}" >
      </div>
    </div>
    {{-- campo telefono --}}
  </div>
</div>
<!-- campo documento y telefono -->


<!-- /campo estado y cargar foto-->
<div class="row">
  <div class="col-lg-6">
    {{-- campo estado --}}
      <div class="form-group ">
          <label for="estadoDomiciliario" class="col-lg-12 control-label requerido">Estado</label>
          <div class="col-lg-12">
              <select class="form-control " id="estadoDomiciliario" name="estadoDomiciliario" >
                  <option value="" disabled selected>Seleccione un Estado</option>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
              </select>
          </div>
      </div>
    {{-- campo estado --}}
  </div>

  <div class="col-lg-6">
    <div class="col-lg-6 float-right">
      <img src="{{asset("assets/$theme/dist/img/boxed.jpg")}}" alt="foto de mensajero" width="100" height="100" class="rounded border-bottom-0" id="blah">
    </div>
    <div class="col-lg-6 float-right">
      {{-- campo foto --}}
      <div class="form-group">
        <label for="fotoSeguridad" class="col-lg-12 control-label ">Foto</label>
        <div class="custom-file">
          <input  type="file" id="fotoSeguridad" name="fotoSeguridad" class="custom-file-input"  value="{{old('fotoSeguridad')}}" accept="image/*">
          <label class="custom-file-label" for="fotoSeguridad" id="labelBorrable"></label>
        </div>
      </div>
      {{-- campo foto --}}
    </div>
  </div>
</div>
<!-- campo estado y cargar foto-->


{{-- tomar foto --}}

<div class="row">
  <div class="col-lg-12 d-flex justify-content-center">
      <!-- Stream video via webcam -->
      <div class="video-wrap">
      <video id="video" class="border border-info " playsinline autoplay></video>
      </div>
      <!-- Trigger canvas web API -->
      <button id="snap" class="btn btn-info block">Capturar</button>

  </div>
  <div style="display: none"">
    <!-- Webcam video snapshot -->
    <canvas id="canvas" width="200" height="170" class="border border-info"></canvas>
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


