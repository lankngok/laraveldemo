@extends('layout.app')
@section('title', 'Provinces Page')

@section('main')
    <div class="container p-4">
        <div class="text-center">
            <h2>List Provinces</h2>
        </div>
        {{-- In ra thông báo --}}
        @if (session('message'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{{ session('message') }}</strong>
            </div>
        @endif

        {{-- thẻ a link sang trang thêm mới --}}
        <a href="{{ route('province.create') }}" class="btn btn-outline-primary rounded-0 mt-3">&plus; Add</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- Duyệt danh sách bằng foreach, duyệt biến provinces --}}
                @foreach ($provinces as $prov)
                    <tr>
                        <td style="width: 10%;" scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $prov->id }}</td>
                        <td>{{ $prov->name }}</td>
                        <td class="w-25">
                            {{-- Form sử dụng để xóa --}}
                            <form action="{{ route('province.destroy', $prov->id) }}" method="post">
                                {{-- bắt buộc phải có @method('DELETE') và @csrf --}}
                                @method('DELETE') @csrf
                                {{-- Thẻ a route sang trang sửa --}}
                                <a href="{{ route('province.edit', $prov->id) }}"
                                    class="btn btn-outline-success rounded-0">Update</a>

                                {{-- button submit form xóa --}}
                                <button type="submit" class="btn btn-outline-danger rounded-0"
                                    onclick="return confirm('Want to delete ?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Phân Trang, mở file AppServiceProvider.php lên --}}
        {{ $provinces->links() }}
    </div>
@endsection
