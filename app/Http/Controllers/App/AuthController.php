<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Teman;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    public static function sendEmail(Request $request, $buat, $token)
    {
        $email = $request->email;
        //data untuk di kirim kedalam template email
        $data = [
            'username' => $request->username,
            'appname' => env('APP_NAME'),
            'email' => $email,
            'token' => urlencode($token)
        ];

        if ($buat == 'verifikasi') {
            Mail::send('template.email_template', $data, function ($mail) use ($email) {
                $mail->to($email, 'no-reply')->subject('Aktivasi Akun');
                $mail->from(env('MAIL_USERNAME'), 'TEAM KKI KELOMPOK VI');
            });
        }

        if (Mail::failures()) {
            return false;
        }
        return true;
    }

    public function verifikasi(Request $request)
    {
        // ambil data email dan token dari url
        $emailurl = $request->get('email');
        $tokenurl = $request->get('token');

        // cek apakah email dan token ada di database, untuk mencegah user menulis manual email dan token
        $datatoken = Token::query()->where('email', '=', $emailurl);
        if ($datatoken->first()) {
            // cek token
            if ($datatoken->first()->token === $tokenurl) {

                // cek waktu kadaluwarsa
                if (time() - $datatoken->first()->dibuat < (60 * 45)) {
                    // hapus data token 
                    if ($datatoken->where('token', '=', $tokenurl)->delete()) {
                        // update data verivikasi email dan status aktif
                        if (User::query()->where('email', '=', $emailurl)->update(['email_verivied_at' => time(), "aktif" => 1])) {
                            Auth::logout();
                            return view('template.valid_', ["email" => $emailurl]);
                        }
                    }
                } else {
                    // jika kadaluwarsa, hapus data token
                    if ($datatoken->where('token', '=', $tokenurl)->delete()) {
                        // lalu hapus data user
                        if (User::query()->where('email', '=', $emailurl)->delete()) {
                            // setelah berhasil dihapus, tampilkan view
                            return view('template.tidak_valid_verifikasi', ["code" => 404, "pesan" => "maaf! token kadaluwarsa, harap daftarkan email anda kembali", "judul" => "Bad Request"]);
                        }
                    }
                }
            } else {
                return view('template.tidak_valid_verifikasi', ["code" => 400, "pesan" => "token tidak valid", "judul" => "Bad Request"]);
            }
        } else {
            return view('template.tidak_valid_verifikasi', ["code" => 400, "pesan" => "email belum terdaftar", "judul" => "Bad Request"]);
        }
    }

    public function login(Request $request)
    {
        $username = $request->post('username-login');
        $password = $request->post('password-login');
        $remember = false;

        if ($request->rememberme === "on") {
            $remember = true;
        }

        $user = User::query()->where('email', '=', $username)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                if ($user->aktif === 1) {
                    if (Auth::attempt(['email' => $username, 'password' => $password, 'aktif' => 1], $remember)) {
                        // data untuk sessi
                        $sessi = Session::query()->create([
                            'user_id' => Auth::id(),
                            'user_agent' => $request->userAgent(),
                            'aktifitas_terakhir' => time()
                        ]);
                        if ($sessi->save()){
                            return redirect()->intended('/home');
                        }
                    }
                } else {
                    // user belum di aktivasi
                    $request->session()->flash('error', 'harap aktivasi akun anda');
                    return redirect()->intended('/');
                }
            } else {
                // password salah
                $request->session()->flash('error', 'password salah');
                return redirect()->intended('/');
            }
        } else {
            // user tidak ada
            $request->session()->flash('error', 'username belum terdaftar');
            return redirect()->intended('/');
        }
    }

    public function logout()
    {
        $sessi = Session::query()->where('user_id', '=', Auth::id());
            Auth::logout();
            if($sessi->delete()){
                request()->session()->flush();
                return redirect()->intended('/');
            } 

    }
}
