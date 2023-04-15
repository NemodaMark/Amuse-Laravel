<?php

namespace App\Http\Controllers\Namespace;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function gameupload(Request $request)
    {
        // Validate form data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required|numeric',
            'genreID' => 'required|numeric',
            'description' => 'required',
            'file' => 'required|file|mimes:zip,rar|max:10240', // max size set to 10 GB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if file was uploaded
        if (!$request->hasFile('file')) {
            return redirect()->back()->withErrors(['File not found'])->withInput();
        }

        $file = $request->file('file');

        // Check file size
        $maxFileSize = 1024 * 1024 * 1024 * 10; // 10 GB
        if ($file->getSize() > $maxFileSize) {
            return redirect()->back()->withErrors(['File size exceeds maximum limit'])->withInput();
        }

        // Check file extension
        $allowedExtensions = ['zip', 'rar'];
        $extension = $file->getClientOriginalExtension();
        if (!in_array($extension, $allowedExtensions)) {
            return redirect()->back()->withErrors(['Invalid file extension'])->withInput();
        }

        // Split the file into chunks and upload
        // ...

        // Create link for the file
        $link = Storage::url($file->store('public/games'));

        // Save game data to database
        $data = [
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'genre_id' => $request->input('genreID'),
            'added' => date('Y-m-d H:i:s'),
            'user_id' => Auth::user()->id,
            'description' => $request->input('description'),
            'file_path' => $link,
        ];
        DB::table('games')->insert($data);

        // Redirect back to game upload page with success message
        return redirect()->back()->with('success', 'Game uploaded successfully');
    }
}
