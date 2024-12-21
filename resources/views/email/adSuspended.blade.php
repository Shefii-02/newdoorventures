<div>
    <div style="margin-bottom:2rem;">
        <div>
            <strong>Important Update: Your property "{{ $ad->name }}" has been suspended and is no longer live.</strong>
        </div>
        @include('email.adCard')
        <div>
            Please review your property details or contact support to resolve any issues. Thank you for using our platform!
        </div>
    </div>
</div>
