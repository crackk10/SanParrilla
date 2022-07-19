<!-- /campo nombre y precio -->
<div class="row">
  {{-- campo nombre --}}
  <div class="form-group col-lg-6">
      <label for="nombrePlato" class="col-lg-3 control-label requerido">Nombre</label>
      <input  type="text" id="nombrePlato" name="nombrePlato" class="form-control col-lg-9"  value="{{old('nombrePlato')}}" >
  </div>
  {{-- campo nombre --}}
  {{-- campo precio --}}
  <div class="form-group col-lg-6">
    <label for="precio" class="col-lg-3 control-label requerido">Precio</label>
    <input  type="number" id="precio" name="precio" class="form-control col-lg-9"  value="{{old('precio')}}" >
  </div>
  {{-- campo precio --}}
</div>
<!-- campo nombre y precio -->
<!-- /campo subCategoria y estado -->
<div class="row mt-2">
  {{-- campo subCategoria  --}}
  <div class="form-group col-lg-6">
      <label for="subCategoriaPlato" class="col-lg-3 control-label requerido">Categoria</label>
      <select class="form-control col-lg-9" id="subCategoriaPlato" name="subCategoriaPlato" >
          <option value="" disabled selected>Sub Categoria</option>
      </select>
  </div>
  {{-- campo subCategoria  --}}
  {{-- campo estado --}}
  <div class="form-group col-lg-6">
      <label for="estadoPlato" class="col-lg-3 control-label requerido">Estado</label>
      <select class="form-control col-lg-9" id="estadoPlato" name="estadoPlato" >
          <option value="" disabled selected>Seleccion...</option>
          <option value="1">Activo</option>
          <option value="2">Inactivo</option>
      </select>
  </div>
  {{-- campo estado --}}
</div>
<!-- campo subCategoria y estado -->
<!-- /campo descripcion y cargar foto-->
<div class="row mt-2">
  
  <div class="col-lg-6">
    {{-- campo descripcion --}} 
    <div class="form-group">
      <label for="descripcion" class="col-lg-3 control-label ">Descripcion</label>
      <textarea name="descripcion" id="descripcion" class="form-control col-lg-9" cols="12" rows="5"  value="{{old('descripcion')}}"></textarea>
    </div>
    {{-- campo descripcion --}}
    {{-- campo foto --}}
    <div class="form-group mt-2">
      <label for="fotoPlato" class="col-lg-3 control-label ">Foto</label>
      <div class="custom-file col-lg-9">
        <input  type="file" id="fotoPlato" name="fotoPlato" class="custom-file-input"  value="{{old('fotoPlato')}}" accept="image/*">
        <label class="custom-file-label" for="fotoPlato" id="labelBorrable"></label>
      </div>
    </div>
    {{-- campo foto --}}        
  </div>
  {{-- campo mostrar foto --}}
  <div class="form-group col-lg-6">
    <div class="col-lg-3"></div>
    <img src="{{asset("assets/$theme/dist/img/boxed.jpg")}}" alt="foto de plato" width="200" height="170" class="rounded border-bottom-0 border border-info" id="blah">
  </div>
  {{-- campo mostrar foto --}}
</div>
<!-- /campo descripcion y cargar foto-->







<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

