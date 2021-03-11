<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('back.common.partials.metas')
	@include('back.common.partials.css')
    @yield('css')
</head>
<body class="menu-position-side menu-side-left full-screen with-content-panel">

	<div class="layout-w">
        @include('back.common.partials.menu')
        <div class="content-w">
            @include('back.common.partials.topbar')
            @yield('breadcrumb')
            <div class="content-panel-toggler">
                <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
            </div>
                @yield('content')
            </div>
            @yield('modals')
        </div>
    </div>
    <div class="display-type"></div>

    @include('back.common.partials.js')

    <script type="text/javascript">
    $(document).ready(function() {

        var tr;
        var img;
        $('.delete-register').click(function(e) {
            url = $(this).data('url');
            $('#delete_link').attr('href', url);
            $('#delete_link2').attr('href', url);
            tr = $(e.currentTarget).parents('tr');
            img = $(e.currentTarget).parent().parent();
        });

        $('#delete_link').click(e => {
            e.preventDefault();
            var url = $(e.currentTarget).attr('href');
            console.log('URL DE ATAC: ' + url);
            axios.delete(url).then(
                r => {

                    $('#modal-delete').modal('hide')
                    swal({
                        title: "Borrado correctamente",
                        text: ' ',
                        type: "success",
                        timer: 2000
                    });
                    tr.remove();
                    img.remove();
                }
            ).catch(e => {
                    $('#modal-delete').modal('hide')
                    swal({
                        title: "Error al borrar",
                        text: "@yield('swal.error.text')",
                        type: "error",
                        timer: 4000
                    });

            });
        })

        $('#delete_link2').click(e => {
            e.preventDefault();
            var url = $(e.currentTarget).attr('href');
            axios.get(url).then(
                r => {

                    $('#modal-delete').modal('hide')
                    swal({
                        title: "Borrado correctamente",
                        text: ' ',
                        type: "success",
                        timer: 2000
                    });
                    tr.remove();
                    img.remove();
                }
            ).catch(e => {
                    $('#modal-delete').modal('hide')
                    swal({
                        title: "Error al borrar",
                        text: "@yield('swal.error.text')",
                        type: "error",
                        timer: 4000
                    });

            });
        })

        @if(session('success'))
            swal({
                title: "{{ session('success') }}",
                text: ' ',
                type: "success",
                timer: 2000
            });
        @endif
        @if(session('error'))
            swal({
                title: "{{ session('error') }}",
                text: ' ',
                type: "error",
                timer: 2000
            });
        @endif
    })
    </script>
    <script src="{{ mix('/js/app.js') }}"></script>
    @yield('js')

</body>
</html>
