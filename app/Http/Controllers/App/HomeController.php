<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Pusher\Pusher;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('app.home_', ['user' => $user]);
    }

    public function autentikasi(Request $request)
    {
        $socket_id = $request->socket_id;
        $channel_name = $request->channel_name;

        $pusher = new Pusher("4c08e21f32b2ed3689f9", "dd8b5fb305b7d81c6e6c", "1094155", [
            'cluster' => 'ap4',
            'forcedTls' => true
        ]);

        $presence_data = ['name' => Auth::user()->name];
        $key = $pusher->presence_auth($channel_name, $socket_id, Auth::id());

        return response($key);

    }
}
