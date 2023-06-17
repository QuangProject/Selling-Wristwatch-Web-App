@extends('layouts.admin')

@section('title')
    Image
@endsection

@section('content')
    <main id="main" class="main">
        <div class="mt-4 mb-3">
            <div class="text-center lh-1 mb-2">
                <h2 class="fw-bold">Image List</h2>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addImageModal">
                    Add New Image
                </button>
            </div>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody id="imageList">
                @foreach ($images as $image)
                    <tr class="align-middle" id="image_{{ $image->id }}">
                        <td>{{ $image->name }}</td>
                        <td>{{ $image->stock }}</td>
                        <td>
                            <img src="{{ route('admin.watch.image.get', ['id' => $image->id]) }}"
                                id="displayImage_{{ $image->id }}" alt="{{ $image->name }}" width="100"
                                class="my-3" loading="lazy">
                        </td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                onclick="updateImage({{ $image->id }})" data-bs-target="#updateImageModal">
                                Edit
                            </button>
                            <button class="btn btn-danger" type="button" onclick="deleteImage({{ $image->id }})">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Options</th>
                </tr>
            </tfoot>
        </table>
        <div class="text-center">
            {{-- Back to watches --}}
            <a href="{{ route('admin.watch.index') }}" class="btn btn-secondary mt-3">Back to Watches</a>
        </div>
        {{-- Add Image --}}
        <div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addImageModalLabel">Adding Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                {{-- Name --}}
                                <div class="forms-inputs mt-3">
                                    <label for="add-image-name">
                                        <h6 class="fw-bold">Image Name</h6>
                                    </label>
                                    <input type="text" id="add-image-name" class="form-control" autocomplete="off">
                                    <span class="text-danger" id="error-add-image-name"></span>
                                </div>
                                {{-- Stock --}}
                                <div class="forms-inputs mt-3">
                                    <label for="add-image-stock">
                                        <h6 class="fw-bold">Image Stock</h6>
                                    </label>
                                    <input type="text" id="add-image-stock" class="form-control" autocomplete="off">
                                    <span class="text-danger" id="error-add-image-stock"></span>
                                </div>
                                {{-- Image --}}
                                <div class="forms-inputs mt-3">
                                    <label for="add-image">
                                        <h6 class="fw-bold">Choose Image</h6>
                                    </label>
                                    <input type="file" id="add-image" class="form-control">
                                    <span class="text-danger" id="error-add-image"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btn-add-image">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Update Image --}}
        <div class="modal fade" id="updateImageModal" tabindex="-1" aria-labelledby="updateImageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="updateImageModalLabel">Updating Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                {{-- Name --}}
                                <div class="forms-inputs mt-3">
                                    <label for="update-image-name">
                                        <h6 class="fw-bold">Image Name</h6>
                                    </label>
                                    <input type="text" id="update-image-name" class="form-control" autocomplete="off">
                                    <span class="text-danger" id="error-update-image-name"></span>
                                </div>
                                {{-- Stock --}}
                                <div class="forms-inputs mt-3">
                                    <label for="update-image-stock">
                                        <h6 class="fw-bold">Image Stock</h6>
                                    </label>
                                    <input type="text" id="update-image-stock" class="form-control" autocomplete="off">
                                    <span class="text-danger" id="error-update-image-stock"></span>
                                </div>
                                {{-- Image --}}
                                <div class="forms-inputs mt-3">
                                    <label for="update-image">
                                        <h6 class="fw-bold">Choose Image</h6>
                                    </label>
                                    <div>
                                        <img src="" id="display-image-update" alt="" width="100"
                                            class="my-3">
                                    </div>
                                    <input type="file" id="update-image" class="form-control">
                                    <span class="text-danger" id="error-update-image"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btn-update-image">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('js/image.js') }}"></script>
@endsection
