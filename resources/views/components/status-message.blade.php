<div style="display: none" class="alert fade alert-simple alert-success alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show">
    <i class="start-icon far fa-check-circle faa-tada animated"></i>
    {{ \Illuminate\Support\Facades\Session::get('success') }}
</div>
@push('scripts')
    <script type="text/javascript">
        @if(\Illuminate\Support\Facades\Session::has('success'))
            $('.alert-success').show();
            setTimeout(function () {
                $('.alert-success').hide();
            },2000);
        @endif
    </script>
@endpush
