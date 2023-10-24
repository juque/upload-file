<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttachmentRequest;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function store(StoreAttachmentRequest $request)
    {
        $attachment = $request->file('attachment')->store(options: 'attachments');

        return redirect()->route('upload')
            ->withMessage("File Successfully uploaded");
    }
}
