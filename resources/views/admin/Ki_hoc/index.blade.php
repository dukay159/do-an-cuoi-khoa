@extends('layouts.admin')

@section('style')
    {{-- css --}}
@endsection

@section('script')
    <script>
        $(function() {
            $('#my-table').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'autoWidth': false
            })
        })
    </script>
@endsection

@section('content')
    <div class="page-wrapper" style="min-height: 657px;">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ $page }}</h3>
                    </div>
                    <div class="col-auto text-right float-right ml-auto">
                        <a href="{{ route('admin.ki_hoc.create') }}" class="btn btn-outline-primary mr-2">
                            <i class="fas fa-plus"></i>
                            Tạo kì học mới
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Xem kì học</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.ki_hoc.index') }}" method="GET">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Lọc theo kỳ học</label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="id">
                                            @foreach ($kys as $ky)
                                                <option value="{{ $ky->id }}"
                                                    {{ $ky->id == $id_ky ? 'selected' : '' }}>
                                                    Năm học: {{ $ky->nam_hoc }} - Học kỳ: {{ $ky->hoc_ky }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-info">Tìm kiếm</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Thông tin tổng quan {{ $page }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <h5>Danh sách sinh viên khóa tham gia</h5>
                                    <p>
                                        Khóa:
                                        @foreach ($ds_khoas as $khoa)
                                            {{ $khoa }},
                                        @endforeach
                                        <br>
                                        Tổng sinh viên tham gia: {{ $tong_sv }} sinh viên
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Danh sách lớp học</h5>
                                </div>
                                <div class="col-auto text-right float-right ml-auto">
                                    <a href="#" class="btn btn-outline-primary mr-2">
                                        <i class="fas fa-plus"></i>
                                        Mở thêm lớp mới
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (count($lop_hocs) > 1)
                                <div class="table-responsive">
                                    <table class="table table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Môn học</th>
                                                <th>Tín Chỉ</th>
                                                <th>Thời Gian</th>
                                                <th>Phòng</th>
                                                <th>Giảng Viên</th>       
                                                <th>Bắt đầu</th>
                                                <th>Kết thúc</th>
                                                <th>Số lượng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lop_hocs as $lop)
                                                <tr>
                                                    <td>{{ $lop->id }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.ki_hoc.view_class.detail', $lop->id) }}">
                                                            {{ $lop->ten_mon_hoc }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $lop->so_tin_chi }}</td>
                                                    <td>
                                                        Thứ: {{ $lop->ngay_trong_tuan }} 
                                                        <br>
                                                        Tiết: {{ $lop->tiet_bat_dau }}
                                                        - {{ $lop->tiet_bat_dau + $lop->so_tiet }}
                                                    </td>
                                                    <td>
                                                        Phòng: {{ $lop->phong_hoc }}
                                                    </td>
                                                    <td>
                                                        {{-- viết hoa từng chữ cái đầu --}}
                                                        {{ ucwords($lop->ho_ten) }}
                                                    </td>
                                                    <td>
                                                        {{ date('d-m-Y', strtotime($lop->ngay_bat_dau)) }}
                                                    </td>
                                                    <td>
                                                        {{ date('d-m-Y', strtotime($lop->ngay_bat_dau)) }}
                                                    </td>
                                                    <td>
                                                        {{ $lop->so_luong_dang_ki }} / 60
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                            <form method="post" action="{{ route('admin.ki_hoc.add_class', $id_ky) }}">
                                @csrf
                                <h4 class="text-center">
                                    Bạn chưa tạo lớp học nào vui lòng tạo mới ngay
                                    <br>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Tạo lớp mới tự động</button>
                                </h4>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
