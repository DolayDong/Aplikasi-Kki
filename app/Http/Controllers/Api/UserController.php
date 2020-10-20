<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\App\AuthController;
use App\Http\Resources\HomeResource;
use App\Models\Teman;
use App\Models\Token;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registrasi(Request $request)
    {
        // replace karakter spasi pada username menjadi titik
        $username = str_replace(" ", ".", $request->post('username'));

        // cek apakah username sudah terdaftar
        if (User::query()->where('name', '=', $username)->first()) {
            // jika sudah return response ke api
            return response()->json(["message" => "username sudah terdaftar", "error" => "username"], 400);
        } else {
            // cek email apakah sudah terdaftar
            if (User::query()->where('email', '=', $request->only("email"))->first()) {
                // kirim response 400 ke request jika sudah
                return response()->json(["message" => "email sudah terdaftar", "error" => "email"], 400);
            } else {
                // data user dan token aktivasi
                $tokenverivikasi = base64_encode(random_bytes(64));
                $apitoken = base64_encode(random_bytes(32));
                $email = $request->post('email');

                // EloquentOrm laravel
                $datauser = User::query()->create([
                    'name' => strtolower($username),
                    'email' => $email,
                    'api_token' => $apitoken,
                    'password' => Hash::make($request->post('password')),
                    'aktif' => 0
                ]);

                // EloquentOrm laravel
                $datatoken = Token::query()->create([
                    'email' => $email,
                    'token' => $tokenverivikasi,
                    'dibuat' => time()
                ]);

                // jika datauser berhasil disimpan ke database
                if ($datauser->save()) {
                    // cek datatoken juga
                    if ($datatoken->save()) {

                        // cek apakah send email berhasil?
                        if (AuthController::sendEmail($request, "verifikasi", $tokenverivikasi)) {
                            // jika berhasil kirim response ke request kode 200
                            return response()->json(["message" => "email verifikasi telah dikirim"], 200);
                        } else {
                            return response()->json(["message" => "gagal mengirim email verifikasi"], 500);
                        }
                    }
                }
            }
        }
    }

    public function listteman(User $user)
   {
    //    return $user->temans()->with('postingans')->with('teman')->with('session')->get();
        return HomeResource::collection($user->temans()->with('postingans')->with('teman')->with('session')->get());
    }

    public function addTeman(User $user)
    {
        // panggil fungsi tambah teman di model
        $teman = auth()->user()->tambahTeman($user);

        if ($teman === null) {
            return response()->json(["message" => " anda sudah berteman"], 500);
        }

        return response()->json($teman );
    }

    public function hapusTeman(User $user)
    {
        $berteman = $user->mengikuti();

        if ($berteman === null) {
            return response()->json(["message" => "anda tidak berteman"], 500);
        }

    
        if($berteman->delete()){
            return response()->json(["message" => "berhasil unfollow"], 200);
        }

    }
}
