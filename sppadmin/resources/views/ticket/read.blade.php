@extends('layouts.master')

@section('title') @lang('translation.Inbox') @endsection

@section('content')
<div class="card">


    <div class="card-body">
        <a href="{{ route('ticket.index') }}" class="btn btn-primary waves-effect mt-4"><i class="mdi mdi-arrow-left me-1"></i> Back</a>
        @if (Auth::user()->roles_id == "1" || Auth::user()->roles_id == "2" || Auth::user()->roles_id == "4")
        <button type="button" class="btn btn-secondary waves-effect mt-4" data-bs-toggle="modal"
                data-bs-target="#composemodal">
                <i class="mdi mdi-reply me-1"></i> Reply
            </button>
        @endif
           <hr>
        <div class="d-flex align-items-center mb-4">
            <div class="flex-shrink-0 me-3">
                <img class="rounded-circle avatar-sm" src="{{ asset('build/images/users/avatar-2.jpg') }}"
                    alt="Generic placeholder image">
            </div>
            <div class="flex-grow-1">
                <h5 class="font-size-14 mb-0">{{ $mainticket->getuser->name }}</h5>
                <small class="text-muted">{{ $mainticket->getuser->email }}</small>
                <small >                               
                    <div class="date">{{ date("d-m-Y  h:m", strtotime($mainticket->created_at)); }}</div>
                    </small>
            </div>
        </div>

        <h4 class="font-size-16">{{ $mainticket->subject }}</h4>

        {!! $mainticket->message !!}
        <hr />
        @foreach ($tickets as $item)

        <div class="d-flex align-items-center mb-4">

            <div class="flex-grow-1">
                <h5 class="font-size-14 mb-0">{{ $item->getuser->name }}</h5>
                <small class="text-muted">{{ $item->getuser->email }}</small>
                <small >                               
                    <div class="date">{{ date("d-m-Y h:m", strtotime($item->created_at)); }}</div>
                    </small>
            </div>


        </div>
        <h4 class="font-size-16">{{ $item->subject }}</h4>
        {!! $item->message !!}
        <hr />
        @endforeach
        @if(Auth::user()->roles_id == "1" || Auth::user()->roles_id == "2")
        <form action="{{ route('ticket.close')}}" method="post">
            @csrf

            <input type="hidden" name="id" value="{{ $mainticket->id }}">
            <button type="submit" class="btn btn-danger waves-effect mt-4"><i class="far fa-window-close" ></i> Close Ticket</button>
        </form>
        @endif
    </div>

</div>
 <!-- Modal -->
 <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle"
 aria-hidden="true">
 <form action="{{ route('ticket.replyticket') }}" method="post">
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
                    <input type="hidden" name="parentid" value="{{ $mainticket->id }}" >
                     <input type="text" name="subject" class="form-control" placeholder="Subject">
                 </div>
                 <div class="mb-3 email-editor">
                     <textarea id="email-editor" name="message"></textarea>
                 </div>
                 @if (Auth::user()->roles_id == "1" || Auth::user()->roles_id == "2")
                 <div class="mb-3 email-editor">
                    <input type="date" name="duedate" class="form-control" placeholder="due date" required>
                </div>
                <div class="mb-3 email-editor">
                    <input type="date" name="actualdate" class="form-control" placeholder="actual date" required>
                </div>
                    @endif
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
@endsection
@section('script')

    <!--ckeditor js-->
    <script src="{{ URL::asset('build/libs/@ckeditor/@ckeditor.min.js') }}"></script>

    <!-- email editor init -->
    <script src="{{ URL::asset('build/js/pages/email-editor.init.js') }}"></script>


@endsection
