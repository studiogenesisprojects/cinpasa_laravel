function mostrarMensajeError(mensaje) {
    $('#mensaje_error').text(mensaje);
    $('#modal_error').modal('show');
}

function mostrarMensajeAviso(mensaje) {
    $('#mensaje_aviso').html(mensaje);
    $('#modal_info').modal('show');
}

function main() {
    $('.delete-registre').click(function(e) {
        url = $(this).data('url');
        $('#link-borrar').attr('href', url);
    });
}

$(document).ready(function(){    
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
    $('#fecha_filtro').datepicker({
        clearBtn: true,
        language: 'es',
    });
    
});