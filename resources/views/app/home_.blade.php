@extends('layouts.main_')
@section('judul', 'Home')
@section('kiri')
<home-kiri-component :user="{{Auth::user()}}"></home-kiri-component>
    
@endsection
@section('tengah')
<postingan-component id="home-tengah" :user="{{Auth::user()}}">
</postingan-component>

@endsection

@section('kanan')
<div class="container-fluid position-fixed pr-5">
    <ul class="list-group">
        <li
    class="list-group-item d-flex justify-content-between align-items-center list-group-item-action"
    onclick="window.location.href = '/'">
    Home
</li>
<li
class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" onclick="window.location.href = '/user/{{ $user->name }}'">
{{$user->name}}
</li>
<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" onclick="window.location.href = '/notifikasi/{{$user->id}}'">
    Notifikasi
    <span class="badge badge-danger badge-pill">1</span>
</li>
<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action"
onclick="window.location.href = '/logout'">
Logout
</li>
</ul>

</div>
<home-kanan-component>
        
</home-kanan-component>
@endsection

@section('script')
    <script>
        const likekomponent = new Vue({
            el: "#likekomponent",
            
        })
    </script>
@endsection