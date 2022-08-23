function rellenarSelectSubCategoria(url) {
  $.ajax({
    type: "get",
    url: url,
    data: "formdata",
    dataType: "json",
    success: function (data) {
      $('#subCategoriaAdicional').html('');
      $.each(data, function (indexInArray, valueOfElement) { 
        if (valueOfElement.estadoSubCategoria!=2) {
          $("#subCategoriaAdicional").append("<div class='form-check float-left'><input class='form-check-input ' type='checkbox' name='subCategoriaAdicional[]' id="+valueOfElement.id+" value="+valueOfElement.id+"><label class='form-check-label' for="+valueOfElement.id+">"+valueOfElement.nombreCategoriaPlato+" - "+valueOfElement.nombreSubCategoriaPlato+"</label></div>"); 
        }
      });   
    }
  }); 
}



    