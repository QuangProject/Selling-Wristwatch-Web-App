@extends('layouts.base')

@section('title')
    Profile
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <section class="section profile">
        <div class="container">
            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Overview</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                                Password</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">First Name</div>
                                <div class="col-lg-9 col-md-8">{{ $user->firstname }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Last Name</div>
                                <div class="col-lg-9 col-md-8">{{ $user->lastname }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Gender</div>
                                <div class="col-lg-9 col-md-8">{{ $user->gender }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Birthday</div>
                                <div class="col-lg-9 col-md-8">{{ $user->birthday }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                <div class="col-lg-9 col-md-8">{{ $user->telephone }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Address</div>
                                <div class="col-lg-9 col-md-8">{{ $user->address }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                            </div>

                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                            <div id="profile-error" role="alert"></div>
                            <!-- Profile Edit Form -->
                            <form method="POST" id="update-profile-form">
                                @csrf

                                <div class="row mb-3">
                                    <label for="first-name" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="firstname" type="text" class="form-control" id="first-name"
                                            value="{{ $user->firstname }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="last-name" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="lastname" type="text" class="form-control" id="last-name"
                                            value="{{ $user->lastname }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                    <div class="col-md-8 col-lg-9 d-flex">
                                        <div class="form-check">
                                            @if ($user->gender == 'male')
                                                <input class="form-check-input" type="radio" id="maleGender" checked
                                                    name="gender" value="male" />
                                            @else
                                                <input class="form-check-input" type="radio" id="maleGender"
                                                    name="gender" value="male" />
                                            @endif
                                            <label class="form-check-label" for="maleGender">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check ms-4">
                                            @if ($user->gender == 'female')
                                                <input class="form-check-input" id="femaleGender" type="radio" checked
                                                    name="gender" value="female" />
                                            @else
                                                <input class="form-check-input" id="femaleGender" type="radio"
                                                    name="gender" value="female" />
                                            @endif

                                            <label class="form-check-label" for="femaleGender">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label" for="birthday">Birthday</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="date" class="form-control" id="birthday" name="birthday"
                                            value="{{ $user->birthday }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="telephone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="telephone" type="text" class="form-control" id="telephone"
                                            value="{{ $user->telephone }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="address" type="text" class="form-control" id="address"
                                            value="{{ $user->address }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" readonly class="form-control"
                                            id="Email" value="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form><!-- End Profile Edit Form -->
                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <div id="change-password-error" role="alert"></div>
                            <!-- Change Password Form -->
                            <form method="POST" id="change-password-form">
                                @csrf

                                <div class="row mb-3">
                                    <label for="current-password" class="col-md-4 col-lg-3 col-form-label">Current
                                        Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="oldPassword" type="password" class="form-control"
                                            id="current-password">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="new-password" class="col-md-4 col-lg-3 col-form-label">New
                                        Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="newPassword" type="password" class="form-control" id="new-password">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="re-new-password" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                        Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="ReNewPassword" type="password" class="form-control"
                                            id="re-new-password">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form><!-- End Change Password Form -->
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection
