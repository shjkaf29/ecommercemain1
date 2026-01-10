@extends('admin.layouts.maindesign')

@section('panel')
<div class="container mt-5">
    <h3>Edit User</h3>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>User Type</label>
            <select name="user_type" class="form-control">
                <option value="user" {{ $user->user_type == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Password (leave blank to keep current password)</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password">
                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">Show</button>
            </div>
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm new password">
                <button type="button" class="btn btn-outline-secondary" onclick="toggleConfirmPassword()">Show</button>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
function togglePassword() {
    const pwd = document.getElementById('password');
    pwd.type = pwd.type === 'password' ? 'text' : 'password';
}

function toggleConfirmPassword() {
    const pwdConfirm = document.getElementById('password_confirmation');
    pwdConfirm.type = pwdConfirm.type === 'password' ? 'text' : 'password';
}
</script>
@endsection

