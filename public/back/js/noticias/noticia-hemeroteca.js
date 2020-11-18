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
        fila_id = $(this).parents('tr').attr('id');
        $('#link-borrar').data('fila', fila_id).attr('href', url);
    });

    // Cuando le damos a eliminar la noticia
    $('#link-borrar').on('click', function(e){
        e.preventDefault();        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        fila_id = $(this).data('fila');
        $.ajax({
            method: "POST",
            url: $(this).attr('href'),
        }).done(function(result){
            $('#eliminar-registro').modal('toggle');
            if(result.retCode == 0) {
                $('#' + fila_id).remove();
                $('#mensaje_aviso').html(result.mensaje);
                $('#modal_info').modal('show');
            } else {
                $('#mensaje_error').text(result.mensaje);
                $('#modal_error').modal('show');
            }            
        });
    });

    // Cuando le damos a cambiar el estado de la noticia de activo a desactivo
    $('.cambiar-estado').on('click', function(e){
        e.preventDefault();
        elemento = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            method: "POST",
            url: $(this).data('url'),
        }).done(function(result){
            if(result.retCode == 0) {
                $('#mensaje_aviso').html(result.mensaje);
                $('#modal_info').modal('show');
                if(result.cambio == 0) {
                    elemento.removeClass('btn-default').addClass('btn-info');
                    elemento.find('i').removeClass('fa-check').addClass('fa-ban');
                } else {
                    elemento.removeClass('btn-info').addClass('btn-default');
                    elemento.find('i').removeClass('fa-ban').addClass('fa-check');
                }
            } else {
                $('#mensaje_error').text(result.mensaje);
                $('#modal_error').modal('show');
            }            
        });
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
    $('#fecha_inicio, #fecha_fin').datepicker({
        clearBtn: true,
        language: 'es',
    });
    
});