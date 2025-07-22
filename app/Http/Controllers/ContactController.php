<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request) {
        $data = $request->validate([
            'name' => "required",
            "email" => "required | email",
            "message" => "required"
        ]);

        Mail::to('maulanawardana01@gmail.com')->send(new ContactMessage($data));

        return back()->with('success', 'pesan berhasil dikirim');
    }
}
