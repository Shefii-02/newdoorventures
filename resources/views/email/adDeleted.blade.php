<div>
    <div style="margin-bottom:2rem;">
        <div>
            <strong>Important Update: Your property "{{ $ad->name }}" has been permanently deleted from our platform.</strong>
        </div>
        @include('email.adCard')
        <div>
            This action has been taken in accordance with our platform's policies. If you have any questions or believe this was done in error, please contact our support team for assistance.
        </div>
    </div>
</div>
