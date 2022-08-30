function actualizarEstado(datos,url,token,estado){ 
  $.ajax({                        
    type: 'post',
    headers: {'X-CSRF-TOKEN':token},                
    url: url,                 
    data: datos,
    success: function(data)            
    {         
      if (estado=="cancelado") {
        toastr.warning( 'El Pedido Fue Cancelado', 'Exito',{
          "positionClass": "toast-top-right"});
        $("#cerrarModalCancelar").trigger('click'); 
      }else{
        if (estado=="pagado") {
          toastr.success( 'El Pedido Fue Pagado y Actualizado', 'Exito',{
          "positionClass": "toast-top-right"})
        }
      }                
    },
    error: function (data)
    {  
     console.log("Problemas en la consulta MySQL");
    }
  });

}