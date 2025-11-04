@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add User</h3>
                        <a href="{{ route('user.view') }}" style="float: right;"
                            class="btn btn-rounded btn-primary mb-5">Return to Users</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('users.store') }}">
                                    @csrf

                                    <!-- Row 1: Name, Role, Gender -->
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Full Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control" required
                                                    placeholder="Enter full name" value="{{ old('name') }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Role <span class="text-danger">*</span></label>
                                                <select name="role" class="form-control" required>
                                                    <option value="" selected disabled>Select Role</option>
                                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                                        Admin</option>
                                                    <option value="instructor"
                                                        {{ old('role') == 'instructor' ? 'selected' : '' }}>Instructor
                                                    </option>
                                                    <option value="student"
                                                        {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                                                </select>
                                                @error('role')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Gender <span class="text-danger">*</span></label>
                                                <select name="gender" class="form-control" required>
                                                    <option value="" selected disabled>Select Gender</option>
                                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                                        Male</option>
                                                    <option value="female"
                                                        {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                                @error('gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- </div> --}}

                                        <!-- Row 2: Email, Phone, Password -->
                                        {{-- <div class="row"> --}}

                                        <div class="col-lg-4 col-lg-4 col-md-6 col-sm-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Phone Number <span
                                                        class="text-danger">*</span></label>
                                                <input type="tel" name="mobile" class="form-control" required
                                                    placeholder="Enter phone number" value="{{ old('mobile') }}">
                                                @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control" required
                                                    placeholder="Enter email address" value="{{ old('email') }}">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Password <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="password" name="password" class="form-control"
                                                        id="passwordField" required placeholder="Enter password">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            id="togglePassword" title="Show/Hide Password">
                                                            <i class="fas fa-eye" id="passwordIcon"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- </div> --}}

                                        <!-- Additional Information Row (Optional) -->
                                        {{-- <div class="row"> --}}
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <input type="text" name="address" class="form-control"
                                                    placeholder="Enter address" value="{{ old('address') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Religion</label>
                                                <select name="religion" class="form-control">
                                                    <option value="" selected disabled>Select Religion</option>
                                                    <option value="muslim"
                                                        {{ old('religion') == 'islam' ? 'selected' : '' }}>Muslim</option>
                                                    <option value="christian"
                                                        {{ old('religion') == 'christian' ? 'selected' : '' }}>Christian
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Notes</label>
                                            <textarea name="notes" class="form-control" rows="3" placeholder="Enter any additional notes...">{{ old('notes') }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <!-- Submit Button -->
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="text-right">
                                                <div class="text-xs-right">
                                                    <input type="reset" class="btn btn-rounded btn-secondary mr-2"
                                                        value="Reset">
                                                </div>
                                                <div class="text-xs-right">
                                                    <input type="submit" class="btn btn-rounded btn-info mb-5"
                                                        value="Add User">
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <!-- Submit Button -->
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="text-right">
                                                <input type="reset" class="btn btn-rounded btn-secondary mr-2"
                                                    value="Reset">
                                                <input type="submit" class="btn btn-rounded btn-info" value="Add User">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
        </div>
    </div>

    <!-- Password Toggle Script -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('passwordField');
            const passwordIcon = document.getElementById('passwordIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
                this.setAttribute('title', 'Hide Password');
            } else {
                passwordField.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
                this.setAttribute('title', 'Show Password');
            }
        });
    </script>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid #d2d6de;
            padding: 8px 12px;
        }

        .form-control:focus {
            border-color: #3c8dbc;
            box-shadow: 0 0 0 0.2rem rgba(60, 141, 188, 0.25);
        }

        .input-group-append .btn {
            border-left: 0;
            border-radius: 0 4px 4px 0;
        }

        .text-danger {
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        .btn-rounded {
            border-radius: 20px;
            padding: 8px 20px;
        }
    </style>
@endsection
