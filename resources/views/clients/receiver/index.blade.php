@extends('layouts.base')

@section('title')
    Payment
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/receiver.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="mt-4 mb-3">
            <div class="text-center lh-1 mb-2">
                <h2 class="fw-bold">Receiver List</h2>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addReceiverModal">
                    Add New Receiver
                </button>
            </div>
        </div>
        <ul class="address-list" id="listReceiver">
            <li>
                <div class="card">
                    <h3 class="name">John Doe</h3>
                    <p class="address">
                        123 Main Street<br>
                        New York City, New York, 10001
                    </p>
                    <p class="phone">Phone: (555) 123-4567</p>
                </div>
            </li>
            <li>
                <div class="card">
                    <h3 class="name">Jane Smith</h3>
                    <p class="address">
                        456 Elm Street<br>
                        Los Angeles, California, 90001
                    </p>
                    <p class="phone">Phone: (555) 987-6543</p>
                </div>
            </li>
        </ul>
        <!-- Add Receiver -->
        <div class="modal fade" id="addReceiverModal" tabindex="-1" aria-labelledby="addReceiverModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addReceiverModalLabel">Adding Receiver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <!-- First Name -->
                                    <div class="forms-inputs col-lg-6">
                                        <label for="add-first-name">
                                            <h6 class="fw-bold">First Name</h6>
                                        </label>
                                        <input type="text" id="add-first-name" class="form-control" autocomplete="off">
                                        <span class="text-danger" id="error-add-first-name"></span>
                                    </div>
                                    <!-- Last Name -->
                                    <div class="forms-inputs col-lg-6 mt-3 mt-lg-0">
                                        <label for="add-last-name">
                                            <h6 class="fw-bold">Last Name</h6>
                                        </label>
                                        <input type="text" id="add-last-name" class="form-control" autocomplete="off">
                                        <span class="text-danger" id="error-add-last-name"></span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="forms-inputs col-lg-6">
                                        <label for="add-telephone">
                                            <h6 class="fw-bold">Telephone</h6>
                                        </label>
                                        <input type="text" id="add-telephone" class="form-control" autocomplete="off">
                                        <span class="text-danger" id="error-add-telephone"></span>
                                    </div>
                                    <div class="forms-inputs col-lg-6 mt-3 mt-lg-0">
                                        <label for="add-address">
                                            <h6 class="fw-bold">Street name, building, house number</h6>
                                        </label>
                                        <input type="text" id="add-address" class="form-control" autocomplete="off">
                                        <span class="text-danger" id="error-add-address"></span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-inputs col-lg-4">
                                        <label for="add-province">
                                            <h6 class="fw-bold">Choose Province</h6>
                                        </label>
                                        <select name='add-province' id="add-province" class='form-control'>
                                            <option value='0'>Please choose province</option>
                                        </select>
                                        <span class="text-danger" id="error-add-province"></span>
                                    </div>
                                    <div class="form-inputs col-lg-4 mt-3 mt-lg-0">
                                        <label for="add-district">
                                            <h6 class="fw-bold">Choose District</h6>
                                        </label>
                                        <select name='add-district' id="add-district" class='form-control'>
                                            <option value='0'>Please choose district</option>
                                        </select>
                                        <span class="text-danger" id="error-add-district"></span>
                                    </div>
                                    <div class="form-inputs col-lg-4 mt-3 mt-lg-0">
                                        <label for="add-commune">
                                            <h6 class="fw-bold">Choose Commune</h6>
                                        </label>
                                        <select name='add-commune' id="add-commune" class='form-control'>
                                            <option value='0'>Please choose commune</option>
                                        </select>
                                        <span class="text-danger" id="error-add-commune"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                id="btn-add-receiver">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/receiver.js') }}"></script>
@endsection
