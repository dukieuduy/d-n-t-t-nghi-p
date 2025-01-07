<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Product;
use Illuminate\Http\Request;

class ContactusClientController extends Controller
{


    public function create()
    {
        return view('client.pages.contactus');
    }

    // Controller
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);



        // return redirect()->route('client.contactus.create')->with('success', 'Cảm ơn bạn đã liên hệ!');

    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $listProduct = Product::where('name', 'like', '%' . $query . '%')
                               ->orWhere('description', 'like', '%' . $query . '%')
                               ->get();
                               return view('client.pages.search_results', compact('listProduct', 'query'));


    }




    public function listAboutus()
    {
        return view('client.pages.about');
    }


    public function purChase ()
    {
        return view('client.pages.purchase');
    }


}
