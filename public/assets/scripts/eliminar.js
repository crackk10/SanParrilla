 function eliminar(url,token) {
  $.ajax({                        
      type: "DELETE",
      headers: {'X-CSRF-TOKEN':token},                
      url: url, 
      dataType: 'json',                   
      success: function(data)            
      {   
        toastr.success( 'Eliminado', 'Exito',{
        "positionClass": "toast-top-right"});
        $(".close").trigger('click');
        buscar(urlListar);       
      },
      error: function (data)
      {  
        console.log("Error al Eliminar"); 
        toastr.error( 'Problema al Eliminar',"Error", {
        "positionClass": "toast-top-right",
        "extendedTimeOut": "6000"}) 
      }
  }); 
 }