<script src="{{ asset('plugins/jquery/dist/jquery.min.js') }}?v={{ filemtime('plugins/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/popper.js/dist/umd/popper.min.js') }}?v={{ filemtime('plugins/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.js') }}?v={{ filemtime('plugins/moment/moment.js') }}"></script>
<script src="{{ asset('plugins/chart.js/dist/Chart.min.js') }}?v={{ filemtime('plugins/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}?v={{ filemtime('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('plugins/select2/i18n/es.js') }}?v={{ filemtime('plugins/select2/i18n/es.js') }}"></script>
<script src="{{ asset('plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}?v={{ filemtime('plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}?v={{ filemtime('plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-validator/dist/validator.min.js') }}?v={{ filemtime('plugins/bootstrap-validator/dist/validator.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.js') }}?v={{ filemtime('plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/ion.rangeSlider/js/ion.rangeSlider.min.js') }}?v={{ filemtime('plugins/ion.rangeSlider/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('plugins/dropzone/dist/dropzone.js') }}?v={{ filemtime('plugins/dropzone/dist/dropzone.js') }}"></script>
<script src="{{ asset('plugins/editable-table/mindmup-editabletable.js') }}?v={{ filemtime('plugins/editable-table/mindmup-editabletable.js') }}"></script>
<script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}?v={{ filemtime('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}?v={{ filemtime('plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar/dist/fullcalendar.min.js') }}?v={{ filemtime('plugins/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script src="{{ asset('plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}?v={{ filemtime('plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('plugins/tether/dist/js/tether.min.js') }}?v={{ filemtime('plugins/tether/dist/js/tether.min.js') }}"></script>
<script src="{{ asset('plugins/slick-carousel/slick/slick.min.js') }}?v={{ filemtime('plugins/slick-carousel/slick/slick.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/dist/util.js') }}?v={{ filemtime('plugins/bootstrap/js/dist/util.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/dist/alert.js') }}?v={{ filemtime('plugins/bootstrap/js/dist/alert.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/dist/button.js') }}?v={{ filemtime('plugins/bootstrap/js/dist/button.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/dist/carousel.js') }}?v={{ filemtime('plugins/bootstrap/js/dist/carousel.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/dist/collapse.js') }}?v={{ filemtime('plugins/bootstrap/js/dist/collapse.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/dist/dropdown.js') }}?v={{ filemtime('plugins/bootstrap/js/dist/dropdown.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/dist/modal.js') }}?v={{ filemtime('plugins/bootstrap/js/dist/modal.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/dist/tab.js') }}?v={{ filemtime('plugins/bootstrap/js/dist/tab.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/dist/tooltip.js') }}?v={{ filemtime('plugins/bootstrap/js/dist/tooltip.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/dist/popover.js') }}?v={{ filemtime('plugins/bootstrap/js/dist/popover.js') }}"></script>
<script src="{{ asset('back/js/dataTables.bootstrap4.min.js') }}?v={{ filemtime('back/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('back/js/demo_customizer.js') }}?v={{ filemtime('back/js/demo_customizer.js') }}"></script>
<script src="{{ asset('back/js/main.js') }}?v={{ filemtime('back/js/main.js') }}"></script>
<script src="{{ asset('plugins/sweetalert/sweetalert2.all.js') }}?v={{ filemtime('plugins/sweetalert/sweetalert2.all.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>

    @if( Session::get('showModalDaily') == true )
        $('#modal-parte-diario-login').modal('show')
        $(document).ready(function() {
            $('.salesepson').select2({
                dropdownParent: $("#modal-parte-diario-login")
            })
        })
    @endif


    $( 'input.onlyNumber' ).on("keypress keyup", function (event) {
        console.log(event)
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $( document ).on("keypress keyup blur", '.only-number', function (event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $(document).on('keydown', '.only-decimal', function ( event ) {
        if (event.shiftKey == true) {
            event.preventDefault();
        }

        key = event.keyCode;
        if ((key >= 48 && key <= 57) ||
            (key >= 96 && key <= 105) ||
            key == 8 || key == 9 || key == 37 ||
            key == 39 || key == 46 || key == 190 || key == 110) {
        } else {
            event.preventDefault();
        }
        if($(this).val().indexOf('.') !== -1 && (key == 190 || key == 110))
            event.preventDefault();
    });
</script>
