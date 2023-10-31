@extends('layouts.master')

@section('title') @lang('translation.Inbox') @endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @component('components.breadcrumb')
        @slot('li_1') Ticket @endslot
        @slot('title') Ticket Inbox @endslot
    @endcomponent


    <div class="row">
        <form action="{{ route('ticket.sendticket') }}" method="post">
            @csrf
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-size-16" id="composemodalTitle">New Message</h5>
                    
                </div>
                <div class="modal-body">
                    <div>
                       
                        <select name="search" id="search" required class="form-control"></select>            

                        <div class="mb-3">
                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                        </div>
                        <div class="mb-3 email-editor">
                            <textarea id="email-editor" name="message"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('ticket.index')}}" type="button" class="btn btn-secondary" >Close</a>
                    <button type="submit" class="btn btn-primary">Send <i class="fab fa-telegram-plane ms-1"></i></button>
                </div>
                
            </div>
        </div>
        </form>

    </div><!-- End row -->

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $("#search").select2({
            placeholder: '-- select sitename --',
            ajax: {
                url: "{{ route('sitename.getsitename') }}",
                type: "GET",
                dataType: 'JSON',
                delay: 250,
                data: function(params) {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    </script>
@endsection

@section('script')

    <!--ckeditor js-->
    <script src="{{ URL::asset('build/libs/@ckeditor/@ckeditor.min.js') }}"></script>

    <!-- email editor init -->
    <script src="{{ URL::asset('build/js/pages/email-editor.init.js') }}"></script>


@endsection
