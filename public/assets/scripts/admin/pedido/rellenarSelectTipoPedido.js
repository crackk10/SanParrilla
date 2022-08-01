function rellenarSelectTipoPedido(url) {
  $.ajax({
    type: "get",
    url: url,
    data: "formdata",
    dataType: "json",
    success: function (data) {
      $('#tipoPedido').html('');
      $.each(data, function (indexInArray, valueOfElement) { 
        $("#tipoPedido").append("<option value="+valueOfElement.id+">"+valueOfElement.nombreTipoPedido+"</option>"); 
      });   
    }
  }); 
}
