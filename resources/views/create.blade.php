@extends('layout')

@section('content')
    <form action={{route('customer.store')}} method="POST">
        @csrf  
        <div class="form-group">
            <label>Mã Khách hàng </label>
            <input class="form-control" style="width:50%;" type="text" name="MaKH" required/>
        </div>

        <div class="form-group">
            <label>Tên Khách hàng </label>
            <input class="form-control" style="width:50%;" type="text" name="TenKH" />
        </div>
        <div class="form-group">
            <label>Ngày Sinh</label>
            <input class="form-control" style="width:50%;" type="text" name="NgaySinh"/> <br>
        </div>
        <input type="submit" class="btn btn-success" value="Thêm khách hàng" />
    </form>
@endsection