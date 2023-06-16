@extends('layouts.admin')

@section('title')
    Collection
@endsection

@section('content')
    <main id="main" class="main">
        <div class="mt-4 mb-3">
            <div class="text-center lh-1 mb-2">
                <h2 class="fw-bold">Collection List</h2>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addCollectionModal">
                    Add New Collection
                </button>
            </div>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Release date</th>
                    <th>Brand</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody id="collectionList">
                @foreach ($collections as $collection)
                    <tr class="align-middle" id="collection_{{ $collection->id }}">
                        <td>{{ $collection->name }}</td>
                        <td>{{ $collection->release_date }}</td>
                        <td>{{ $collection->brand_name }}</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                onclick="updateCollection({{ $collection->id }})" data-bs-target="#updateCollectionModal">
                                Edit
                            </button>
                            <button class="btn btn-danger" type="button" onclick="deleteCollection({{ $collection->id }})">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Release date</th>
                    <th>Brand</th>
                    <th>Options</th>
                </tr>
            </tfoot>
        </table>
        {{-- Add Collection --}}
        <div class="modal fade" id="addCollectionModal" tabindex="-1" aria-labelledby="addCollectionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addCollectionModalLabel">Adding Collection</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                {{-- Name --}}
                                <div class="forms-inputs mt-3">
                                    <label for="add-collection-name">
                                        <h6 class="fw-bold">Collection Name</h6>
                                    </label>
                                    <input type="text" id="add-collection-name" class="form-control" autocomplete="off">
                                    <span class="text-danger" id="error-add-collection-name"></span>
                                </div>

                                {{-- Release Date --}}
                                <div class="forms-inputs mt-3">
                                    <label for="add-year-established">
                                        <h6 class="fw-bold">Release Date</h6>
                                    </label>
                                    <input type="date" id="add-release-date" class="form-control" autocomplete="off">
                                    <span class="text-danger" id="error-add-release-date"></span>
                                </div>

                                <div class="form-inputs mt-3">
                                    <label for="add-brand-id">
                                        <h6 class="fw-bold">Choose Brand</h6>
                                    </label>
                                    <select name='add-brand-id' id="add-brand-id" class='form-control'>
                                        <option value='0'>Please choose band</option>
                                    </select>
                                    <span class="text-danger" id="error-add-brand-id"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btn-add-collection">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Update Collection --}}
        <div class="modal fade" id="updateCollectionModal" tabindex="-1" aria-labelledby="updateCollectionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="updateCollectionModalLabel">Updating Collection</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                {{-- Name --}}
                                <div class="forms-inputs mt-3">
                                    <label for="update-collection-name">
                                        <h6 class="fw-bold">Collection Name</h6>
                                    </label>
                                    <input type="text" id="update-collection-name" class="form-control"
                                        autocomplete="off">
                                    <span class="text-danger" id="error-update-collection-name"></span>
                                </div>

                                {{-- Release Date --}}
                                <div class="forms-inputs mt-3">
                                    <label for="update-year-established">
                                        <h6 class="fw-bold">Release Date</h6>
                                    </label>
                                    <input type="date" id="update-release-date" class="form-control"
                                        autocomplete="off">
                                    <span class="text-danger" id="error-update-release-date"></span>
                                </div>

                                <div class="form-inputs mt-3">
                                    <label for="update-brand-id">
                                        <h6 class="fw-bold">Choose Brand</h6>
                                    </label>
                                    <select name='update-brand-id' id="update-brand-id" class='form-control'>
                                        <option value='0'>Please choose band</option>
                                    </select>
                                    <span class="text-danger" id="error-update-brand-id"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btn-update-collection">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('js/collection.js') }}"></script>
@endsection
