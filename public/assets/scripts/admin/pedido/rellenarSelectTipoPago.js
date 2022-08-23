function rellenarSelectTipoPago(url) {
  $.ajax({
    type: "get",
    url: url,
    data: "formdata",
    dataType: "json",
    success: function (data) {
      $('#tipoPago').html('');
      $.each(data, function (indexInArray, valueOfElement) { 
        $("#tipoPago").append("<option value="+valueOfElement.id+">"+valueOfElement.nombreTipoPago+"</option>");   
      });
      $("#tipoPago").prepend("<option value='' selected disabled >Seleccionar</option>");   
    }
  }); 
}
