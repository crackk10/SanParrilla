
function Editar(url,id) {
    $.ajax({
        type: "get",
        url: url,
        data: id,
        dataType: "json",
        success: function (data) {
            if (data.success=='true') 
          {   
              Rellenar(data.data[0]);
          }            
        }
      }); 
    
}