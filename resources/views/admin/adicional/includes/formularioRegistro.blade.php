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
  <div class="form-group col-lg-6">
      <label for="subCategoriaAdicional" class="col-lg-3 control-label ">Categoria</label>
      <select class="form-control col-lg-9" id="subCategoriaAdicional" name="subCategoriaAdicional" >
          <option value="" disabled selected>Sub Categoria</option>
      </select>
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
<!-- /campo descripcionAdicional y cargar foto-->
<div class="row mt-2">
  
  <div class="col-lg-6">
    {{-- campo descripcionAdicional --}} 
    <div class="form-group">
      <label for="descripcionAdicional" class="col-lg-3 control-label ">Descripcion</label>
      <textarea name="descripcionAdicional" id="descripcionAdicional" class="form-control col-lg-9" cols="12" rows="5"  value="{{old('descripcionAdicional')}}"></textarea>
    </div>
    {{-- campo descripcionAdicional --}}
    {{-- campo foto --}}
    <div class="form-group mt-2">
      <label for="fotoAdicional" class="col-lg-3 control-label ">Foto</label>
      <div class="custom-file col-lg-9">
        <input  type="file" id="fotoAdicional" name="fotoAdicional" class="custom-file-input"  value="{{old('fotoAdicional')}}" accept="image/*">
        <label class="custom-file-label" for="fotoAdicional" id="labelBorrable"></label>
      </div>
    </div>
    {{-- campo foto --}}        
  </div>
  {{-- campo mostrar foto --}}
  <div class="form-group col-lg-6">
    <div class="col-lg-3"></div>
    <img src="{{asset("assets/$theme/dist/img/boxed.jpg")}}" alt="foto de Adicional" width="200" height="170" class="rounded border-bottom-0 border border-info" id="blah">
  </div>
  {{-- campo mostrar foto --}}
</div>
<!-- /campo descripcionAdicional y cargar foto-->







<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

