<div>
    <div style="margin-bottom:2rem;">
        <div>
            <strong>New property "{{ $ad->name }}" has been submitted and is awaiting review.</strong>
        </div>
        @include('email.adCard')
        <div>
            This property will remain unpublished until it is approved.
        </div>
    </div>
</div>
