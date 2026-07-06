<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\MypageEmailUpdateMail;

class MypageController extends Controller
{
    // マイページ表示
    public function mypage()
    {
        $member = Auth::user();
        return view('mypage.mypage', compact('member'));
    }

    // 退会確認
    public function withdrawalConfirm()
    {
        return view('mypage.withdrawal_confirm');
    }
    // 退会
    public function withdrawal(Request $request)
    {
        $user = Auth::user();
        // ソフトデリート
        $user->delete();
        // ログアウト処理
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('top');
    }

    // 編集画面
    public function edit()
    {
        $member = session('member.editing');
        if (!$member) {
            $member = Auth::user()->toArray();
        }

        return view('mypage.edit', compact('member'));
    }
    // 編集確認画面
    public function editConfirm(Request $request)
    {
        $data = $request->validate(
        [
            'name_sei' => ['required', 'string', 'max:20',],
            'name_mei' => ['required', 'string', 'max:20',],
            'nickname' => ['required', 'string', 'max:10',],
            'gender' => ['required', 'integer', Rule::in(array_keys(config('master.gender')))],
        ]
        );

        session()->put('member.editing', $data);

        return view('mypage.edit_confirm', compact('data'));
    }
    // DB登録
    public function update()
    {
        $data = session('member.editing', []);
        if (!$data) {
            return redirect()->route('top');
        }
 
        $member = Auth::user();
        $member->update([
            'name_sei' => $data['name_sei'],
            'name_mei' => $data['name_mei'],
            'nickname' => $data['nickname'],
            'gender' => $data['gender'],
        ]);
 
        session()->forget('member.editing');
 
        return to_route('mypage');
    }

    // パスワード変更画面
    public function editPassword()
    {
        return view('mypage.editpassword');
    }
    // DB登録
    public function updatePassword(Request $request)
    {
        $data = $request->validate(
        [
            'password' => ['required', 'string', 'between:8,20', 'regex:/^[a-zA-Z0-9]+$/', 'confirmed',],
        ],
        [
            'password.regex' => 'パスワードは半角英数字で入力してください。',
        ]
        );

        $member = Auth::user();
        $member->update([
            'password' => bcrypt($data['password']),
        ]);        

        return to_route('mypage');
    }

    // メールアドレス変更画面
    public function editEmail()
    {
        $member = Auth::user();

        return view('mypage.editemail', compact('member'));
    }
    // 認証コード送信
    public function editEmailSendcode(Request $request)
    {
        $data = $request->validate(
        [
            'email' => ['required', 'string', 'max:200', 'email', 'unique:members,email',],
        ]
        );

        session()->put('member.editingemail', $data);

        // 認証コードを記載したメールを送信
        do {
            $auth_code = random_int(100000, 999999);
        } while (
            User::where('auth_code', $auth_code)->exists()
        );
        $member = Auth::user();
        $member->update([
            'auth_code' => $auth_code,
        ]);

        Mail::to($data['email'])->send(new MypageEmailUpdateMail($auth_code));

        return view('mypage.editemail_inputcode');
    }
    // DB登録
     public function updateEmail(Request $request)
    {
        // 認証コード確認
        $member = Auth::user();
        if ($request->auth_code != $member->auth_code) {
            return back()->withErrors([
                'auth_code' => '認証コードが違います。'
            ]);
        }

        $member->update([
            'email' => session('member.editingemail.email'),
            'auth_code' => null,
        ]);
 
        session()->forget('member.editingemail');     

        return to_route('mypage');
    }   
}
