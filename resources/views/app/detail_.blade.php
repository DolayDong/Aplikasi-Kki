@extends('layouts.main_')
@section('judul', $user->name)
@section('kiri')
<div class="container my-5 mx-1">

    <a href="/" class="btn btn-primary">Kembali</a>
</div>
@endsection
@section('tengah')


<commentar-component :gw="{{$gw}}" :postingan="{{$postingan}}" :user="{{$user}}" id="content">

</commentar-component>
@endsection

@section('kanan')
<ul class="list-group">
    <li
    class="list-group-item d-flex justify-content-between align-items-center list-group-item-action"
    onclick="window.location.href = '/'">
    Home
    </li>
    <li
    class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" onclick="window.location.href = '/user/{{ $user->name }}'">
    {{Auth::user()->name}}
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" onclick="window.location.href = '/notifikasi'">
    Notifikasi
    <span class="badge badge-danger badge-pill">1</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action"
    onclick="window.location.href = '/logout'">
    Logout
    </li>
</ul>
@endsection
