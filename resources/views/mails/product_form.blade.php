<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
            <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display|Lato:300,400,700&display=swap" rel="stylesheet">
            <title>Cinpasa</title>


            <style>
                table td, table th{padding: 15px 30px;}
                tfoot td{padding: 5px 30px;}
                hr{background-color: #e5e5e5;border:0;height: 1px;margin: 10px 0;width: 100%;}
                tfoot hr{background-color: rgba(255, 255, 255, .20);}
                h1, h2, h3, h4, h5, h6{font-family: 'DM Serif Display', serif;}
                .title{font-size: 30px;color: #474C7C;margin: 0 0 10px 0;}
                .text{font-size: 16px;color: #9C9DAE;line-height: 1.5em;}
                .answer-item{background-color: #FAFAFA;padding: 10px 30px;margin: 5px 0}
                .answer-title{color: #474C7C;font-size: 16px;font-weight: 700;margin: 5px 0;}
                .answer-text{color: #474C7C;font-size: 16px;font-weight: 300;margin: 10px 0;}
                 .answer-text-small{color: #474C7C;font-size: 13px;font-weight: 300;margin: 5px 0;}
                .foot-title{font-size: 12px;color: #fff;margin: 20px 0 0 0;}
                 .foot-text, .foot-text a{font-size: 12px;color: #E5E5E5;margin: 5px 0;}
                 .deco-none a, .deco-none{text-decoration: none!important;}
                 .square{border:1px solid #e5e5e5;margin: 0;padding-top: 100%;background-position: center!important;background-repeat: no-repeat!important;background-size: cover!important;}
                 .table td{padding: 0}
                 .row {
                    display: flex;
                    flex-wrap: wrap;
                    margin-right: -15px;
                    margin-left: -15px;
                }
                .col-md-4 {
                    flex: 0 0 28%;
                    max-width: 28%;
                    position: relative;
                    width: 100%;
                    min-height: 1px;
                    padding-right: 15px;
                    padding-left: 15px;
                    padding-bottom: 1em;
                }
            </style>
        </head>
        <body style="-webkit-text-size-adjust:none;background-color:#fff;width:650px;font-family:Lato, sans-serif;color:#555454;font-size:13px;line-height:18px;margin:auto">
            <table border="0" cellspacing="0" style="width: 100%; margin-top: 10px; -moz-box-shadow: 0 0 5px #afafaf; -webkit-box-shadow: 0 0 5px #afafaf; -o-box-shadow: 0 0 5px #afafaf; box-shadow: 0 0 5px #afafaf; filter: progid:DXImageTransform.Microsoft.Shadow(color=#afafaf,Direction=134,Strength=5);">


                <thead>
                    <tr>
                        <th colspan="2">
                            <a class="navbar-brand" href="https://www.laindustrialalgodonera.com/" title="liasa"><img
                    src="{{ asset('storage/emails/liasa-logo_'.app()->getLocale().'.png') }}" alt="liasa logo"  width="204"></a>
                    <hr>
                        </th>
                    </tr>
                </thead>
                <tfoot bgcolor="#001A71">
                    <tr>
                        <td colspan="1">
                            <a class="navbar-brand" href="https://www.laindustrialalgodonera.com/" title="liasa"><img
                    src="{{ asset('storage/emails/liasa-foot_'.app()->getLocale().'.png') }}" alt="liasa logo"  width="154"></a>
                        </td>
                        <td colspan="1" align="right">
                            <a style="margin-left: 10px" href="https://es-es.facebook.com/laindustrialalgodonera/" target="_blank"><img src="{{ asset('storage/emails/facebook-logo.png') }}" alt="facebook"></a>
                            <a style="margin-left: 10px" href="https://es.linkedin.com/company/liasa-la-industrial-algodonera-s-a-?trk=public_profile_experience-item_result-card_image-click" target="_blank"><img src="{{ asset('storage/emails/linkedin-logo.png') }}" alt="linkedin"></a>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="1">
                            <address>
                               <p class="foot-title"> CINPASA-OFICINES</p>
                                <p class="foot-text">Raval de Sant Rafael 21</p>

                                <p class="foot-title">Contáctanos en:</p>
                                 <p class="foot-text"><a href="mailto:marketing@cinpasa.com">marketing@cinpasa.com</a></p>
                            </address>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr>
                            <p class="foot-text deco-none"><a href="https://cinpasa.com/politica-privacidad" target="_blank">Política de privadesa </a>· <a href="https://cinpasa.com/aviso-legal" target="_blank">Avís legal</a></p>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td colspan="2">
                            <h1 class="title">Nou formulari rebut</h1>
                            <p class="text">Rebut:  <b>{{$petition->created_at}}</b></p>

                            <div class="answer-item">
                                <p class="answer-title">Nom i cognoms</p>
                                <p class="answer-text">{{ $petition->fullname }}</p>
                            </div>
                            <div class="answer-item">
                                <p class="answer-title">Empresa</p>
                                <p class="answer-text">{{ $petition->company }}</p>
                            </div>
                            <div class="answer-item">
                                <p class="answer-title">Email</p>
                                <p class="answer-text">{{ $petition->email }}</p>
                            </div>
                            <div class="answer-item">
                                <p class="answer-title">Telèfon</p>
                                <p class="answer-text">{{ $petition->phone_number }}</p>
                            </div>
                            <div class="answer-item">
                                <p class="answer-title">País</p>
                                <p class="answer-text">{{ $petition->country }}</p>
                            </div>
                            <div class="answer-item">
                                <p class="answer-title">Comentari</p>
                                <p class="answer-text">{{ $petition->comment }}</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p class="answer-title">PRODUCTES</p></td>
                    </tr>
                    <tr>
                        <td colspan="2"  align="left">
                            <div class="row">
                                @foreach ($petition->products as $index => $product)
                                    <div class="col-md-4">
                                        <figure class="square" style="background-image: url('{{$product->primaryImage ? Storage::url($product->primaryImage->path) : ""}}')"></figure>
                                        <p class="answer-title">{{ $product->name }}</p>
                                        <p class="answer-text-small">{!! strip_tags(Str::words($product->description, 15, '...')) !!}</p>
                                    </div class="col-md-4">
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                       <td colspan="2">
                            <em>No respongui a aquest missatge, és un enviament generat automàticament.</em>
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>
    </html>
