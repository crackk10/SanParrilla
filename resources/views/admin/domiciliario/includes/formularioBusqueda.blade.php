<div class="form-group">
    <form id="formularioBusqueda" method="get" autocomplete="off">
        <div class="row">
            <div class="form-group col-lg-5">
                <label for="filtro" class="control-label col-lg-3">Filtro</label>
                <div class="col-lg-9">
                    <select name="filtro" id="filtro" class="form-control">
                        <option value="0">Sin filtro</option>
                        <option value="telefonoCliente">Telefono</option>
                        <option value="nombreCliente">Nombre</option>
                        <option value="direccion">Direccion</option>
                        <option value="documento">Documento</option>
                        {{-- <option value="razon_social">Transportadora</option> --}}
                        
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-5">
                <label for="buscar" class="control-label col-lg-3">Buscar</label>
                <div class="col-lg-9">
                    <input type="text" value="" name="buscar" id="buscar" class="form-control">
                </div>
            </div> 
        </div>       
    </form>
</div>