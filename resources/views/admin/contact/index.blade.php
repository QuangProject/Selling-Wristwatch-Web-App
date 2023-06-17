@extends('layouts.admin')

@section('title')
    Contact
@endsection

@section('content')
    <main id="main" class="main">
        <div class="mt-4 mb-3">
            <div class="text-center lh-1 mb-2">
                <h2 class="fw-bold">Contact List</h2>
            </div>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody id="contactList">
                @foreach ($contacts as $contact)
                    <tr class="align-middle" id="contact_{{ $contact->id }}">
                        <td>{{ $contact->full_name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->subject }}</td>
                        <td>{{ $contact->message }}</td>
                        @if ($contact->reply == null)
                            <td class="text-danger">No reply yet</td>
                        @else
                            <td class="fw-bold text-success">Replied</td>
                        @endif
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                onclick="updateContact({{ $contact->id }})" data-bs-target="#updateContactModal">
                                Edit
                            </button>
                            <button class="btn btn-danger" type="button" onclick="deleteContact({{ $contact->id }})">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
            </tfoot>
        </table>
        {{-- Reply Contact --}}
        <div class="modal fade" id="updateContactModal" tabindex="-1" aria-labelledby="updateContactModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="updateContactModalLabel">Updating Contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                {{-- Full Name --}}
                                <div class="forms-inputs mt-3">
                                    <label for="display-full-name">
                                        <h6 class="fw-bold">Full Name</h6>
                                    </label>
                                    <input type="text" id="display-full-name" readonly class="form-control">
                                </div>

                                {{-- Email --}}
                                <div class="forms-inputs mt-3">
                                    <label for="display-email">
                                        <h6 class="fw-bold">Email</h6>
                                    </label>
                                    <input type="text" id="display-email" readonly class="form-control">
                                </div>

                                {{-- Subject --}}
                                <div class="forms-inputs mt-3">
                                    <label for="display-subject">
                                        <h6 class="fw-bold">Subject</h6>
                                    </label>
                                    <input type="text" id="display-subject" readonly class="form-control">
                                </div>

                                {{-- Message --}}
                                <div class="forms-inputs mt-3">
                                    <label for="display-message">
                                        <h6 class="fw-bold">Message</h6>
                                    </label>
                                    <textarea id="display-message" class="form-control" readonly rows="5"></textarea>
                                </div>

                                {{-- Reply --}}
                                <div class="forms-inputs mt-3">
                                    <label for="reply-contact">
                                        <h6 class="fw-bold">Reply</h6>
                                    </label>
                                    <textarea id="reply-contact" class="form-control" rows="5"></textarea>
                                    <span class="text-danger" id="error-reply-contact"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btn-reply-contact">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('js/manage_contact.js') }}"></script>
@endsection
