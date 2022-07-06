<!-- /campo nombre -->
<div class="row">

    {{-- campo nombre, categorias y estado --}}
    <div class="form-group col-lg-4">
        <label for="nombreCategoriaPlato" class="col-lg-4 control-label requerido">Nombre</label>
        <input  type="text" id="nombreSubCategoriaPlato" name="nombreSubCategoriaPlato" class="form-control col-lg-8"  value="{{old('nombreCategoriaPlato')}}" >
    </div>
    {{-- campo nombre --}}
    {{-- campo categoria  --}}
    <div class="form-group col-lg-4">
        <label for="categoria" class="col-lg-4 control-label requerido">Categoria</label>
        <select class="form-control col-lg-8" id="categoria" name="categoria" >
            <option value="" disabled selected>Categoria</option>
        </select>
    </div>
    {{-- campo categoria  --}}
    {{-- campo estado --}}
    <div class="form-group col-lg-4">
        <label for="estadoSubCategoria" class="col-lg-4 control-label requerido">Estado</label>
        <select class="form-control col-lg-8" id="estadoSubCategoria" name="estadoSubCategoria" >
            <option value="" disabled selected>Seleccion...</option>
            <option value="1">Activo</option>
            <option value="2">Inactivo</option>
        </select>
    </div>
    {{-- campo estado --}}

</div>
<!-- campo nombre, categorias y estado-->
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

