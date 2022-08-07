function Rellenar(data) {
  $('#nombreAdicional').val(data.nombreAdicional);
  $('#precioAdicional').val(data.precioAdicional);
  $('#descripcionAdicional').val(data.descripcionAdicional);
  $('#subCategoriaAdicional').val(data.subCategoriaAdicional);
  $('#estadoAdicional').val(data.estadoAdicional);
  $('#blah').attr('src', data.fotoAdicional);
  
}