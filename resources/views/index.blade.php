<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Web market - Prototype</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            li.ok {
                color: #404040;
                border-left: solid 0.5em #1fa67a;/*左側の線*/
                border-bottom: solid 0.2em #dadada;/*下に灰色線*/
                background: whitesmoke;
                margin-bottom: 0.2em;/*下のバーとの余白*/
                line-height: 1.5;
                padding: 0.5em;
                list-style-type: none!important;/*ポチ消す*/
                font-weight: bold;
            }

            li.ng {
                color: #404040;
                border-left: solid 0.5em #DD1155;/*左側の線*/
                border-bottom: solid 0.2em #dadada;/*下に灰色線*/
                background: whitesmoke;
                margin-bottom: 0.2em;/*下のバーとの余白*/
                line-height: 1.5;
                padding: 0.5em;
                list-style-type: none!important;/*ポチ消す*/
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                {{-- ログインしているか？ --}}
                @if(!!session('minecraftjp'))
                    {{-- TODO: 個人ページへの遷移リンク --}}
                    <a href="/users/{{session('minecraftjp')['uuid']}}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endif
            </div>

            <div class="content">
                <div class="title m-b-md">
                    Web Market!
                </div>

                <p>Coming soon.</p>
                <div class="links">
                    <a href="https://github.com/KisaragiEffective/webmarket">GitHub</a>
                    Welcome, {{session('minecraftjp')['preferred_username']}}!
                </div>
                
                <div>
                    <ul>
                        @foreach($external_service as $service => $status)
                        <li class="{{$status}}">{{$service}}: {{strtoupper($status)}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>
