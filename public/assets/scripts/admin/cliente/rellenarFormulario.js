function Rellenar(data) {
  $('#nombreCliente').val(data.nombreCliente);
  $('#apellidoCliente').val(data.apellidoCliente);
  $('#telefonoCliente').val(data.telefonoCliente);
  $('#direccion').val(data.direccion);
  $('#barrio').val(data.barrio);
  $('#documento').val(data.documento);
}