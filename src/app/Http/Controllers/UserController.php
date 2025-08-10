<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Contact;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        Auth::login($user);

        return redirect('/admin');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/admin');
        }

        return back()->withInput();
    }

    public function admin(Request $request)
    {
        $query = Contact::with('category');

        // 名前・メールの部分一致（OR検索）
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');

            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                ->orWhere('first_name', 'like', "%{$keyword}%")
                ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"])
                ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        // 性別フィルタ
        if ($request->has('gender') && $request->input('gender') !== '') {
            $query->where('gender', $request->input('gender'));
        }

        // カテゴリフィルタ
        if ($request->has('category') && $request->category !== '') {
            $query->where('category_id', $request->category);
        }

        // 登録日（created_at のピンポイント一致）
        if (!empty($request->registered_date)) {
            $query->whereDate('created_at', $request->registered_date);
        }

        // ページネーション＋クエリ保持
        $contacts = $query->paginate(7)->appends($request->query());
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function destroy($id)
    {
        Contact::destroy($id);
        return redirect()->back();
    }
}
