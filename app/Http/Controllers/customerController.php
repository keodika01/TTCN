<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;

class customerController extends Controller
{
    public function index()
    {
        $customer = customer::paginate(5);
        return view('index', compact('customer'))->with('i', (request()->input('page', 1) -1) *5);
    }

    public function create()
    {
        
        return view('create');
    }

    public function store(Request $request)
    {
        customer::create($request->all());
        return redirect()->route('customer.index')->with('thongbao', 'Thêm thành công');
    }

    public function edit(customer $customer)
    {
        return view('edit', compact('customer'));
    }

    public function update(Request $request, customer $customer)
    {
        $customer->update($request->all());
        return redirect()->route('customer.index')->with('thongbao', 'Chỉnh sửa thành công');
    }

    public function destroy(customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('thongbao', 'xóa thành công');
    }
}
