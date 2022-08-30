function EnvioFormulario(datos,urlFormulario,token,tipo){ 
  $.ajax({                        
    type: tipo,
    headers: {'X-CSRF-TOKEN':token},                
    url: urlFormulario,                 
    data: datos,
    success: function(data)            
    {   
      console.log("guardo exitosamente");
      toastr.success( 'Creado Exitosamente', 'Exito',{
      "positionClass": "toast-top-right"})
      /* Cerrar modal y reiniciar inputs */
      $("#cerrarModal").trigger('click');                
      //esperar 0,5 segundos para actualizar la tabla
      setTimeout(function(){
        document.getElementById("formulario").reset();
        $("#vaciarCarrito").trigger('click');
        $("#eliminarClienteForm").trigger('click');
      },500);
    },
    error: function (data)
    {  
      console.log("Error al guardar"); 
      $("#list").val('');
      var messages = data.responseJSON.errors;
      $.each(messages, function(index, val) {
          toastr.error( val, 'Problema al Guardar',{
          "positionClass": "toast-top-right",
          "extendedTimeOut": "6000"})   
      });
    }
  });
}