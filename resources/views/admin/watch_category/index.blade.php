@extends('layouts.admin')

@section('title')
    Watch Category
@endsection

@section('css')
    <style>
        .ui-autocomplete {
            z-index: 9999;
        }
    </style>
@endsection

@section('content')
    <main id="main" class="main">
        <div class="mt-4 mb-3">
            <div class="text-center lh-1 mb-2">
                <h2 class="fw-bold">Watch Category List</h2>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addWatchCategoryModal">
                    Add New Watch Category
                </button>
            </div>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Watch Model</th>
                    <th>Watch Category Name</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody id="watchCategoryList">
                @foreach ($watchCategories as $watchCategory)
                    <tr class="align-middle"
                        id="watchCategory_{{ $watchCategory->watch_id }}_{{ $watchCategory->category_id }}">
                        <td>{{ $watchCategory->watch_model }}</td>
                        <td>{{ $watchCategory->category_name }}</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                onclick="updateWatchCategory({{ $watchCategory->watch_id }}, {{ $watchCategory->category_id }})"
                                data-bs-target="#updateWatchCategoryModal">
                                Edit
                            </button>
                            <button class="btn btn-danger" type="button"
                                onclick="deleteWatchCategory({{ $watchCategory->watch_id }}, {{ $watchCategory->category_id }})">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Options</th>
                </tr>
            </tfoot>
        </table>
        {{-- Add Watch Category --}}
        <div class="modal fade" id="addWatchCategoryModal" tabindex="-1" aria-labelledby="addWatchCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addWatchCategoryModalLabel">Adding Watch Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    {{-- Watch Model --}}
                                    <div class="forms-inputs mt-3">
                                        <label for="search-input-add-watch-model">
                                            <h6 class="fw-bold">Search Watch Name</h6>
                                        </label>
                                        <div class="input-group">
                                            <input class="form-control border search-input-add-watch-model" type="search"
                                                id="search-input-add-watch-model">
                                            <span class="input-group-append">
                                                <button class="btn btn-outline-secondary bg-white border ms-1"
                                                    id="btn-search-add-watch-model" type="button">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-inputs mt-3">
                                        <label for="add-watch-id">
                                            <h6 class="fw-bold">Choose Watch</h6>
                                        </label>
                                        <select name='add-watch-id' id="add-watch-id" class='form-control'>
                                            <option value='0'>Please choose watch</option>
                                        </select>
                                        <span class="text-danger" id="error-add-watch-id"></span>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                </div>

                                <div class="col-md-5 mt-5 mt-md-0">
                                    {{-- Category Name --}}
                                    <div class="forms-inputs mt-3">
                                        <label for="search-input-add-category-name">
                                            <h6 class="fw-bold">Search Category Name</h6>
                                        </label>
                                        <div class="input-group">
                                            <input class="form-control border search-input-add-category-name" type="search"
                                                id="search-input-add-category-name">
                                            <span class="input-group-append">
                                                <button class="btn btn-outline-secondary bg-white border ms-1"
                                                    id="btn-search-add-category-name" type="button">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-inputs mt-3">
                                        <label for="add-category-id">
                                            <h6 class="fw-bold">Choose Category</h6>
                                        </label>
                                        <select name='add-category-id' id="add-category-id" class='form-control'>
                                            <option value='0'>Please choose band</option>
                                        </select>
                                        <span class="text-danger" id="error-add-category-id"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btn-add-watch-category">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Update Watch Category --}}
        <div class="modal fade" id="updateWatchCategoryModal" tabindex="-1" aria-labelledby="updateWatchCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="updateWatchCategoryModalLabel">Updating Watch Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    {{-- Watch Model --}}
                                    <div class="forms-inputs mt-3">
                                        <label for="search-input-update-watch-model">
                                            <h6 class="fw-bold">Search Watch Name</h6>
                                        </label>
                                        <div class="input-group">
                                            <input class="form-control border" type="search"
                                                id="search-input-update-watch-model">
                                            <span class="input-group-append">
                                                <button class="btn btn-outline-secondary bg-white border ms-1"
                                                    id="btn-search-update-watch-model" type="button">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-inputs mt-3">
                                        <label for="update-watch-id">
                                            <h6 class="fw-bold">Choose Watch</h6>
                                        </label>
                                        <select name='update-watch-id' id="update-watch-id" class='form-control'>
                                            <option value='0'>Please choose watch</option>
                                        </select>
                                        <span class="text-danger" id="error-update-watch-id"></span>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                </div>

                                <div class="col-md-5 mt-5 mt-md-0">
                                    {{-- Category Name --}}
                                    <div class="forms-inputs mt-3">
                                        <label for="search-input-update-category-name">
                                            <h6 class="fw-bold">Search Category Name</h6>
                                        </label>
                                        <div class="input-group">
                                            <input class="form-control border" type="search"
                                                id="search-input-update-category-name">
                                            <span class="input-group-append">
                                                <button class="btn btn-outline-secondary bg-white border ms-1"
                                                    id="btn-search-update-category-name" type="button">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-inputs mt-3">
                                        <label for="update-category-id">
                                            <h6 class="fw-bold">Choose Category</h6>
                                        </label>
                                        <select name='update-category-id' id="update-category-id" class='form-control'>
                                            <option value='0'>Please choose band</option>
                                        </select>
                                        <span class="text-danger" id="error-update-category-id"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btn-update-watch-category">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('js/watch_category.js') }}"></script>
@endsection
