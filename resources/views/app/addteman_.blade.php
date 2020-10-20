@extends('layouts.main_')
@section('judul', 'Cari Teman')
@section('kiri')
<home-kiri-component></home-kiri-component>
    
@endsection
@section('tengah')
<div class="container-fluid">
    <div class="row">
        @foreach ($users as $user)
            @if ($user->name !== Auth::user()->name)
            @if (!$user->mengikuti())                  
                <div class="col my-2 mx-2">
                    <div class="card">
                        <img src="{{$user->url_image}}" class="card-img-top" alt="{{$user->name}}" style="max-height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title">{{$user->name}}</h5>
                            <p class="card-text">Bergabung pada {{date('d M yy', $user->email_verivied_at)}}</p>
                            {{-- component tombol pada vue --}}
                            <div class="container-fluid"   inline-template> 
                                <button-add-teman id="buttonaddteman" :gw="{{Auth::user()}}" :user="{{$user}}" :mengikuti="{{$user->mengikuti() === null ? 'false' : 'true'}}" :datas:data="{{$users}}">
                                
                                </button-add-teman>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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

<home-kanan-component>
        
</home-kanan-component>
@endsection

@section('script')
    <script>
        const buttonaddteman = new Vue({
        el: "#buttonaddteman"
    });

    </script>
@endsection