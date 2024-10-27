<?php

namespace App\Http\Controllers;

use App\Models\image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'images.*' => 'file|mimes:jpeg,jpg,png,gif,pdf,doc,docx|max:10240',
        ]);
        $urls = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Tạo tên tệp duy nhất
                $filename = time() . '-' . $image->getClientOriginalName();
    
                // Lưu tệp vào thư mục images
                $path = $image->storeAs('images', $filename, 'public'); // Sử dụng storeAs để đặt tên tệp
    
                // Lưu vào cơ sở dữ liệu
                $url = Storage::url($path); // Tạo URL truy cập
                Image::create([
                    'URL' => $url, // Lưu URL đã tạo
                ]);
    
                // Thêm URL vào mảng để hiển thị
                $urls[] = asset($url);
            }
    
            return redirect()->back()->with('success', 'Thành công!')->with('urls', $urls);
        }
    
        return redirect()->back()->with('error', 'Thất bại! Không có tệp nào được tải lên.');
    }
}
