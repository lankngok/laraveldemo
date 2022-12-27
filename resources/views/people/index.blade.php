@extends('layout.app')

@section('title', 'People Page')

@section('main')
    <div class="container-fluid p-4">
        <div class="text-center">
            <h2>List People</h2>
        </div>

        @if (session('message'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{{ session('message') }}</strong>
            </div>
        @endif

        <a href="{{ route('people.create') }}" class="btn btn-outline-primary rounded-0 mt-3">&plus; Add</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Province</th>
                    <th>Avatar</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>About</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($people as $peop)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $peop->id }}</td>
                        <td>{{ $peop->name }}</td>
                        <td>{{ $peop->provinces->name }}</td>
                        <td style="width: 10%;">
                            <img src="uploads/{{ $peop->avatar }}" alt="" class="card-img">
                        </td>
                        <td>{{ $peop->birthday }}</td>
                        <td>{{ $peop->gender == 1 ? 'Male' : 'Female' }}</td>
                        <td>{{ $peop->about }}</td>
                        <td>
                            <form action="{{ route('people.destroy', $peop->id) }}" method="post">
                                @method('DELETE') @csrf

                                <a href="{{ route('people.edit', $peop->id) }}"
                                    class="btn btn-outline-success rounded-0">Update</a>
                                <button type="submit" class="btn btn-outline-danger rounded-0"
                                    onclick="return confirm('Want to delete ??')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $people->links() }}
    </div>
@endsection
