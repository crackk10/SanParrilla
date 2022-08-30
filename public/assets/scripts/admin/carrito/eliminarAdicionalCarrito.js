function eliminarAdicionalCarrito(datos,urlFormulario,token, ){ 
  $.ajax({                        
    type: "post",
    headers: {'X-CSRF-TOKEN':token},                
    url: urlFormulario,                 
    data: datos,
    success: function(data)            
    {   
      /* vacio el div con id 'carrito' y le agrego el data lo cual es un html */
      $('#carrito').empty().html(data);
      toastr.warning( 'Eliminado del Carrito', 'Exito',{
      "positionClass": "toast-top-right",
      "showDuration": "100",
      "timeOut": "1000"});     
      /* asigno el valor total del carrito al input total del formulario */
      setTimeout(function(){
        var total=$('#totalCarrito').html();    
        $('#total').val(total);
        /* cuento las filas de la tabla y le asigno el valor al icono del carrito */
        let filas = $(".enCarrito").length;  
        $('#cantidadPlatos').html(filas);
      },700); 
    },
    error: function (data)
    {  
      console.log("Error al agregar al carrito"); 
    }
  });
}