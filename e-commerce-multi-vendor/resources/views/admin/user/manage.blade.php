@extends('admin.layouts.layout')
@section('title', 'Users')
@section('admin_content')
<table id="user-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Email</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col">Email Verified At</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <td>{{ $user->email }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->email_verfied_at }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
            <td><button class="btn btn-primary btn-material">View</button><br><button class="btn btn-success btn-material">Edit</button></td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready( function () {
        $('#user-table').DataTable();
    } );
</script>
@endsection