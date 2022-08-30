function vaciarCarrito(datos,urlFormulario,token){ 
  $.ajax({                        
    type: "post",
    headers: {'X-CSRF-TOKEN':token},                
    url: urlFormulario,                 
    data: datos,
    success: function(data)            
    {   
      $('#carrito').empty().html(data);
      toastr.info( 'Carrito Vacio', 'Exito',{
      "positionClass": "toast-top-right",
      "showDuration": "100",
      "timeOut": "1000"})     
      /* asigno el valor total del carrito al input total del formulario */
      setTimeout(function(){
        var total=$('#totalCarrito').html();    
        $('#total').val(total);
      },700); 
    },
    error: function (data)
    {  
      console.log("Error al agregar al carrito"); 
    }
  });
}