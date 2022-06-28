<!-- /campo nombre y apellido -->
<div class="row">
  <div class="col-lg-6">
    {{-- campo nombre --}}
    <div class="form-group">
        <label for="nombreCliente" class="col-lg-12 control-label requerido">Nombres</label>
        <div class="col-lg-12">
        <input  type="text" id="nombreCliente" name="nombreCliente" class="form-control"  value="{{old('nombreCliente')}}" >
        </div>
    </div>
    {{-- campo nombre --}}
  </div>
  <div class="col-lg-6">
    {{-- campo apellido --}}
    <div class="form-group">
      <div class="form-group">
        <label for="apellidoCliente" class="col-lg-12 control-label requerido">Apellidos</label>
        <div class="col-lg-12">
          <input  type="text" id="apellidoCliente" name="apellidoCliente" class="form-control"  value="{{old('apellidoCliente')}}" >
        </div>
      </div>
    </div>
    {{-- campo apellido --}}
  </div>
</div>
<!-- campo nombre y apellido -->




<!-- /campo documento y telefonoCliente -->
<div class="row">
  <div class="col-lg-6">
    {{-- campo documento --}}
    <div class="form-group">
      <label for="documento" class="col-lg-12 control-label requerido">Documento</label>
      <div class="col-lg-12">
        <input  type="number" id="documento" name="documento" class="form-control"  value="{{old('documento')}}" >
      </div>
    </div>
    {{-- campo documento --}}
  </div>
  <div class="col-lg-6">
    {{-- campo telefonoCliente --}}
    <div class="form-group">
      <div class="form-group">
        <label for="telefonoCliente" class="col-lg-12 control-label ">Telefono</label>
        <input  type="number" id="telefonoCliente" name="telefonoCliente" class="form-control"  value="{{old('telefonoCliente')}}" >
      </div>
    </div>
    {{-- campo telefonoCliente --}}
  </div>
</div>
<!-- campo documento y telefonoCliente -->



<!-- /campo ddireccion y barrio -->
<div class="row">
  <div class="col-lg-6">
    {{-- campo direccion --}}
    <div class="form-group">
      <label for="direccion" class="col-lg-12 control-label ">Direccion</label>
      <div class="col-lg-12">
        <input  type="text" id="direccion" name="direccion" class="form-control"  value="{{old('direccion')}}" >
      </div>
    </div>
    {{-- campo direccion --}}
  </div>
  <div class="col-lg-6">
    {{-- campo barrio --}}
    <div class="form-group">
      <label for="barrio" class="col-lg-12 control-label ">Barrio</label>
      <div class="col-lg-12">
        <input autocomplete="on" type="text" id="barrio" name="barrio" class="form-control"  value="{{old('barrio')}}" >
      </div>
    </div>
    {{-- campo barrio --}}
  </div>
</div>
<!-- campo direccion y barrio -->

<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

