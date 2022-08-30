function datosDomiciliario(url) {
  $.ajax({
    type: "get",
    url: url,
    success: function(data) 
    {
      $('#datosDomiciliario').empty().html(data); 
    },
  });
}