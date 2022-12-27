@extends('layout.app')
@section('title', 'Update Province')

@section('main')
    <div class="container p-4">
        <div class="text-center">
            <h2>Update Province: {{ $province->name }}</h2>
        </div>

        <form action="{{ route('province.update', $province->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') ?? $province->name }}" class="form-control rounded-0" placeholder="Name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-block btn-outline-secondary rounded-0">Add</button>
        </form>
    </div>
@endsection
