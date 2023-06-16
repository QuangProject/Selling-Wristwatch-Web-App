@extends('layouts.admin')

@section('title')
    Brand
@endsection

@section('content')
    <main id="main" class="main">
        <div class="mt-4 mb-3">
            <div class="text-center lh-1 mb-2">
                <h2 class="fw-bold">Brand List</h2>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                    Add New Brand
                </button>
            </div>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Country of origin</th>
                    <th>Year established</th>
                    <th>Image</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody id="brandList">
                @foreach ($brands as $brand)
                    <tr class="align-middle" id="brand_{{ $brand->id }}">
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->country_of_origin }}</td>
                        <td>{{ $brand->year_established }}</td>
                        <td>
                            <img src="{{ route('admin.brand.image', ['id' => $brand->id]) }}" id="image_{{ $brand->id }}"
                                alt="{{ $brand->name }}" width="100" class="my-3" loading="lazy">
                        </td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                onclick="updateBrand({{ $brand->id }})" data-bs-target="#updateBrandModal">
                                Edit
                            </button>
                            <button class="btn btn-danger" type="button" onclick="deleteBrand({{ $brand->id }})">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Country of origin</th>
                    <th>Year established</th>
                    <th>Image</th>
                    <th>Options</th>
                </tr>
            </tfoot>
        </table>
        {{-- Add Brand --}}
        <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addBrandModalLabel">Adding Brand</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                {{-- Name --}}
                                <div class="forms-inputs mt-3">
                                    <label for="add-brand-name">
                                        <h6 class="fw-bold">Brand Name</h6>
                                    </label>
                                    <input type="text" id="add-brand-name" class="form-control" autocomplete="off">
                                    <span class="text-danger" id="errorAddBrandName"></span>
                                </div>

                                {{-- Conuntry of origin --}}
                                <div class="forms-inputs mt-3">
                                    <label for="add-country-of-origin">
                                        <h6 class="fw-bold">Conuntry of origin</h6>
                                    </label>
                                    <input type="text" id="add-country-of-origin" class="form-control"
                                        autocomplete="off">
                                    <span class="text-danger" id="errorAddCountryOfOrigin"></span>
                                </div>

                                {{-- Year established --}}
                                <div class="forms-inputs mt-3">
                                    <label for="add-year-established">
                                        <h6 class="fw-bold">Year established</h6>
                                    </label>
                                    <input type="text" id="add-year-established" class="form-control" autocomplete="off">
                                    <span class="text-danger" id="errorAddYearEstablished"></span>
                                </div>

                                <div class="forms-inputs mt-3">
                                    <label for="add-brand-image">
                                        <h6 class="fw-bold">Brand Image</h6>
                                    </label>
                                    <input type="file" id="add-brand-image" class="form-control">
                                    <span class="text-danger" id="errorAddBrandImage"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="buttonAddBrand">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Update Brand --}}
        <div class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="updateBrandModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="updateBrandModalLabel">Updating Brand</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                {{-- Name --}}
                                <div class="forms-inputs mt-3">
                                    <label for="update-brand-name">
                                        <h6 class="fw-bold">Brand Name</h6>
                                    </label>
                                    <input type="text" id="update-brand-name" class="form-control"
                                        autocomplete="off">
                                    <span class="text-danger" id="errorUpdateBrandName"></span>
                                </div>

                                {{-- Conuntry of origin --}}
                                <div class="forms-inputs mt-3">
                                    <label for="update-country-of-origin">
                                        <h6 class="fw-bold">Conuntry of origin</h6>
                                    </label>
                                    <input type="text" id="update-country-of-origin" class="form-control"
                                        autocomplete="off">
                                    <span class="text-danger" id="errorUpdateCountryOfOrigin"></span>
                                </div>

                                {{-- Year established --}}
                                <div class="forms-inputs mt-3">
                                    <label for="update-year-established">
                                        <h6 class="fw-bold">Year established</h6>
                                    </label>
                                    <input type="text" id="update-year-established" class="form-control"
                                        autocomplete="off">
                                    <span class="text-danger" id="errorUpdateYearEstablished"></span>
                                </div>

                                <div class="forms-inputs mt-3">
                                    <label for="update-brand-image">
                                        <h6 class="fw-bold">Brand Image</h6>
                                    </label>
                                    <div>
                                        <img src="" id="display-image-update-brand" alt="brand's image"
                                            width="100" class="my-3">
                                    </div>
                                    <input type="file" id="update-brand-image" class="form-control">
                                    <span class="text-danger" id="errorUpdateBrandImage"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="buttonUpdateBrand">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('js/brand.js') }}"></script>
@endsection
