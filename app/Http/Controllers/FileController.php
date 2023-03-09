<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $images = $request->image;

            foreach ($images as $img) {
                $imageName = time().'.'.$img->extension(); 
                
                $img->move(public_path('assets/images/'), $imageName);
                File::create(['file_name' => $imageName]);
            }
            return response()->json(['success' => 'File Uploaded'], 200);
        }
    }
}
