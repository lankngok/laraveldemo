@extends('layout.app')
@section('title', 'Update People')

@section('main')
    <div class="container p-4">
        <div class="text-center">
            <h2>Update People: {{ $people->name }}</h2>
        </div>
        {{-- Form sửa thì action phải gọi vào route update, truyền theo id của phần tử, form có upload ảnh thì phải có enctype="multipart/form-data" --}}
        <form action="{{ route('people.update', $people->id) }}" method="post" enctype="multipart/form-data">
            {{-- Phải có @csrf không thì lỗi nặng --}}
            @csrf
            {{-- Nếu là form sửa thì bắt buộc phải có @method('PUT') --}}
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                {{-- Hiển thị giá trị của bản ghi cũ trong value của input --}}
                <input type="text" name="name" id="name" value="{{ old('name') ?? $people->name }}"
                    class="form-control rounded-0" placeholder="Name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="province_id">Province</label>
                <select class="form-control rounded-0" name="province_id" id="province_id">
                    {{-- Lặp để lấy ra tất cả các provinces, value của input là id của bảng province --}}
                    @foreach ($provinces as $prov)
                        {{-- Nếu id của province bằng với province_id của people thì option có selected --}}
                        @if ($prov->id == $people->province_id)
                            <option selected value="{{ $prov->id }}">{{ $prov->id }} - {{ $prov->name }}</option>
                        @else
                            {{-- còn không thì thôi --}}
                            <option value="{{ $prov->id }}">{{ $prov->id }} - {{ $prov->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" name="image" id="avatar" value="{{ old('image') }}"
                    class="form-control rounded-0">
                {{-- Hiển thị ảnh cũ bằng thẻ img, đi qua thư mục uploads ms có ảnh nhé --}}
                <div class="img w-25">
                    <img src="/uploads/{{ $people->avatar }}" alt="" class="card-img">
                </div>
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
                <div class="col-lg-6 form-group">
                    <label for="birthday">Birthday</label>
                    <input type="date" name="birthday" id="birthday" value="{{ old('birthday') ?? $people->birthday }}"
                        class="form-control rounded-0" placeholder="birthday">
                    @error('birthday')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-6 form-group">
                    <label for="birthday">Birthday</label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" id="genderz" value="1"
                                {{-- Nếu gender của people == 1 thì check vào nam --}} {{ $people->gender == 1 ? 'checked' : '' }}>
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" id="gender" value="0"
                                {{-- Nếu gender của people == 0 thì check vào nữ --}} {{ $people->gender == 0 ? 'checked' : '' }}>
                            Female
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="my-input">About</label>
                <textarea id="my-input" class="form-control rounded-0" type="text" name="about" placeholder="About"
                    rows="5">{{ old('about') ?? $people->about }}</textarea>
                @error('about')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-block btn-outline-secondary rounded-0">Add</button>
        </form>
    </div>
@endsection
