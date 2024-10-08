@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Quản lý khách hàng</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('customer.create')}}" class="btn btn-primary float-end">Thêm mới</a>
                    </div>
                </div>
                <div class="card-body">
                    @if (@Session::has('thongbao'))
                        <div class="alert alert-success">
                            {{Session::get('thongbao')}}
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã Khách hàng</th>
                                <th>Tên Khách hàng</th>
                                <th>Ngày sinh</th>
                            </tr>
                        </thead>
                            @foreach($customer as $cs)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$cs->MaKH}}</td>
                                <td>{{$cs->TenKH}}</td>
                                <td>{{$cs->NgaySinh}}</td>
                                <td>
                                    <form action="{{route('customer.destroy', $cs->id)}}" method="POST">
                                        <a href="{{route('customer.edit', $cs->id)}} " class="btn btn-info">Sửa</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection