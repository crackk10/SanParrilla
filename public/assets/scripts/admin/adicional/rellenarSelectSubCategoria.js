function rellenarSelectSubCategoria(url) {
  $.ajax({
    type: "get",
    url: url,
    data: "formdata",
    dataType: "json",
    success: function (data) {
      $('#subCategoriaAdicional').html('');
      $("#subCategoriaAdicional").append("<option value='' disabled seleted>Categoria - SubCategoria</option>"); 
      /* $("#id_transportadora").append("<option value="0" inactive seleted>Selection...</option>"); */
      $.each(data, function (indexInArray, valueOfElement) { 
        if (valueOfElement.estadoSubCategoria!=2) {
          $("#subCategoriaAdicional").append("<option value="+valueOfElement.id+">"+valueOfElement.nombreCategoriaPlato+" - "+valueOfElement.nombreSubCategoriaPlato+"</option>"); 
        }
      });   
    }
  }); 
}
