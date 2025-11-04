@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update User Info</h3>
                        <a href="{{ route('user.view') }}" style="float: right;" class="btn btn-rounded btn-primary mb-5">Back
                            to Users</a>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <!-- FIX: Changed div to form -->
                                <form method="post" action="{{ route('users.update', $editData->id) }}">
                                    @csrf

                                    <!-- Personal Information -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Full Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control" required
                                                    value="{{ $editData->name }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $editData->user_name }}" disabled>
                                                <small class="text-muted">Username cannot be changed</small>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">User Code</label>
                                                <input type="text" class="form-control" value="{{ $editData->code }}"
                                                    disabled>
                                            </div>
                                        </div>

                                        <!-- Contact Information -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control" required
                                                    value="{{ $editData->email }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Phone Number <span
                                                        class="text-danger">*</span></label>
                                                <input type="tel" name="mobile" class="form-control" required
                                                    value="{{ $editData->mobile }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <input type="text" name="address" class="form-control"
                                                    value="{{ $editData->address }}" placeholder="Enter address">
                                            </div>
                                        </div>

                                        <!-- Role & Status -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Role <span class="text-danger">*</span></label>
                                                <select name="role" class="form-control" required>
                                                    <option value="admin"
                                                        {{ $editData->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="instructor"
                                                        {{ $editData->role == 'instructor' ? 'selected' : '' }}>Instructor
                                                    </option>
                                                    <option value="student"
                                                        {{ $editData->role == 'student' ? 'selected' : '' }}>Student
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="1" {{ $editData->status == 1 ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="0" {{ $editData->status == 0 ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Personal Details -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Gender <span class="text-danger">*</span></label>
                                                <select name="gender" class="form-control" required>
                                                    <option value="Male"
                                                        {{ $editData->gender == 'Male' ? 'selected' : '' }}>
                                                        Male</option>
                                                    <option value="Female"
                                                        {{ $editData->gender == 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Religion</label>
                                                <select name="religion" class="form-control">
                                                    <option value="muslim"
                                                        {{ $editData->religion == 'muslim' ? 'selected' : '' }}>Muslim
                                                    </option>
                                                    <option value="christian"
                                                        {{ $editData->religion == 'christian' ? 'selected' : '' }}>
                                                        Christian</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Family Information -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Father's Name</label>
                                                <input type="text" name="father" class="form-control"
                                                    value="{{ $editData->father }}" placeholder="Father's name">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Mother's Name</label>
                                                <input type="text" name="mother" class="form-control"
                                                    value="{{ $editData->mother }}" placeholder="Mother's name">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">ID Number</label>
                                                <input type="text" name="id_no" class="form-control"
                                                    value="{{ $editData->id_no }}" placeholder="ID number">
                                            </div>
                                        </div>

                                        <!-- Password Update (Optional) -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">New Password (Leave blank to keep
                                                    current)</label>
                                                <div class="input-group">
                                                    <input type="password" name="password" class="form-control"
                                                        id="passwordField" placeholder="Enter new password">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            id="togglePassword" title="Show/Hide Password">
                                                            <i class="fas fa-eye" id="passwordIcon"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <small class="text-muted">Minimum 6 characters</small>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">Notes</label>
                                                <textarea name="notes" class="form-control" rows="3" placeholder="Additional notes...">{{ $editData->notes }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="text-right">
                                                <a href="{{ route('user.view') }}"
                                                    class="btn btn-rounded btn-secondary mr-2">
                                                    Cancel
                                                </a>
                                                <input type="submit" class="btn btn-rounded btn-info"
                                                    value="Save Changes">

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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

        .btn-rounded {
            border-radius: 20px;
            padding: 8px 20px;
        }
    </style>
@endsection
