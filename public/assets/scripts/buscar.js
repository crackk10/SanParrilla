function buscar(url) {
  $.ajax({
    type: "get",
    url: url,
    data: $("#formularioBusqueda").serialize(),
    success: function(data) 
    {
        $('#datos').empty().html(data); 
    },
  });
}