<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::with('category')->get();
        $categories = Category::all();

        return view('index', compact('contact', 'categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['category_id', 'first_name', 'last_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'detail',]);

        $category = Category::find($contact['category_id']);
        $contact['content'] = $category ? $category->content : '';

        return view('confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        if($request->input('back') == 'back'){
            return redirect('/')
                ->withInput($request->all());
        }

        $contact = $request->only(['category_id', 'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail',]);
        Contact::create($contact);

        return view('thanks');
    }
}
