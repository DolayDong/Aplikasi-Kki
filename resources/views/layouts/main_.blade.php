<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('judul')</title>
        @if (auth()->user())
            
        <script>
            window.csrfToken = "{{csrf_token()}}";
            </script>
            @endif
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            div .online {
                width: 10px;
                height: 10px;
                border-radius: 25px;
                background-color: greenyellow;
            }
            .photo-profile {
                width: 25px;
                height: 25px;
                border-radius: 25px;
            }
            .list-group-item-action {
                cursor: pointer;
            }
        </style>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link rel="stylesheet" href="{{asset('/css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/chat.css')}}">
   
    </head>
    <body>
    <div class="container-fluid">
            <div class="row">
                <div id="home-kiri" class="col .kiri">
                    @yield('kiri')
                </div>
            
                <div class="col-6">
                    @yield('tengah')
                    
                </div>
                <div id="home-kanan" class="col">
                    @yield('kanan')
                        
                </div>
    
            </div>
    </div>
    <div id="modal-add-photo">
        <modal-add-photo>
            @csrf
        </modal-add-photo>
    </div>
    
        
        <script src="{{asset('/js/app.js')}}">
import PostinganComponent from "@/components/PostinganComponent.vue";
        </script>
        @yield('script')
    </body>
</html>
