function mostrarMensajeError(mensaje) {
    $('#mensaje_error').text(mensaje);
    $('#modal_error').modal('show');
}

function mostrarMensajeAviso(mensaje) {
    $('#mensaje_aviso').html(mensaje);
    $('#modal_info').modal('show');
}

function main(idiomas) {
    $('.delete-registre').click(function(e) {
        url = $(this).data('url');
        $('#link-borrar').attr('href', url);
    });

    function AppViewModel() {
        var self = this;
        
        self.registrosImagenes = ko.observableArray([
            ]);             

        self.removeImagen = function(imagen) {
            self.registrosImagenes.remove(imagen);
        };

        self.addImagen = function() {
            var imagen = {};
            for (i = 0; i < idiomas.length; i++) {
                imagen['textos[idiomas[i]]'] = '';
                imagen['imagenes[]'] = '';
            }                                
            self.registrosImagenes.push(imagen);                                          
        }           
    }

    ko.applyBindings(new AppViewModel());
}

$(document).ready(function(){
    var fecha = new Date();
    var fecha_hoy = fecha.getDate() + '/' + (fecha.getMonth() + 1) + '/' + fecha.getFullYear();    
    var campo_fecha = $('#fecha').val().trim();
    if(campo_fecha == '') {        
        $('#fecha').val(fecha_hoy);
    }
    
    $.fn.datepicker.dates['es'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        today: "Hoy",
        monthsTitle: "Meses",
        clear: "Borrar",
        weekStart: 1,
        format: "dd/mm/yyyy"
    };
    $('#fecha, #fecha_filtro').datepicker({
        clearBtn: true,
        language: 'es',
    });
    
});