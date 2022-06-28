function Rellenar(data) {
  $('#nombreDomiciliario').val(data.nombreDomiciliario);
  $('#apellidoDomiciliario').val(data.apellidoDomiciliario);
  $('#telefonoDomiciliario').val(data.telefonoDomiciliario);
  $('#documentoDomiciliario').val(data.documentoDomiciliario);
  $('#estadoDomiciliario').val(data.estadoDomiciliario);
  $('#blah').attr('src', data.fotoSeguridad);
  
}