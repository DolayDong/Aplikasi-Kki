@extends('layouts.main_')

@section('judul', "Kirim Pesan (" . $teman->name .")")

@section('kiri')
    <component-kiri-pesan :user="{{Auth::user()}}"></component-kiri-pesan>
@endsection

@section('tengah')
    <div id="container-pesan" >
        <pesan-component :teman="{{$teman}}" :user="{{$user}}">
        @csrf
        </pesan-component>
    </div>
@endsection
@section('kanan')
<ul class="list-group">
    <li
    class="list-group-item d-flex justify-content-between align-items-center list-group-item-action"
    onclick="window.location.href = '/'">
    Home
    </li>
    <li
    class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" onclick="window.location.href = '/user/{{ Auth::user()->name }}'">
    {{Auth::user()->name}}
    </li>
<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" onclick="window.location.href = '/notifikasi/{{ Auth::id()}}'">
    Notifikasi
    <span class="badge badge-danger badge-pill">1</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action"
    onclick="window.location.href = '/logout'">
    Logout
    </li>
</ul>
@endsection
    



@section('script')
    <script>
        const komponentkiripesan = new Vue({
            el: ".kiri"
        });
        const containerpesan = new Vue({
            el: "#container-pesan"
        });

        const modalPreview = new Vue({
            el: "#modalpreview"
        })
    </script>
@endsection 