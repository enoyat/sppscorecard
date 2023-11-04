@extends('layouts.master')

@section('title') @lang('translation.Inbox') @endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @component('components.breadcrumb')
    @slot('li_1') TICKET @endslot
    @slot('title') TICKET INBOX @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">

            <!-- Left sidebar -->
            <div class="email-leftbar card">
               
                    @if(Auth::user()->roles_id == "4" || Auth::user()->roles_id == "5")
                    <a href="{{ route('ticket.create')}}" class="btn btn-sm btn-primary" >
                    + Request
                    </a>
                    @endif
                </button>

                

            </div>
            <!-- End Left sidebar -->


            <!-- Right Sidebar -->
            <div class="email-rightbar mb-3">

                <div class="card">
                    <div class="btn-toolbar p-3" role="toolbar">
                        <div class="btn-group me-2 mb-2 mb-sm-0">
                            TICKET INFORMATION

                        </div>



                    </div>
                    <table class="table table-hover table-strip">
                        <thead>
                            <tr>
                                <Th>TICKET NUMBER - STATUS</TH>
                                    <TH>REQUESTER</TH>
                                    <TH>SUBJECT</TH>
                                    <TH>DATE CREATED</TH>
                                    <TH>DUE DATE</TH>
                                    <TH>ACTUAL DATE</TH>
                                    <TH>SITE NAME</TH>    
                            </tr>
                        </thead>
                    <ul class="message-list">
                        @php $i=1; @endphp
                        @foreach ($tickets as $key)
                        <tr>

                            <td>
                                #{{ $key->id }} - 
                                @if ($key->status == "close")
                                closed
                                @else
                                 <span style="color:rgb(108, 211, 5)">open</span>
                                @endif
                               
                            </td>
                            <td>
                                <a href="{{ route('ticket.read',$key->id)}}" class="title">{{ $key->getuser->name }}</a>
                            </td>
                            
                            <td>
                                <a href="#" class="subject"><span class="teaser">{{ $key->subject }}</span>
                                </a>
                            </td>
                            <td>
                               
                                <div class="date">{{ date_format($key->created_at,"d-m-Y"); }}</div>
                            </td>
                            <td>
                               @if($key->duedate != null)
                                <div class="date">{{ date("d-m-Y", strtotime($key->duedate)); }}</div>
                                @endif
                            </td>
                            <td>
                                @if($key->actualdate != null)
                                 <div class="date">{{ date("d-m-Y", strtotime($key->actualdate)); }}</div>
                                 @endif
                             </td>
                            <td>
                                <div >{{ $key->getsitename->namasitename }}</div>
                            </td>

                        </tr>
                        <?php $i++; ?>
                        @endforeach
                    </table>


                </div> <!-- card -->

              
            </div> <!-- end Col-9 -->

        </div>

    </div><!-- End row -->

    <!-- End Page-content -->

    <!-- Modal -->
    <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle"
        aria-hidden="true">
        <form action="{{ route('ticket.sendticket') }}" method="post">
            @csrf
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-size-16" id="composemodalTitle">New Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                       
                        <select name="search" id="search" required class="form-control" ></select>            

                        <div class="mb-3">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="mb-3 email-editor">
                            <textarea id="email-editor" name="message" required></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send <i class="fab fa-telegram-plane ms-1"></i></button>
                </div>
                <script>
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $("#search").select2({
                        placeholder: '-- select unit --',
                        ajax: {
                            url: "{{ route('unit.getunit') }}",
                            type: "GET",
                            dataType: 'JSON',
                            delay: 250,
                            data: function(params) {
                                return {
                                    _token: CSRF_TOKEN,
                                    search: params.term,
                                    idsitename: $("#idsitename").val(),
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
            </div>
        </div>
        </form>
    </div>
    <!-- end modal -->
    <!-- end modal -->
    
@endsection

@section('script')

    <!--ckeditor js-->
    <script src="{{ URL::asset('build/libs/@ckeditor/@ckeditor.min.js') }}"></script>

    <!-- email editor init -->
    <script src="{{ URL::asset('build/js/pages/email-editor.init.js') }}"></script>


@endsection
