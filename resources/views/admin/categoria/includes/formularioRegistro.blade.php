<!-- /campo nombre -->
<div class="row">

    {{-- campo nombre --}}
    <div class="form-group col-lg-6">
        <label for="nombreCategoriaPlato" class="col-lg-3 control-label requerido">Nombre</label>
        <input  type="text" id="nombreCategoriaPlato" name="nombreCategoriaPlato" class="form-control col-lg-9"  value="{{old('nombreCategoriaPlato')}}" >
    </div>
    {{-- campo nombre --}}
    {{-- campo estado --}}
    <div class="form-group col-lg-6">
        <label for="estadoCategoria" class="col-lg-3 control-label requerido">Estado</label>
        <select class="form-control col-lg-9" id="estadoCategoria" name="estadoCategoria" >
            <option value="" disabled selected>Seleccione un Estado</option>
            <option value="1">Activo</option>
            <option value="2">Inactivo</option>
        </select>
    </div>
    {{-- campo estado --}}
  </div>

<!-- campo nombre-->
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

