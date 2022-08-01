<form id="formularioBusquedaPlatos" method="get" autocomplete="off" class="form-inline" >
    <div class="input-group" >
        <input type="search" class="form-control form-control-lg" list="listaPlatos" value="" name="buscar" id="inputBuscarPlatos" placeholder="Buscar Plato">
        <div class="input-group-append">
            <button type="button" class="btn btn-lg btn-default" id="btnBuscarPlatos" data-toggle="modal" data-target="#modal-platos">
                <i class="fa fa-cart-plus"></i>
            </button>
            <button type="button" class="btn btn-lg btn-default" id="btnBuscarClientes" data-toggle="modal" data-target="#modal-clientes">
                <i class="fa fa-user-plus"></i>
            </button>
        </div>

    </div>
    <input type="hidden" value="" id="opcion" name="opcion"> 
</form>
{{-- Aqui se imprime la tabla --}}
<datalist id="listaPlatos"> </datalist>
