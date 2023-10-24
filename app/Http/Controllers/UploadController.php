<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index() {
        return view('upload');
    }

    public function store(Request $request) {
        $attachment = $request->file('attachment')->store(options: 'attachments')
        dd($attachment);
    }
}
