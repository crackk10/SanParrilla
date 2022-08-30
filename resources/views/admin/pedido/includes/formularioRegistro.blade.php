<!-- /campo cliente  -->
<div class="row">
  {{-- campo cliente --}}
  <div class="form-group  col-lg-12">
      <label for="cliente" class="col-lg-2 control-label">Cliente</label>
      <div class="input-group col-lg-10">
        <select  id="cliente" name="cliente" class="form-control"  value="{{old('cliente')}}" aria-describedby="eliminarClienteForm">
        </select>
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="eliminarClienteForm">
            <i class="fas fa-trash nav-icon"></i>
          </button>
        </div>
      </div>
  </div>
  {{-- campo cliente --}}
</div>
<!-- campo cliente  -->
<!-- /campo tipoPago y tipoPedido -->
<div class="row mt-2">
  {{-- campo tipoPago  --}}
  <div class="form-group col-lg-6">
      <label for="tipoPago" class="col-lg-4 control-label">Tipo de Pago</label>
      <select class="form-control col-lg-8" id="tipoPago" name="tipoPago" >
          <option value="" disabled selected>Tipo de pago</option>
      </select>
  </div>
  {{-- campo tipoPago  --}}
  {{-- campo tipoPedido --}}
  <div class="form-group col-lg-6">
      <label for="tipoPedido" class="col-lg-4 control-label">Tipo de Pedido</label>
      <select class="form-control col-lg-8" id="tipoPedido" name="tipoPedido" >
          <option value="" disabled selected>Seleccion...</option>
          <option value="1">Activo</option>
          <option value="2">Inactivo</option>
      </select>
  </div>
  {{-- campo tipoPedido --}}
</div>
<!-- campo tipoPago y tipoPedido -->
<!-- /campo observacion -->
<div class="row mt-2">
    {{-- campo tipoPago  --}}
  <div class="form-group col-lg-6">
      <label for="tipoPago" class="col-lg-4 control-label">Estado</label>
      <select class="form-control col-lg-8" id="estadoPedido" name="estadoPedido" >
          <option value="4" selected>No Pago</option>
          <option value="3">Pago</option>
      </select>
  </div>
  {{-- campo tipoPago  --}}
  <div class="col-lg-6">
    {{-- campo observacion --}} 
    <div class="form-group">
      <label for="observacion" class="col-lg-4 control-label ">Observacion</label>
      <textarea name="observacion" id="observacion" class="form-control col-lg-8" cols="12" rows="2"  value="{{old('observacion')}}"></textarea>
    </div>
    {{-- campo observacion --}}     
  </div>
</div>
<!-- /campo observacion -->
<div class="row mt-2">
  <div class="col-lg-2"></div>
  <div class="col-lg-10" id="carrito"></div>
</div>
<input type="hidden" name="usuario" value="@auth{{ auth()->user()->id}}@endauth" id="usuario">
<input type="hidden" name="total" value="" id="total">
<input type="hidden" name="domiciliario" value="1" id="domiciliario">
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">