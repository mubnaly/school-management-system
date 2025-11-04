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
                            class="btn btn-rounded btn-primary mb-5">Return</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">

                                <form method="post" action="{{ route('users.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row">
                                                <!-- Name Field -->
                                                <div class="form-group">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Full Name <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="name" class="form-control"
                                                                required placeholder="Ahmed Ali">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">


                                                        <div class="form-group">
                                                            <h5>Role<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="role" id="role" required=""
                                                                    class="form-control">
                                                                    <option value="" selected="" disabled="">
                                                                        Role</option>
                                                                    <option value="admin">Admin</option>
                                                                    <option value="instructor">Instructor</option>
                                                                    <option value="student">User</option>

                                                                </select>

                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <h5>Gender<span class="text-danger">*</span></h5>
                                                                <div class="controls">
                                                                    <select name="gender" id="gender" required=""
                                                                        class="form-control">
                                                                        <option value="" selected=""
                                                                            disabled="">
                                                                            Gender</option>
                                                                        <option value="male">Male</option>
                                                                        <option value="female">Female</option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <!-- Email Field -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Email <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="email" name="email" class="form-control"
                                                                    required placeholder="Enter your email">
                                                            </div>
                                                        </div>

                                                        <!-- Phone Field -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Phone Number <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="tel" name="phone" class="form-control"
                                                                    required placeholder="01234567890">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <!-- Password Field with Toggle -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Password <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="password" name="password"
                                                                        class="form-control" id="passwordField" required
                                                                        placeholder="Enter your password">
                                                                    {{-- <button type="button" class="btn btn-outline-secondary"
                                                                id="togglePassword">
                                                                <span class="bi bi-eye" id="passwordIcon"></span>
                                                            </button> --}}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Empty column for alignment -->
                                                        <div class="col-md-6">
                                                            <!-- Additional field can be added here if needed -->
                                                        </div>
                                                    </div>

                                                    <!-- JavaScript for Password Toggle -->
                                                    {{-- <script>
                                                document.getElementById('togglePassword').addEventListener('click', function() {
                                                    const passwordField = document.getElementById('passwordField');
                                                    const passwordIcon = document.getElementById('passwordIcon');

                                                    if (passwordField.type === 'password') {
                                                        passwordField.type = 'text';
                                                        passwordIcon.classList.remove('bi-eye');
                                                        passwordIcon.classList.add('bi-eye-slash');
                                                    } else {
                                                        passwordField.type = 'password';
                                                        passwordIcon.classList.remove('bi-eye-slash');
                                                        passwordIcon.classList.add('bi-eye');
                                                    }
                                                });
                                            </script>

                                            <!-- Add Bootstrap Icons (if not already included) -->
                                            <link rel="stylesheet"
                                                href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"> --}}

                                                    {{--
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <h5>Email<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="email" name="email" class="form-control"
                                                                required="">
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">

                                                        <h5>Phone Number<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="number" name="phone" class="form-control"
                                                                required="">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <h5>Password<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="password" name="password" class="form-control"
                                                                required="">
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">

                                                    </div>
                                                </div>
                                            </div>
 --}}



                                                    <!-- Submit Button -->

                                                    <div class="text-xs-right">
                                                        <input type="submit" class="btn btn-rounded btn-info mb-5"
                                                            value="Add">
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
@endsection
