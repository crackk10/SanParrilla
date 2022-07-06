<!-- /campo nombre y apellido -->
<div class="row">
    {{-- campo nombre --}}
    <div class="form-group col-lg-6">
        <label for="nombreCliente" class="col-lg-3 control-label requerido">Nombres</label>
        <input  type="text" id="nombreCliente" name="nombreCliente" class="form-control col-lg-9"  value="{{old('nombreCliente')}}" placeholder="Obligatorio">
    </div>
    {{-- campo nombre --}}
    {{-- campo apellido --}}
    <div class="form-group col-lg-6">
        <label for="apellidoCliente" class="col-lg-3 control-label requerido">Apellidos</label>
        <input  type="text" id="apellidoCliente" name="apellidoCliente" class="form-control col-lg-9"  value="{{old('apellidoCliente')}}" >
    </div>
    {{-- campo apellido --}}
</div>
<!-- campo nombre y apellido -->
<!-- /campo documento y telefonoCliente -->
<div class="row mt-2">
    {{-- campo documento --}}
    <div class="form-group col-lg-6">
      <label for="documento" class="col-lg-3 control-label requerido">Documento</label>
        <input  type="number" id="documento" name="documento" class="form-control col-lg-9"  value="{{old('documento')}}" >
    </div>
    {{-- campo documento --}}
    {{-- campo telefonoCliente --}}
    <div class="form-group col-lg-6">
        <label for="telefonoCliente" class="col-lg-3 control-label ">Telefono</label>
        <input  type="number" id="telefonoCliente" name="telefonoCliente" class="form-control col-lg-9"  value="{{old('telefonoCliente')}}" placeholder="Obligatorio">
    </div>
    {{-- campo telefonoCliente --}}
</div>
<!-- campo documento y telefonoCliente -->
<!-- /campo ddireccion y barrio -->
<div class="row mt-2">
    {{-- campo direccion --}}
    <div class="form-group col-lg-6">
      <label for="direccion" class="col-lg-3 control-label ">Direccion</label>
        <input  type="text" id="direccion" name="direccion" class="form-control col-lg-9"  value="{{old('direccion')}}" >
    </div>
    {{-- campo direccion --}}
    {{-- campo barrio --}}
    <div class="form-group col-lg-6">
      <label for="barrio" class="col-lg-3 control-label ">Barrio</label>
      <input autocomplete="on" type="text" id="barrio" name="barrio" class="form-control col-lg-9"  value="{{old('barrio')}}" >
    </div>
    {{-- campo barrio --}}
</div>
<!-- campo direccion y barrio -->

<!-- campo observaciones -->
    <div class="row mt-2">
        <div class="form-group col-lg-12">
            <label for="indicacion" class="col-lg-2 control-label ">Indicacion</label>
            <textarea name="indicacion" id="indicacion" class="form-control col-lg-10" cols="12" rows="2"  value="{{old('indicacion')}}"></textarea>
        </div> 
    </div> 
<!-- /campo observaciones -->
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">