<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminMemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // ID
        if ($request->filled('member_id')) {
            $query->where('id', $request->member_id);
        }

        // 性別
        if ($request->filled('gender')) {
            $gender = $request->input('gender');
            // 片方だけ選択されているときだけ絞り込み
            if (count($gender) === 1) {
                $query->where('gender', $gender[0]);
            }
        }

        // フリーワード
        if ($request->filled('freeword')) {
            $query->where(function ($q) use ($request) {
                $q->where('name_sei', 'like', '%' . $request->freeword . '%')
                ->orWhere('name_mei', 'like', '%' . $request->freeword . '%')
                ->orWhere('email', 'like', '%' . $request->freeword . '%');
            });
        }


        // ソート対象
        $sort = $request->input('sort', 'id');
        // 昇順・降順
        $order = $request->input('order', 'desc');

        // ソート可能なカラムを限定
        if (!in_array($sort, ['id', 'created_at'])) {
            $sort = 'id';
        }
        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'desc';
        }

        $query->orderBy($sort, $order);

        $members = $query->paginate(10)->withQueryString();


        // 検索条件をビューへ渡す
        $member_search = $request->only([
            'member_id',
            'gender',
            'freeword',
        ]);

        session(['admin_member_index_url' => url()->full()]);

        return view('admin.member.index', compact('members', 'member_search'));
    }

    public function crate()
    {

    }

    public function store()
    {

    }

    public function show(User $user)
    {
        return view('admin.member.show', compact('user'));
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy(User $user)
    {
        // ユーザーのレビューをソフトデリート
        $user->reviews()->delete();

        // ユーザーをソフトデリート
        $user->delete();

        return redirect(session('admin_member_index_url', route('admin.member.index')));
    }
}
