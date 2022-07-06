function rellenarSelectCategoria(url) {
  $.ajax({
    type: "get",
    url: url,
    data: "formdata",
    dataType: "json",
    success: function (data) {
      $('#categoria').html('');
      $("#categoria").append("<option value='' disabled seleted>Seleccion...</option>"); 
      /* $("#id_transportadora").append("<option value="0" inactive seleted>Selection...</option>"); */
      $.each(data, function (indexInArray, valueOfElement) { 
        if (valueOfElement.estadoCategoria!=2) {
          $("#categoria").append("<option value="+valueOfElement.id+">"+valueOfElement.nombreCategoriaPlato+"</option>"); 
        /* console.log(valueOfElement.id_estado) */
        }
      });   
    }
  }); 
}
