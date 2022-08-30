function listar(url) {
  $.ajax({
    type: "get",
    url: url,
    success: function(data) 
    {
      $('#datos').empty().html(data); 
    },
  });
}