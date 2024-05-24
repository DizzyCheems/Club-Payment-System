<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\FileUpload;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create(Request $request)
    {
        $query = $request->input('search');
        $files = FileUpload::query();
    
        if ($query) {
            $files = $files->where('file_name', 'like', "%$query%");
        }
    
        $files = $files->get();
    
        return view('docs.list', compact('files'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
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


    public function download($id)
    {
        $file = FileUpload::findOrFail($id);
        $filePath = storage_path('app/public/' . $file->file_path);
        
        return response()->download($filePath, $file->file_name);
    }

    public function destroy($id)
    {
        try {
            // Find the file by its ID
            $file = FileUpload::findOrFail($id);

            // Delete the file from storage
            Storage::disk('public')->delete($file->file_path);

            // Delete the file record from the database
            $file->delete();

            return redirect()->back()->with('success', 'File deleted successfully.');
        } catch (\Exception $e) {
            // Log or handle the exception
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete file.');
        }
    }

    public function preview($id)
{
    $file = FileUpload::findOrFail($id);
    $filePath = storage_path('app/public/' . $file->file_path);
    
    // For simplicity, assuming PDF files can be previewed directly in the browser
    return response()->file($filePath);
}


}
