<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display|Lato:300,400,700&display=swap" rel="stylesheet">
    <title>{{ env('APP_NAME') }}</title>
    <style>
        table td,
        table th {
            padding: 15px 30px;
        }

        tfoot td {
            padding: 5px 30px;
        }

        hr {
            background-color: #e5e5e5;
            border: 0;
            height: 1px;
            margin: 10px 0;
            width: 100%;
        }

        tfoot hr {
            background-color: rgba(255, 255, 255, .20);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'DM Serif Display', serif;
        }

        .title {
            font-size: 30px;
            color: #474C7C;
            margin: 0 0 10px 0;
        }

        .text {
            font-size: 16px;
            color: #9C9DAE;
            line-height: 1.5em;
        }

        .answer-item {
            background-color: #FAFAFA;
            padding: 10px 30px;
            margin: 5px 0
        }  b   

        .answer-title {
            color: #474C7C;
            font-size: 16px;
            font-weight: 700;
            margin: 5px 0;
        }

        .answer-text {
            color: #474C7C;
            font-size: 16px;
            font-weight: 300;
            margin: 10px 0;
        }

        .answer-text-small {
            color: #474C7C;
            font-size: 13px;
            font-weight: 300;
            margin: 5px 0;
        }

        .foot-title {
            font-size: 12px;
            color: #fff;
            margin: 20px 0 0 0;
        }

        .foot-text,
        .foot-text a {
            font-size: 12px;
            color: #E5E5E5;
            margin: 5px 0;
        }

        .deco-none a,
        .deco-none {
            text-decoration: none !important;
        }

        .square {
            border: 1px solid #e5e5e5;
            margin: 0;
            padding-top: 100%;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
        }

        .table td {
            padding: 0
        }

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
        .mt-4 {
           margin-top: 1.5rem;
        }
    </style>
</head>

<body
    style="-webkit-text-size-adjust:none;background-color:#fff;width:650px;font-family:Lato, sans-serif;color:#555454;font-size:13px;line-height:18px;margin:auto">
    <table border="0" cellspacing="0"
        style="width: 100%; margin-top: 10px; -moz-box-shadow: 0 0 5px #afafaf; -webkit-box-shadow: 0 0 5px #afafaf; -o-box-shadow: 0 0 5px #afafaf; box-shadow: 0 0 5px #afafaf; filter: progid:DXImageTransform.Microsoft.Shadow(color=#afafaf,Direction=134,Strength=5);">

        <thead>
            <tr>
                <th colspan="2">
                    <a class="navbar-brand" href="{{ asset('/') }}" title="{{ env('APP_NAME') }}"><img
                            src="{{ asset('/front/img/logo-cinpasa.svg') }}" alt="{{ env('APP_NAME') }} logo"
                            width="204"></a>
                    <hr>
                </th>
            </tr>
        </thead>
        <tfoot bgcolor="#001A71">
            <tr>
                <td colspan="1">
                    <a class="navbar-brand" href="{{ asset('/') }}" title="{{ env('APP_NAME') }}"><img
                        src="{{ asset('/front/img/logo-cinpasa.svg') }}" alt="{{ env('APP_NAME') }} logo"
                        width="154">
                    </a>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td colspan="2">
                    <h1 class="title">
                        {{__('Productos.mail.title')}}
                    </h1>

                    <div class="mt-4">
                        {{__('Productos.mail.message')}}
                    </div>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <em>
                        {{__('Productos.mail.message-auto-send')}}
                    </em>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
