<div class="modal fade" id="modal-guide" tabindex="-1" role="dialog" aria-labelledby="modal-colorLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-body bg-light">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="form-body-email">
                    <form id="form-request">
                        {{ csrf_field() }}
                        
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p class="h4">
                                    {{__('Productos.modal_guia_email')}}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="form-group">
                                    <input placeholder="{{__('Productos.modal_email_placeholder')}}" id="name" name="email" style="background-color: #F2F4F8" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <button
                                style="padding-left:1.5em; padding-right:1.5em; background-color: orange !important;" 
                                class="btn btn-sub"
                                id="send-request"
                            >
                            {{__('Productos.modal_guia_enviar')}}
                            </button>
                        </div>
                    </form>
                </div>
                <div id="form-body-email-send" style="display: none">
                    <span role="status" aria-hidden="true"><i class="fas fa-spinner fa-spin mr-2"></i></span>{{__('Productos.modal_guia_enviando_datos')}}
                </div>
                <div id="form-body-email-sended" style="display: none">
                    <span role="status" aria-hidden="true"><i class="fas fa-check mr-2"></i></span>{{__('Productos.modal_guia_datos_enviados')}}
                </div>

                
            </div>
        </div>
    </div>
</div>

<script>
    $('#form-request').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            method: "POST",
            url: '{{ route("download.guide", $product->id) }}',
            data: {
                "email": $('#name').val()
            },
            dataType: "json",
            beforeSend: function() {
                $('#form-body-email').css("display","none");
                $('#form-body-email-send').css("display","");

            },
            success : function(data){
                $('#form-body-email-send').css("display","none");
                $('#form-body-email-sended').css("display","");
                
            },
            error : function(xhr, status){
                console.log(xhr,status);
            }
        });
    });

    $('#modal-guide').on('hidden.bs.modal', function(e){
        $('#form-body-email').css("display","");
        $('#form-body-email-send').css("display","none");
        $('#form-body-email-sended').css("display","none");
    });
</script>
