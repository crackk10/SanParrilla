<!-- /campo nombre y precioAdicional -->
<div class="row">
  {{-- campo nombre --}}
  <div class="form-group col-lg-6">
      <label for="nombreAdicional" class="col-lg-3 control-label ">Nombre</label>
      <input  type="text" id="nombreAdicional" name="nombreAdicional" class="form-control col-lg-9"  value="{{old('nombreAdicional')}}" >
  </div>
  {{-- campo nombre --}}
  {{-- campo precioAdicional --}}
  <div class="form-group col-lg-6">
    <label for="precioAdicional" class="col-lg-3 control-label ">Precio</label>
    <input  type="number" id="precioAdicional" name="precioAdicional" class="form-control col-lg-9"  value="{{old('precioAdicional')}}" >
  </div>
  {{-- campo precioAdicional --}}
</div>
<!-- campo nombre y precioAdicional -->
<!-- /campo subCategoria y estado -->
<div class="row mt-2">
  {{-- campo subCategoria  --}}
  <div class="form-group col-lg-6" >
    <label for="subCategoriaAdicional" class="col-lg-3 control-label">Categoria:</label>
    <div id="subCategoriaAdicional" class="col-lg-9"></div>
  </div>
  {{-- campo subCategoria  --}}
  {{-- campo estado --}}
  <div class="form-group col-lg-6">
    <label for="estadoAdicional" class="col-lg-3 control-label ">Estado</label>
    <select class="form-control col-lg-9" id="estadoAdicional" name="estadoAdicional" >
        <option value="" disabled selected>Seleccion...</option>
        <option value="1">Activo</option>
        <option value="2">Inactivo</option>
    </select>
  </div>
  {{-- campo estado --}}
</div>
<!-- campo subCategoria y estado -->
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">