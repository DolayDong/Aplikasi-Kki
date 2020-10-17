@extends('layouts.auth_')
@section('body')
    
<div id="app">
    <login-component>
            @csrf
            @php
            if (session('error')) {
                echo ' <div class="alert alert-danger" role="alert">'. session('error') .'</div>';   
            }
            @endphp
    </login-component>
</div>
<div id="modal">
    <modal-daftar></modal-daftar>
</div>
@endsection
