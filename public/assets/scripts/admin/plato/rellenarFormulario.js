function Rellenar(data) {
  $('#nombrePlato').val(data.nombrePlato);
  $('#precio').val(data.precio);
  $('#descripcion').val(data.descripcion);
  $('#subCategoriaPlato').val(data.subCategoriaPlato);
  $('#estadoPlato').val(data.estadoPlato);
  $('#blah').attr('src', data.fotoPlato);
  
}