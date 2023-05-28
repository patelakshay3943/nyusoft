@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>

    </style>
    <div class="container-xl big-padding">
        <x-status-message />
        <div class="row section-title">
            <h2 class="fs-4">Unavailable Days</h2>
        </div>

        <div class="text-white border-radius text-center mb-4 input-center shadow-md bg-dark-grey p-4 pt-5 w-50">
            <form id="unavailableDaysForm" action="{{route('unavailable-days.store')}}">
                @csrf

                <div class="datepicker-clone">
                    @forelse($unavailableDays as $key => $value)
                        <div class="row mb-3">
                            <div class="col-lg-8 col-md-8">
                                <input autocomplete="off" class="datepicker form-control input-center w-50" type="text" value="{{\Carbon\Carbon::createFromFormat('Y-m-d',$value->date)->format('d/m/Y')}}" name="days[]">
                            </div>
                            <div class="col-lg-1 col-md-1 action-section">
                                @if($key == 0)
                                    <a class="btn add-more-date btn-primary mt-1" href="javascript:void(0)"><i class="bx bxs-plus-circle"></i></a>
                                @else
                                    <a class="btn remove-more-date btn-danger mt-1" href="javascript:void(0)"><i class="bx bxs-minus-circle"></i></a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="row mb-3">
                            <div class="col-lg-8 col-md-8">
                                <input autocomplete="off" class="datepicker form-control input-center w-50" type="text" name="days[]">
                            </div>
                            <div class="col-lg-1 col-md-1 action-section">
                                <a class="btn add-more-date btn-primary mt-1" href="javascript:void(0)"><i class="bx bxs-plus-circle"></i></a>

                            </div>
                        </div>
                    @endforelse

                </div>
                <div id="showError" class="error" style="display: none">This field is required.</div>
                <input type="submit" class="available-submit-btn btn btn-outline-danger fw-bolder px-4 ms-2 fs-8" value="Save">

            </form>
{{--            <div id="sandbox-container"><div></div></div>--}}

        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(function(){
            $('.datepicker').datepicker({
                autoclose: true,
                format:"dd/mm/yyyy"
            });

            $(document.body).on('click','.add-more-date',function () {
                var cloneData = $(".datepicker-clone .row:first").clone();
                cloneData.find('.action-section').html('<a class="btn remove-more-date btn-danger mt-1" href="javascript:void(0)"><i class="bx bxs-minus-circle"></i></a>');
                cloneData.find('.datepicker').val('');
                cloneData.insertAfter($('.datepicker-clone .row:last'));
                // console.log(cloneData);
                   $('.datepicker').datepicker({
                       autoclose: true,
                       format:"dd/mm/yyyy"
                   });
            })
            $(document.body).on('click','.remove-more-date',function (){
                $(this).parent().parent().remove();
            })

            // $('#sandbox-container div').datepicker({
            // });
        });
    </script>
@endpush
