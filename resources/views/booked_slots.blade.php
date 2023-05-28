@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>

    </style>
    <div class="container-xl big-padding">
        <div class="row section-title">
            <h2 class="fs-4">Booked Slots</h2>
        </div>
        <div class="row">
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert fade alert-simple alert-success alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show">
                    <i class="start-icon far fa-check-circle faa-tada animated"></i>
                    {{ \Illuminate\Support\Facades\Session::get('success') }}
                </div>
            @endif
        </div>

        <div class="text-white border-radius text-center mb-4 input-center shadow-md  p-4 pt-5 w-50">
            <div id="sandbox-container" style="margin-left: 30%;"><div></div></div>
            <div class="slots row text-black slots-list">

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(function(){
            var dateSelector = $('#sandbox-container div');
            dateSelector.datepicker('update', 'setDate', new Date()).on('changeDate', function(e) {
                getSlots();
           });

            function getSlots() {
                var selectedDate = new Date(dateSelector.datepicker('getDate')).toDateString();
                console.log(selectedDate);
                $.ajax({
                    type:'POST',
                    url:'{{route('booked-slots.get-slots')}}',
                    data:{
                        _token : "{{csrf_token()}}",
                        date : selectedDate,
                    },
                    json:true,
                    success:function(data) {
                        $('.slots-list').html('');
                        $.each(data.response, function( index, value ) {
                            $('.slots-list').append('<div class="col-lg-3 col-md-6 slot-item">'+value+'</div>');
                        });
                        $("#msg").html(data.msg);
                    }
                });
            }
            getSlots();

        });
    </script>
@endpush
