<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileUpload;

class FileUploadController extends Controller
{
    public function create()
    {
        return view('fileupload.create');
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'file' => 'required|mimes:pdf,docx|max:25000',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        FileUpload::create([
            'file_name' => $fileName,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    } catch (\Exception $e) {
        // Log or dd the exception
        \Log::error($e->getMessage());
        dd($e->getMessage());
    }
}

}
