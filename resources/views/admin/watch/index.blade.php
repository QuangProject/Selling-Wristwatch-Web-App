@extends('layouts.admin')

@section('title')
    Watch
@endsection

@section('content')
    <main id="main" class="main">
        <div class="mt-4 mb-3">
            <div class="text-center lh-1 mb-2">
                <h2 class="fw-bold">Watch List</h2>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addWatchModal">
                    Add New Watch
                </button>
            </div>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Model</th>
                    <th>Original Price</th>
                    <th>Selling Price</th>
                    <th>Discount</th>
                    <th>Stock</th>
                    <th>Gender</th>
                    <th>Case Material</th>
                    <th>Case Diameter</th>
                    <th>Case Thickness</th>
                    <th>Strap Material</th>
                    <th>Dial Color</th>
                    <th>Crystal Material</th>
                    <th>Water Resistance</th>
                    <th>Movement Type</th>
                    <th>Power Reserve</th>
                    <th>Complications</th>
                    <th>Collection</th>
                    <th>Availability</th>
                    <th>Image</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody id="watchList">
                @foreach ($watches as $watch)
                    <tr class="align-middle" id="watch_{{ $watch->id }}">
                        <td>{{ $watch->model }}</td>
                        <td>${{ $watch->original_price }}</td>
                        <td>${{ $watch->selling_price }}</td>
                        <td>{{ $watch->discount }}</td>
                        <td>{{ $watch->stock }}</td>
                        <td>{{ $watch->gender }}</td>
                        <td>{{ $watch->case_material }}</td>
                        <td>{{ $watch->case_diameter }}mm</td>
                        <td>{{ $watch->case_thickness }}mm</td>
                        <td>{{ $watch->strap_material }}</td>
                        <td>{{ $watch->dial_color }}</td>
                        <td>{{ $watch->crystal_material }}</td>
                        <td>{{ $watch->water_resistance }}m</td>
                        <td>{{ $watch->movement_type }}</td>
                        <td>{{ $watch->power_reserve }} hours</td>
                        <td>{{ $watch->complications }}</td>
                        <td>{{ $watch->collection_name }}</td>
                        @if ($watch->availability == 1)
                            <td>Still In Business</td>
                        @else
                            <td>Business Suspension</td>
                        @endif
                        <td>
                            <a href="{{ route('admin.watch.image', ['id' => $watch->id]) }}">View</a>
                        </td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                onclick="updateWatch({{ $watch->id }})" data-bs-target="#updateWatchModal">
                                Edit
                            </button>
                            <button class="btn btn-danger mt-2" type="button" onclick="deleteWatch({{ $watch->id }})">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Model</th>
                    <th>Original Price</th>
                    <th>Selling Price</th>
                    <th>Discount</th>
                    <th>Stock</th>
                    <th>Gender</th>
                    <th>Case Material</th>
                    <th>Case Diameter</th>
                    <th>Case Thickness</th>
                    <th>Strap Material</th>
                    <th>Dial Color</th>
                    <th>Crystal Material</th>
                    <th>Water Resistance</th>
                    <th>Movement Type</th>
                    <th>Power Reserve</th>
                    <th>Complications</th>
                    <th>Collection</th>
                    <th>Availability</th>
                    <th>Image</th>
                    <th>Options</th>
                </tr>
            </tfoot>
        </table>
        {{-- Add Watch --}}
        <div class="modal fade" id="addWatchModal" tabindex="-1" aria-labelledby="addWatchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addWatchModalLabel">Adding Watch</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        {{-- Model --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-model">
                                                <h6 class="fw-bold">Watch Model</h6>
                                            </label>
                                            <input type="text" id="add-watch-model" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-model"></span>
                                        </div>
                                        {{-- Choose Collection --}}
                                        <div class="form-inputs mt-3">
                                            <label for="add-watch-collection">
                                                <h6 class="fw-bold">Choose Collection</h6>
                                            </label>
                                            <select name='add-watch-collection' id="add-watch-collection"
                                                class='form-control'>
                                                <option value='0'>Please choose collection</option>
                                            </select>
                                            <span class="text-danger" id="error-add-watch-collection"></span>
                                        </div>
                                        {{-- Original Price --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-original-price">
                                                <h6 class="fw-bold">Original Price</h6>
                                            </label>
                                            <input type="text" id="add-watch-original-price" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-original-price"></span>
                                        </div>
                                        {{-- Selling Price --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-selling-price">
                                                <h6 class="fw-bold">Selling Price</h6>
                                            </label>
                                            <input type="text" id="add-watch-selling-price" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-selling-price"></span>
                                        </div>
                                        {{-- Discount --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-discount">
                                                <h6 class="fw-bold">Discount</h6>
                                            </label>
                                            <input type="text" id="add-watch-discount" class="form-control"
                                                value="0" autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-discount"></span>
                                        </div>
                                        {{-- Stock --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-stock">
                                                <h6 class="fw-bold">Stock</h6>
                                            </label>
                                            <input type="text" id="add-watch-stock" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-stock"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        {{-- Gender --}}
                                        <div class="form-inputs mt-3">
                                            <label for="add-watch-gender">
                                                <h6 class="fw-bold">Gender</h6>
                                            </label>
                                            <div class="d-lg-flex" style="margin-top: 13px">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="add-watch-gender" id="MaleGender" value="Men">
                                                    <label class="form-check-label" for="MaleGender">Men</label>
                                                </div>

                                                <div class="form-check mx-lg-2 mx-xl-5">
                                                    <input class="form-check-input" type="radio"
                                                        name="add-watch-gender" id="FemaleGender" value="Women">
                                                    <label class="form-check-label" for="FemaleGender">Women</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="add-watch-gender" id="BothGender" value="Unisex">
                                                    <label class="form-check-label" for="BothGender">Unisex</label>
                                                </div>
                                            </div>
                                            <span class="text-danger" id="error-add-watch-gender"></span>
                                        </div>
                                        {{-- Case Material --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-case-material">
                                                <h6 class="fw-bold">Case Material</h6>
                                            </label>
                                            <input type="text" id="add-watch-case-material" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-case-material"></span>
                                        </div>
                                        {{-- Case Diameter --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-case-diameter">
                                                <h6 class="fw-bold">Case Diameter</h6>
                                            </label>
                                            <input type="text" id="add-watch-case-diameter" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-case-diameter"></span>
                                        </div>
                                        {{-- Case Thickness --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-case-thickness">
                                                <h6 class="fw-bold">Case Thickness</h6>
                                            </label>
                                            <input type="text" id="add-watch-case-thickness" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-case-thickness"></span>
                                        </div>
                                        {{-- Strap Material --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-strap-material">
                                                <h6 class="fw-bold">Strap Material</h6>
                                            </label>
                                            <input type="text" id="add-watch-strap-material" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-strap-material"></span>
                                        </div>
                                        {{-- Dial Color --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-dial-color">
                                                <h6 class="fw-bold">Dial Color</h6>
                                            </label>
                                            <input type="text" id="add-watch-dial-color" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-dial-color"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        {{-- Crystal Material --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-crystal-material">
                                                <h6 class="fw-bold">Crystal Material</h6>
                                            </label>
                                            <input type="text" id="add-watch-crystal-material" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-crystal-material"></span>
                                        </div>
                                        {{-- Water Resistance --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-water-resistance">
                                                <h6 class="fw-bold">Water Resistance</h6>
                                            </label>
                                            <input type="text" id="add-watch-water-resistance" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-water-resistance"></span>
                                        </div>
                                        {{-- Movement Type --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-movement-type">
                                                <h6 class="fw-bold">Movement Type</h6>
                                            </label>
                                            <select name='add-watch-movement-type' id="add-watch-movement-type"
                                                class='form-control'>
                                                <option value='0'>Please choose movement type</option>
                                                <option value='Quartz'>Quartz</option>
                                                <option value='Automatic'>Automatic</option>
                                                <option value='Mechanical'>Mechanical</option>
                                            </select>
                                            <span class="text-danger" id="error-add-watch-movement-type"></span>
                                        </div>
                                        {{-- Power Reserve --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-power-reserve">
                                                <h6 class="fw-bold">Power Reserve</h6>
                                            </label>
                                            <input type="text" id="add-watch-power-reserve" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-power-reserve"></span>
                                        </div>
                                        {{-- Complications --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="add-watch-complications">
                                                <h6 class="fw-bold">Complications</h6>
                                            </label>
                                            <input type="text" id="add-watch-complications" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-add-watch-complications"></span>
                                        </div>
                                        {{-- Availability --}}
                                        <div class="form-inputs mt-3">
                                            <label for="add-watch-availability">
                                                <h6 class="fw-bold">Status</h6>
                                            </label>
                                            <div class="d-lg-flex justify-content-lg-between" style="margin-top: 13px">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="add-watch-availability" id="OnSaleStatus" value="1"
                                                        checked>
                                                    <label class="form-check-label" for="OnSaleStatus">Still In
                                                        Business</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="add-watch-availability" id="BusinessSuspensionStatus"
                                                        value="0">
                                                    <label class="form-check-label"
                                                        for="BusinessSuspensionStatus">Business
                                                        Suspension</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                id="button-add-watch">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Update Watch --}}
        <div class="modal fade" id="updateWatchModal" tabindex="-1" aria-labelledby="updateWatchModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="updateWatchModalLabel">Updating Watch</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        {{-- Model --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-model">
                                                <h6 class="fw-bold">Watch Model</h6>
                                            </label>
                                            <input type="text" id="update-watch-model" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-model"></span>
                                        </div>
                                        {{-- Choose Collection --}}
                                        <div class="form-inputs mt-3">
                                            <label for="update-watch-collection">
                                                <h6 class="fw-bold">Choose Collection</h6>
                                            </label>
                                            <select name='update-watch-collection' id="update-watch-collection"
                                                class='form-control'>
                                                <option value='0'>Please choose collection</option>
                                            </select>
                                            <span class="text-danger" id="error-update-watch-collection"></span>
                                        </div>
                                        {{-- Original Price --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-original-price">
                                                <h6 class="fw-bold">Original Price</h6>
                                            </label>
                                            <input type="text" id="update-watch-original-price" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-original-price"></span>
                                        </div>
                                        {{-- Selling Price --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-selling-price">
                                                <h6 class="fw-bold">Selling Price</h6>
                                            </label>
                                            <input type="text" id="update-watch-selling-price" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-selling-price"></span>
                                        </div>
                                        {{-- Discount --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-discount">
                                                <h6 class="fw-bold">Discount</h6>
                                            </label>
                                            <input type="text" id="update-watch-discount" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-discount"></span>
                                        </div>
                                        {{-- Stock --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-stock">
                                                <h6 class="fw-bold">Stock</h6>
                                            </label>
                                            <input type="text" id="update-watch-stock" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-stock"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        {{-- Gender --}}
                                        <div class="form-inputs mt-3">
                                            <label for="update-watch-gender">
                                                <h6 class="fw-bold">Gender</h6>
                                            </label>
                                            <div class="d-lg-flex mt-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="update-watch-gender" id="MaleGender" value="Men">
                                                    <label class="form-check-label" for="MaleGender">Men</label>
                                                </div>

                                                <div class="form-check mx-lg-5">
                                                    <input class="form-check-input" type="radio"
                                                        name="update-watch-gender" id="FemaleGender" value="Women">
                                                    <label class="form-check-label" for="FemaleGender">Women</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="update-watch-gender" id="BothGender" value="Unisex">
                                                    <label class="form-check-label" for="BothGender">Unisex</label>
                                                </div>
                                            </div>
                                            <span class="text-danger" id="error-update-watch-gender"></span>
                                        </div>
                                        {{-- Case Material --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-case-material">
                                                <h6 class="fw-bold">Case Material</h6>
                                            </label>
                                            <input type="text" id="update-watch-case-material" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-case-material"></span>
                                        </div>
                                        {{-- Case Diameter --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-case-diameter">
                                                <h6 class="fw-bold">Case Diameter</h6>
                                            </label>
                                            <input type="text" id="update-watch-case-diameter" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-case-diameter"></span>
                                        </div>
                                        {{-- Case Thickness --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-case-thickness">
                                                <h6 class="fw-bold">Case Thickness</h6>
                                            </label>
                                            <input type="text" id="update-watch-case-thickness" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-case-thickness"></span>
                                        </div>
                                        {{-- Strap Material --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-strap-material">
                                                <h6 class="fw-bold">Strap Material</h6>
                                            </label>
                                            <input type="text" id="update-watch-strap-material" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-strap-material"></span>
                                        </div>
                                        {{-- Dial Color --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-dial-color">
                                                <h6 class="fw-bold">Dial Color</h6>
                                            </label>
                                            <input type="text" id="update-watch-dial-color" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-dial-color"></span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        {{-- Crystal Material --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-crystal-material">
                                                <h6 class="fw-bold">Crystal Material</h6>
                                            </label>
                                            <input type="text" id="update-watch-crystal-material" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-crystal-material"></span>
                                        </div>
                                        {{-- Water Resistance --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-water-resistance">
                                                <h6 class="fw-bold">Water Resistance</h6>
                                            </label>
                                            <input type="text" id="update-watch-water-resistance" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-water-resistance"></span>
                                        </div>
                                        {{-- Movement Type --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-movement-type">
                                                <h6 class="fw-bold">Movement Type</h6>
                                            </label>
                                            <select name='update-watch-movement-type' id="update-watch-movement-type"
                                                class='form-control'>
                                                <option value='0'>Please choose movement type</option>
                                                <option value='Quartz'>Quartz</option>
                                                <option value='Automatic'>Automatic</option>
                                                <option value='Mechanical'>Mechanical</option>
                                            </select>
                                            <span class="text-danger" id="error-update-watch-movement-type"></span>
                                        </div>
                                        {{-- Power Reserve --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-power-reserve">
                                                <h6 class="fw-bold">Power Reserve</h6>
                                            </label>
                                            <input type="text" id="update-watch-power-reserve" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-power-reserve"></span>
                                        </div>
                                        {{-- Complications --}}
                                        <div class="forms-inputs mt-3">
                                            <label for="update-watch-complications">
                                                <h6 class="fw-bold">Complications</h6>
                                            </label>
                                            <input type="text" id="update-watch-complications" class="form-control"
                                                autocomplete="off">
                                            <span class="text-danger" id="error-update-watch-complications"></span>
                                        </div>
                                        {{-- Availability --}}
                                        <div class="form-inputs mt-3">
                                            <label for="update-watch-availability">
                                                <h6 class="fw-bold">Status</h6>
                                            </label>
                                            <div class="d-lg-flex mt-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="update-watch-availability" id="OnSaleStatus"
                                                        value="1">
                                                    <label class="form-check-label" for="OnSaleStatus">Still In
                                                        Business</label>
                                                </div>

                                                <div class="form-check mx-lg-5">
                                                    <input class="form-check-input" type="radio"
                                                        name="update-watch-availability" id="BusinessSuspensionStatus"
                                                        value="0">
                                                    <label class="form-check-label"
                                                        for="BusinessSuspensionStatus">Business
                                                        Suspension</label>
                                                </div>
                                            </div>
                                            <span class="text-danger" id="error-update-watch-availability"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="button-update-watch">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('js/watch.js') }}"></script>
@endsection
