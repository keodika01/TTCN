@extends('layout')

@section('content')
    <form action={{route('customer.update', $customer->id)}} method="POST">
        @csrf
        @method('PUT')  
        <div class="form-group">
            <label>Mã Khách hàng </label>
            <input class="form-control" style="width:50%;" type="text" value="{{$customer->MaKH}}" name="MaKH" required/>
        </div>

        <div class="form-group">
            <label>Tên Khách hàng </label>
            <input class="form-control" style="width:50%;" type="text" value="{{$customer->TenKH}}" name="TenKH" />
        </div>
        <div class="form-group">
            <label>Ngày Sinh</label>
            <input class="form-control" style="width:50%;" type="text" value="{{$customer->NgaySinh}}" name="NgaySinh"/> <br>
        </div>
        <input type="submit" class="btn btn-success" value="Sửa khách hàng" />
    </form>
@endsection