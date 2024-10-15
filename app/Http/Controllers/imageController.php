<?php

namespace App\Http\Controllers;

use App\Models\image;
use Illuminate\Http\Request;

class imageController extends Controller
{
    public function index()
    {
        return view('upImg/index');
    }

    public function show($id)
    {
        $image = image::findOrFail($id);
        return view('image.show', compact('image'));
    }

    public function storeupload(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $URL = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images'), $URL);
                image::create([
                    'URL' => $URL,
                ]);
            }
            return back()->with('success', 'Thành công!');
        }
        return back()->with('success', 'Thất bại!');
    }
}
