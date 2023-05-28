@extends('layouts.app')

@section('content')
    <style>
        body {
            background: #EFEFEF;
            padding: 20px;
        }
        h1 {
            font-weight: bold;
        }
        .ui-timepicker-container .ui-timepicker-no-scrollbar .ui-timepicker-standard{
            top:1px !important;
        }
    </style>
    <div class="container-xl big-padding">
        <x-status-message />
        <div class="row section-title">
            <h2 class="fs-4">Available Slots</h2>
        </div>


        <div class="text-white border-radius text-center mb-4 input-center shadow-md bg-dark-grey p-4 pt-5 w-50">
            <div class="row mb-3">
                <div class="col-lg-2 col-md-6">
                    <label class="text-grey"></label>
                </div>
                <div class="col-lg-5 col-md-6">
                    <label class="text-grey w-75">FROM</label>
                </div>
                <div class="col-lg-5 col-md-6">
                    <label class="text-grey w-75">TO</label>
                </div>
            </div>
            <form action="{{route('available-slot.store')}}" method="POST" id="AvailableSlotForm">
                @csrf

                @foreach(\App\Models\Slot::$DAYS as $key => $item)
                    <div class="row mb-3 timepicker-group timepicker-key-{{$key}}">
                        <div class="col-lg-2 col-md-6">
                            <label class="text-black">{{$item}}</label>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <input type="text" autocomplete="off" class="input-center timepicker1 form-control w-75" value="{{$availableSlots[$key][0]['start_time'] ?? ''}}" placeholder="HH:MM" name="start[{{$key}}]"/>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <input type="text" autocomplete="off" class="input-center timepicker2 form-control w-75" value="{{$availableSlots[$key][0]['end_time'] ?? ''}}" placeholder="HH:MM" name="end[{{$key}}]"/>
                        </div>
                    </div>
                @endforeach
                <div id="showError" class="error" style="display: none">This field is required.</div>
                <input type="submit" class="available-submit-btn btn btn-outline-danger fw-bolder px-4 ms-2 fs-8" for="btnradio" value="Save">
            </form>

        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function () {
            $('input.timepicker1').timepicker({
                timeFormat: 'HH:mm',
                interval: 60
            });
            $('input.timepicker2').timepicker({
                timeFormat: 'HH:mm',
                interval: 60
            });
            @foreach($availableSlots as $key => $slot)
                $('.timepicker-key-{{$key}}').find('input.timepicker2').timepicker('option', 'minTime', "{{$slot[0]['start_time']}}");
            @endforeach

            $('input.timepicker1').timepicker('option', 'change', function(time) {
                $(this).parent().parent().find('input.timepicker2').val('');
                $(this).parent().parent().find('input.timepicker2').timepicker('option', 'minTime', time);
            });
            $("#AvailableSlotForm").on( "submit", function( event ) {
                if($("#AvailableSlotForm").valid())
                {
                    console.log('valid');
                }else{
                    console.log('not valid');
                    event.preventDefault();
                }
            });
            $("#AvailableSlotForm").validate({
                showErrors: function(errorMap, errorList) {
                    if (errorList.length > 0) {
                        $('#showError').show();
                    }else{
                        $('#showError').hide();
                    }
                },
            });
            $(".timepicker1").each(function(){
                $(this).rules("add", {
                    required: true,
                });
            });
            $(".timepicker2").each(function(){
                $(this).rules("add", {
                    required: true,
                });
            });
        });

    </script>
@endpush
