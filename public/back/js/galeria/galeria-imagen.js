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