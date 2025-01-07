<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::all();
        return view('admin.contactus.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.contactus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->route('admin.contactus.index')->with('success', 'Contact information submitted successfully!');
    }



    public function show($id)
    {
        $contact = ContactUs::findOrFail($id);
        return view('admin.contactus.show', compact('contact'));
    }

    public function edit($id)
    {
        $contact = ContactUs::findOrFail($id);
        return view('admin.contactus.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = ContactUs::findOrFail($id);
        $contact->update([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->route('admin.contactus.index')->with('success', 'Contact information updated successfully!');
    }

    public function destroy($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contactus.index')->with('success', 'Xóa thành công!');
    }
}
