@extends('layouts.admin')

@section('container')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                <div class="card-header bg-custom-header text-white border-bottom">
                    <h2 class="mb-0">Buat User Baru</h2>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger fade show" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form id="createUserForm" method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="role">Role</label>
                            <select class="form-control form-control-lg" id="role" name="role">
                                <option value="user">User</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">Create User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#158843'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#158843'
            });
        @endif

        document.getElementById('createUserForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let form = this;

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to create this user!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#158843',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, create it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection

<style>
    body {
        background-color: #eaf4e6; /* Latar belakang halaman dengan warna dominan */
    }

    .card {
        background-color: #ffffff;
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        background-color: #158843; /* Warna latar belakang header card */
        color: #ffffff;
        padding: 1rem 2rem;
        border-bottom: 0;
    }

    .card-body {
        padding: 2rem;
    }

    .form-control {
        border: 1px solid #158843;
        border-radius: 0.5rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #158843;
        box-shadow: 0 0 0 0.2rem rgba(21, 136, 67, 0.25);
        outline: none;
    }

    .btn-primary {
        background-color: #158843;
        border-color: #158843;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #137739;
        border-color: #137739;
    }

    .btn-primary:focus, .btn-primary.focus {
        box-shadow: 0 0 0 0.2rem rgba(21, 136, 67, 0.5);
    }

    .alert {
        border-radius: 0.5rem;
        animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>
