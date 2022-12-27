@extends('layout.app')
@section('title', 'Add Province')

@section('main')
    <div class="container p-4">
        <div class="text-center">
            <h2>Add Provinces</h2>
        </div>

        <form action="{{ route('province.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control rounded-0" placeholder="Name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-block btn-outline-secondary rounded-0">Add</button>
        </form>
    </div>
@endsection
