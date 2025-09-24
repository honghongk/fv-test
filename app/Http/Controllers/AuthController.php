<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * 로그인 폼 화면
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }


    /**
     * 로그인 처리
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ( ! Auth::attempt($credentials) )
        {
            return back()->withErrors([
                'email' => '이메일 또는 비밀번호가 올바르지 않습니다.',
            ])->withInput();
        }

        // 세션 갱신
        $request->session()->regenerate();

        // 원래 접근하려던 페이지가 있으면 거기로, 없으면 /posts
        return redirect()->intended('/posts');
    }


    /**
     * 로그아웃 처리
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
