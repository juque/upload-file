<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'attachment' => 'required|max:5000'
        ]);

        $attachment = $request->file('attachment')->store(options: 'attachments');

        return redirect()->route('upload')
            ->withMessage("File Successfully uploaded");
    }
}
