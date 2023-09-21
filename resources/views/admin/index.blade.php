@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{-- reset password --}}
                        <form action="{{ route('admin.reset-password', ['user'=>$user->id]) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Yakin mau reset password user ini?')">Reset Password</button>
                        </form>

                        <form action="{{ route('admin.destroy', ['user'=>$user->id]) }}" method="POST" class="d-inline" id="deleteForm">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus user ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>

@endsection