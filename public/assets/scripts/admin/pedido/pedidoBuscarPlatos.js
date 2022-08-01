function pedidoBuscarPlatos(url) {
  $.ajax({
    type: "get",
    url: url,
    data: $("#formularioBusquedaPlatos").serialize(),
    success: function(data) 
    {
      /*  lleno datalist o el modal segun el value del input opcion */
      var opcion = $("#opcion").val();
      if (opcion =="lista") {
        $('#listaPlatos').empty().html(data);  
      } else {
        if (opcion=="modal") {
          $('#datosPlatos').empty().html(data); 
        }
      }
    },
  });
}