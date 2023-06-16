@extends('layouts.admin')

@section('title')
    Category
@endsection

@section('content')
    <main id="main" class="main">
        <div class="mt-4 mb-3">
            <div class="text-center lh-1 mb-2">
                <h2 class="fw-bold">Category List</h2>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    Add New Category
                </button>
            </div>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th width="60%">Name</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody id="categoryList">
                @foreach ($categories as $category)
                    <tr class="align-middle" id="category_{{ $category->id }}">
                        <td>{{ $category->name }}</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                onclick="updateCategory({{ $category->id }})" data-bs-target="#updateCategoryModal">
                                Edit
                            </button>
                            <button class="btn btn-danger" type="button" onclick="deleteCategory({{ $category->id }})">
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
        {{-- Add Category --}}
        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addCategoryModalLabel">Adding Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                {{-- Name --}}
                                <div class="forms-inputs mt-3">
                                    <label for="add-category-name">
                                        <h6 class="fw-bold">Category Name</h6>
                                    </label>
                                    <input type="text" id="add-category-name" class="form-control" autocomplete="off">
                                    <span class="text-danger" id="errorAddCategoryName"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="buttonAddCategory">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Update Category --}}
        <div class="modal fade" id="updateCategoryModal" tabindex="-1" aria-labelledby="updateCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="updateCategoryModalLabel">Updating Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                {{-- Name --}}
                                <div class="forms-inputs mt-3">
                                    <label for="update-category-name">
                                        <h6 class="fw-bold">Category Name</h6>
                                    </label>
                                    <input type="text" id="update-category-name" class="form-control" autocomplete="off">
                                    <span class="text-danger" id="errorUpdateCategoryName"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="buttonUpdateCategory">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('js/category.js') }}"></script>
@endsection
