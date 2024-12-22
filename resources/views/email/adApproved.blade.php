<div>
    <div style="margin-bottom:2rem;">
        <div>
            <strong>Great news! Your property "{{ $ad->name }}" has been approved and is now live.</strong>
        </div>
        @include('email.adCard')
        <div>
            You will start receiving leads right away. Thank you for choosing our {{ str_replace('-',' ', env('APP_NAME')) }}!
        </div>
    </div>
</div>
