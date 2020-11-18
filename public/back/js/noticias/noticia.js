function mostrarMensajeError(mensaje) {
    $('#mensaje_error').text(mensaje);
    $('#modal_error').modal('show');
}

function mostrarMensajeAviso(mensaje) {
    $('#mensaje_aviso').html(mensaje);
    $('#modal_info').modal('show');
}

// Cuando cambia el radio button entre "Iguales para todos los idiomas" o "Diferente en cada idioma"
function pintarTabsRelacionadas(value, noticia_id) {
    token_envio = $('input[name="_token"]').val();

    if (value == 'no') {
        es_multiidioma = 'no';
    } else {
        es_multiidioma = 'yes';
    }
    // Cuando la noticia no se ha creado aún, da undefined
    if (typeof noticia_id === 'undefined') {
        noticia_id = 0;
    }

    $.ajax({
        method: "POST",
        url: $('#select-tipo-relacionadas').data('url'),
        data: { multiidioma: es_multiidioma, noticia_id: noticia_id, _token: token_envio }
    }).done(function (result) {
        if (result.retCode == 0) {
            $('#noticias-relacionadas').html(result.vista);
        } else {
            $('#mensaje_error').text(result.mensaje);
            $('#modal_error').modal('show');
        }
    });
}

// Para agregar una nueva select a las noticias relacionadas
function addNewSelectRelacionadas(idioma, url, noticia_id) {
    token_envio = $('input[name="_token"]').val();
    if (idioma == '0') {
        total_elementos = $('div.relacionadas').length;
    } else {
        total_elementos = $('div.relacionadas-' + idioma).length;
    }

    // Cuando la noticia no se ha creado aún, da undefined
    if (typeof noticia_id === 'undefined') {
        noticia_id = 0;
    }

    $.ajax({
        method: "POST",
        url: url,
        data: { idioma: idioma, noticia_id: noticia_id, index: total_elementos, _token: token_envio }
    }).done(function (result) {
        // console.log(result);
        if (result.retCode == 0) {
            $('#noticia-relacionada-idiomas' + result.idioma).append(result.vista);
        } else {
            $('#mensaje_error').text(result.mensaje);
            $('#modal_error').modal('show');
        }
    });
}

// Para agregar una nueva select a las noticias relacionadas
function buscarNoticiasRelacionadas(idioma, url, pos, noticia_id) {
    // Cuando la noticia no se ha creado aún, da undefined
    if (typeof noticia_id === 'undefined') {
        noticia_id = 0;
    }

    $.ajax({
        method: "POST",
        url: url,
        data: $('#form-buscador-noticias').serialize() + '&noticia_id=' + noticia_id,
        success: function (data) {
            $('#add-noticias').html(data.html);
        },
        error: function (xhr, status) {
            console.log(xhr, status);
        }
    });
}

// Para agregar una nueva select a las noticias relacionadas
function addNewBloque(idioma, url, tipo) {
    token_envio = $('input[name="_token"]').val();

    // obtener el total de bloques en ese idioma
    total_elementos = $('div.bloque-' + idioma).length;

    ultima_posicion = $('div.bloque-' + idioma).last().data('pos') + 1;
    if (total_elementos <= ultima_posicion) {
        index = ultima_posicion;
    } else {
        index = total_elementos;
    }

    $.ajax({
        method: "POST",
        url: url,
        data: { idioma: idioma, index: index, tipo: tipo, bloque_id: '', _token: token_envio },
        success: function (data) {
            $('#bloques-' + idioma).append(data.html);
            // tipo = 1 es texto, tipo = 5 es mapa
            if (tipo == '1') {
                CKEDITOR.replace('bloques[' + idioma + '][' + index + '][textos][texto]');
            } else if (tipo == '5') {
                initMap(idioma, index, 0, 0);
            }
        },
        error: function (xhr, status) {
            console.log(xhr, status);
        }
    });
}

function main(noticia_id, idiomas) {
    // Activar el datapicker y darle la fecha actual nada más cargar la página a la fecha de publicación
    var fecha = new Date();
    var fecha_hoy = fecha.getDate() + '/' + (fecha.getMonth() + 1) + '/' + fecha.getFullYear();
    var campo_fecha = $('#fecha_publicacion').val().trim();
    if (campo_fecha == '') {
        $('#fecha_publicacion').val(fecha_hoy);
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

    $('#fecha_publicacion, #fecha_inicio_buscador, #fecha_fin_buscador').datepicker({
        clearBtn: true,
        language: 'es',
    });

    // Eliminar la imagen de la noticia actual
    $('#delete_news_image').on('click', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: $(this).data('url'),
        }).done(function (result) {
            if (result.retCode == 0) {
                $('#eliminar_imagen, #imagen_noticia').html("");
                $('#mensaje_aviso').html(result.mensaje);
                $('#modal_info').modal('show');
            } else {
                $('#mensaje_error').text(result.mensaje);
                $('#modal_error').modal('show');
            }
        });
    });

    // Eliminar la imagen de la noticia actual del bloque imágenes
    $('.delete_block_image').on('click', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        img_bloque = $(this).closest('.contenedor-imagen').children('.img-bloque');
        help_block = $(this).closest('.help-block');
        $.ajax({
            method: "POST",
            url: $(this).data('url'),
        }).done(function (result) {
            if (result.retCode == 0) {
                img_bloque.remove();
                help_block.html("");
                $('#mensaje_aviso').html(result.mensaje);
                $('#modal_info').modal('show');
            } else {
                $('#mensaje_error').text(result.mensaje);
                $('#modal_error').modal('show');
            }
        });
    });

    $('input[name="relacionadas_iguales"]').change(function () {
        relacionadas_iguales = $('input[name="relacionadas_iguales"]:checked').val();
        pintarTabsRelacionadas(relacionadas_iguales, noticia_id);
    });

    $('#noticias-relacionadas').on('click', '.noticias-relacionadas-add', function (e) {
        e.preventDefault();
        idioma = $(this).data('lang');
        url = $(this).attr('href');
        addNewSelectRelacionadas(idioma, url, noticia_id);
    });

    $('#noticias-relacionadas').on('click', '.busqueda-relacionada', function (e) {
        e.preventDefault();
        idioma = $(this).data('idioma');
        url = $(this).data('url');
        pos = $(this).data('pos');
        $('#add-noticias').html("");
        $('#buscador-listado-noticias').modal('show');
        $('input[name="posicion"]').val(pos);
        $('input[name="idiomaId"]').val(idioma);
        $('#enviar-buscador').data('url', url);
    });

    $('#enviar-buscador').on('click', function (e) {
        e.preventDefault();
        idioma = $('input[name="idiomaId"]').val();
        url = $(this).data('url');
        pos = $('input[name="posicion"]').val();

        buscarNoticiasRelacionadas(idioma, url, pos, noticia_id);

        $(document).on('click', '#pagination a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.post(url, $('#form-buscador-noticias').serialize(), function (data) {
                $('#add-noticias').html(data.html);
            });
        });

        $(document).on('click', '.add-select', function (e) {
            e.preventDefault();
            option = '<option value="' + $(this).data('id') + '" selected="selected">' + $(this).data('nombre') + '</option>';
            $('#select-relacionda' + pos + '-' + idioma).find('option').removeAttr('selected');
            $('#select-relacionda' + pos + '-' + idioma).append(option);
            $('#buscador-listado-noticias').modal('hide');
        });
    });

    $('.add_bloques').on('click', function (e) {
        e.preventDefault();
        url = $(this).data('url');
        idioma = $(this).data('idioma');
        tipo = $('#anadir-bloque-' + idioma + ' option:selected').val();
        addNewBloque(idioma, url, tipo);
    });

    $(document).on('click', '.eliminar-bloque', function (e) {
        e.preventDefault();
        bloque_eliminar = $(this).closest('.well');
        $('#link-borrar-bloque').on('click', function (evento) {
            evento.preventDefault();
            bloque_eliminar.remove();
            $('#eliminar-bloque').modal('hide');
        });
    });

    // Ordenar los bloques entre ellos, independientes en cada idioma
    for (i = 0; i < idiomas.length; i++) {
        $("#bloques-" + idiomas[i]).sortable({
            opacity: 0.8,
            cursor: "move",
            placeholder: "alert alert-success",
            start: function (event, ui) {
                // El ui.item es el elemento que se está cambiando de posición
                elementoId = $(ui.item).find('.bloque-texto').attr('id');
                // Se comprueba que exista la instancia del CKEDITOR y si existe la quitamos para después poder crearla de nuevo
                // Si no con el sortable pierde el texto
                if (CKEDITOR.instances[elementoId]) {
                    CKEDITOR.instances[elementoId].destroy();
                }
            },
            update: function (event, ui) {
                idioma_id = ui.item.data('lang');
                $(".bloque-" + idioma_id).each(function (new_posicion) {
                    $(this).children('.orden').val(new_posicion)
                });
            },
            stop: function (event, ui) {
                elementoId = $(ui.item).find('.bloque-texto').attr('id');
                // Se comprueba el elemento existe para el elementoa actual. Si no lo encuentra da undefined
                // Si lo encuentra y no es undefined creamos la instancia del CKEDITOR de nuevo.
                if (elementoId) {
                    CKEDITOR.replace(elementoId);
                }
            }
        });

        $("#bloques-" + idiomas[i]).hover(function () {
            $(this).css("cursor", "move");
        },
            function () {
                $(this).css("cursor", "auto");
            });
    }

    // Enviar el formulario cuando le damos a actualizar
    $('#actualizar-new').on('click', function (e) {
        $('input[name="actualizar-noticia"]').val('1');
        $('#form-actualizar').submit();
    });

    // Para que se carguen bien los mapas al cambiar entre los tabs
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // idioma del tab
        idioma_id = $(this).data('lang');
        $('#idioma' + idioma_id + ' .mapa-bloque').each(function (index) {
            mapa_id = $(this).attr('id');
            partes_id = mapa_id.split('-');
            indice_id = partes_id[3];
            latitud = $('#latitud-' + idioma_id + '-' + indice_id).val();
            longitud = $('#longitud-' + idioma_id + '-' + indice_id).val();
            initMap(idioma_id, indice_id, latitud, longitud);
        });
    });
}

function initMap(idioma, indice, latitud, longitud) {

    // Passem els valos a parse float
    latitud = parseFloat(latitud);
    longitud = parseFloat(longitud);

    var map = new google.maps.Map(document.getElementById('map-canvas-' + idioma + '-' + indice), {
        center: {
            lat: latitud,
            lng: longitud
        },
        zoom: 17
    });

    map.setOptions({ draggable: false });

    var geocoder = new google.maps.Geocoder;
    var input = document.getElementById('direccion-' + idioma + '-' + indice);

    var types = document.getElementById('type-selector-' + idioma + '-' + indice);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(latitud, longitud),
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function () {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
        }
        marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        $('#latitud-' + idioma + '-' + indice).val(marker.position.lat());
        $('#longitud-' + idioma + '-' + indice).val(marker.position.lng());

        // Buscamos la ciudad con la busqueda de la dirección
        posicion = 0;
        encontrado = 0;
        while (posicion < place.address_components.length && encontrado == 0) {
            if (place.address_components[posicion].types[0] == 'locality') {
                $('#ciudad-' + idioma + '-' + indice).val(place.address_components[posicion].long_name);
                encontrado = 1;
            }
            posicion++;
        }

        // Si después de recorrer la dirección devuelta no se ha encontrado dejamos el valor de la ciudad en blanco
        if (encontrado == 0) {
            $('#ciudad-' + idioma + '-' + indice).val("");
        }

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
    });

    // Sets a listener on a radio button to change the filter type on Places
    // Autocomplete.
    function setupClickListener(id, types) {
        var radioButton = document.getElementById(id);
        radioButton.addEventListener('click', function () {
            autocomplete.setTypes(types);
        });
    }

    setupClickListener('changetype-address-' + idioma + '-' + indice, ['address']);

    document.getElementById('buscar-coordenadas-' + idioma + '-' + indice).addEventListener('click', function () {
        latitud = $('#latitud-' + idioma + '-' + indice).val();
        longitud = $('#longitud-' + idioma + '-' + indice).val();
        direccion = $('#direccion-' + idioma + '-' + indice);
        ciudad = $('#ciudad-' + idioma + '-' + indice);
        if (parseFloat(latitud) < -180 || parseFloat(latitud) > 180 || parseFloat(longitud) < -180 || parseFloat(longitud) > 180) {
            mensaje_aviso = '<p>La <strong>Latitud</strong> y la <strong>Longitud</strong> deben ser valores entre <strong>-180 y 180</strong></p>';
            mostrarMensajeAviso(mensaje_aviso);
        }
        geocodeLatLng(geocoder, map, infowindow, latitud, longitud, direccion, marker, ciudad);
    });
}

function geocodeLatLng(geocoder, map, infowindow, latitud, longitud, direccion, marker, ciudad) {
    var input = latitud + ',' + longitud;
    var latlngStr = input.split(',', 2);
    var latlng = { lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1]) };
    geocoder.geocode({ 'location': latlng }, function (results, status) {
        map.setZoom(17);
        marker.setPosition(latlng);
        map.setCenter(latlng);

        if (status === google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                infowindow.setContent(results[1].formatted_address);
                infowindow.open(map, marker);
                direccion.val(results[1].formatted_address);

                // Buscamos la ciudad con la busqueda de la dirección
                posicion = 0;
                encontrado = 0;
                while (posicion < results.length && encontrado == 0) {
                    if (results[posicion].types[0] == 'locality') {
                        ciudad.val(results[posicion].address_components[0].long_name);
                        encontrado = 1;
                    }
                    posicion++;
                }

                // Si después de recorrer la dirección devuelta no se ha encontrado dejamos el valor de la ciudad en blanco
                if (encontrado == 0) {
                    ciudad.val("");
                }
            } else {
                direccion.val("");
                ciudad.val("");
                // infowindow.open(map, marker);
                // window.alert('No results found');
            }
        } else {
            direccion.val("");
            ciudad.val("");
            // window.alert('Geocoder failed due to: ' + status);
        }
    });
}

// Anulamos la tecla Enter porque falla con la API y nos redirecciona a la página principal de sedes
$(document).ready(function () {
    $("form").keypress(function (e) {
        if (e.which == 13) {
            return false;
        }
    });
});
