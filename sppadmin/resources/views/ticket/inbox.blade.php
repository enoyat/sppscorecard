@extends('layouts.master')

@section('title') @lang('translation.Inbox') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Ticket @endslot
        @slot('title') Ticket Inbox @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <!-- Left sidebar -->
            <div class="email-leftbar card">
                <div class="mail-list mt-4">
                    @if(Auth::user()->roles_id == "4" || Auth::user()->roles_id == "5")
                    <button type="button" class="btn btn-primary waves-light " data-bs-toggle="modal"
                    data-bs-target="#composemodal">
                    + Request
                    @endif
                </button>
                    <a href="#" class="active"><i class="fas fa-eye" style="color:chartreuse"></i> Open</a>
                    <a href="#"><i class="fas fa-eye-slash" style="color:rgb(121, 121, 121)"></i> Closed</a>
                </div>

            </div>
            <!-- End Left sidebar -->


            <!-- Right Sidebar -->
            <div class="email-rightbar mb-3">

                <div class="card">
                    <div class="btn-toolbar p-3" role="toolbar">
                        <div class="btn-group me-2 mb-2 mb-sm-0">
                            Ticket Information

                        </div>



                    </div>
                    <ul class="message-list">
                        @php $i=1; @endphp
                        @foreach ($tickets as $key)
                        <li>

                            <div class="col-mail col-mail-1">
                                #{{ $key->id }}
                                <a href="{{ route('ticket.read',$key->id)}}" class="title">{{ $key->getuser->name }}</a>
                                @if ($key->status == "close")
                                <i class="fas fa-eye-slash" style="color:rgb(121, 121, 121)"></i>
                                @else
                                <i class="fas fa-eye" style="color:chartreuse"></i>
                                @endif

                            </div>
                            <div class="col-mail col-mail-2">
                                <a href="#" class="subject"><span class="teaser">{{ $key->subject }}</span>
                                </a>
                                <div class="date">{{ date_format($key->created_at,"d M Y"); }}</div>
                            </div>
                        </li>
                        <?php $i++; ?>
                        @endforeach
                    </ul>


                </div> <!-- card -->

                <div class="row">
                    <div class="col-7">
                        Showing 1 - 20 of 1,524
                    </div>
                    <div class="col-5">
                        <div class="btn-group float-end">
                            <button type="button" class="btn btn-sm btn-success waves-effect"><i
                                    class="fa fa-chevron-left"></i></button>
                            <button type="button" class="btn btn-sm btn-success waves-effect"><i
                                    class="fa fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
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

                        <div class="mb-3">
                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                        </div>
                        <div class="mb-3 email-editor">
                            <textarea id="email-editor" name="message"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send <i class="fab fa-telegram-plane ms-1"></i></button>
                </div>
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
