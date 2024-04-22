@extends('template.master-dashboard-administrator')
@section('contents')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List ticket - User: {{ $customer->getusers->name }}</h1>
                </div>
            </div>
        </div>

    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <form action="{{ route('ticket.sendticket') }}" method="POST">
                        @csrf
                        <input type="hidden" name="userid" value="{{ $customer->id }}">
                        <input type="text" name="message" placeholder="Type your message here" required>

                        <button type="submit" class="btn btn-primary">Send</button> <a href="{{ route('ticket.index') }}">
                            <div id="viewData" class="btn btn-info">Kembali</div>
                            <a href="{{ route('ticket.clearticket', $customer->id ) }}"  class="btn btn-danger">Hapus ticket</a>
                        </a>
                    </form>


                    <br>
                    <br>
                    <div id="ticket">
                       @include('ticket.ticket')
                    </div>
                    <br>
                    <br>
                </div>

            </div>
        </div>
    </section>
</div>
<script>
$(function() {
    $('#mydata').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false
    })
})
$('.btn-action').click(function() {
    var id = $(this).closest('tr').find('#kode').text();
    event.preventDefault();
    $.ajax({
        url: "{{ route('ticket.read') }}",
        type: "POST",
        data: {
            'id': id,
            '_token': $('input[name=_token]').val()
        },
        success: function(response) {
            location.reload();
        },

    });
});
var ticket = setInterval(function() {
    $('#ticket').load("{{ route('ticket.inticket', $customer->id) }}").fadeIn("slow");
}, 10000);
</script>
@endsection
