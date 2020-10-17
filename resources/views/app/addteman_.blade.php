@extends('layouts.main_')
@section('judul', 'Cari Teman')
@section('kiri')
<home-kiri-component></home-kiri-component>
    
@endsection
@section('tengah')
<div class="container-fluid">
    <div class="row">
        @foreach ($users as $userdata)
        @if ($userdata->name !== $user->name)
            
        <div class="col my-2 mx-2">
            <div class="card">
                <img src="{{$userdata->url_image}}" class="card-img-top" alt="{{$userdata->name}}" style="max-height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">{{$userdata->name}}</h5>
                <p class="card-text">Bergabung pada {{date('d M yy', $userdata->email_verivied_at)}}</p>
                    <button class="btn btn-primary">Tambahkan Teman</button>
                </div>
            </div>
        </div>
        @endif    
        @endforeach
    </div>
    
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
    class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" onclick="window.location.href = '/user/{{ $user->name }}'">
    {{$user->name}}
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

<home-kanan-component>
        
</home-kanan-component>
@endsection