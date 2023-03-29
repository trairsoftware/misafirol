<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MİSAFİR OL</title>
    <link rel="icon" href="{{asset('assets/images/icon.png')}}" type="image/x-icon" />
    <!-- Fonts -->



    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/dt-1.13.2/b-2.3.4/b-colvis-2.3.4/cr-1.6.1/fc-4.2.1/fh-3.3.1/r-2.4.0/rg-1.3.0/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/datatables.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <meta name=“google-site-verification” content=“aojsyQtm-v2bXmBPxcCbiAYQdKxiBXEizG2mHR-_cAQ” />
    <script type="text/javascript" src="https://go.assistbox.io/rest/api/embedService/assistbox.c2c.embed.bundle.js?queueCode=MISAFIR_OL-Gorunt-05a8ed47-b548-4880-b000-96c30ca83910&apiKey=WDNkdFTpKyKuE97xerSCxmk48DZPB5E5&endpoint=https%3A%2F%2Fgo.assistbox.io&showBtn=true&showContactForm=true&newTab=true&btnText=G%C3%B6r%C3%BCnt%C3%BCl%C3%BC+%C3%87a%C4%9Fr%C4%B1+Merkezi&btnPos=right&btnSize=small&textColor=FFFFFF&btnColor=00ADEF&right=30px&bottom=110px"></script>
    <style>
        .img-wrapper {
            position: relative;
        }

        .img-responsive {
            width: 100%;
            height: auto;
        }

        .img-overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
        }

        .img-overlay:before {
            content: ' ';
            display: block;
            /* adjust 'height' to position overlay content vertically */
            height: 85%;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.2/b-2.3.4/fc-4.2.1/fh-3.3.1/r-2.4.0/rg-1.3.0/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/datatables.min.js">
    </script>
    <script src="{{asset('assets/js/datatables.js')}}"></script>
    @stack('scripts')
</head>