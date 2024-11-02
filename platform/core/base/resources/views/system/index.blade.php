@extends(BaseHelper::getAdminMasterLayoutTemplate())


@push('header-action')
    <script> 
    document.addEventListener('DOMContentLoaded', function() {
        var element = document.getElementById('panel-section-item-system-cronjob');
        if (element) {
            element.remove();
        }
    });

        
    </script>
@endpush
@section('content')

    <x-core::panel-section id="system" />

@endsection
