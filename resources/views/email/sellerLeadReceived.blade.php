<div>
    @if ($ad)
        You have received a new inquiry for your property
        @if ($request->type == 'project')
            <a
                href="{{ route('public.project_single', ['uid' => $ad->unique_id, 'slug' => $ad->slug]) }}">{{ $ad->name }}</a>
        @else
            <a
                href="{{ route('public.property_single', ['uid' => $ad->unique_id, 'slug' => $ad->slug]) }}">{{ $ad->name }}</a>
        @endif
        from
        {{ "{$request->name}" }}.
    @else
        You have received a general inquiry from {{ "{$request->name}" }}.
    @endif
</div>
<div style="border-bottom: 1px solid #e5e3e3;margin-bottom: 1rem;margin-top: 1rem;padding-bottom: 10px;">
    <div>
        <div style="font-weight: 600;margin-bottom: 6px;">Name</div>
        <div>{{ "{$request->name}" }}</div>
    </div>
</div>
<div style="border-bottom: 1px solid #e5e3e3;margin-bottom: 1rem;margin-top: 1rem;padding-bottom: 10px;">
    <div>
        <div style="font-weight: 600;margin-bottom: 6px;">Email</div>
        <div>{{ $request->email }}</div>
    </div>
</div>
<div style="border-bottom: 1px solid #e5e3e3;margin-bottom: 1rem;margin-top: 1rem;padding-bottom: 10px;">
    <div>
        <div style="font-weight: 600;margin-bottom: 6px;">Phone</div>
        <div>{{ $request->phone }}</div>
    </div>
</div>
@if ($ad)
    @if ($request->type == 'project')
        <div style="border-bottom: 1px solid #e5e3e3;margin-bottom: 1rem;margin-top: 1rem;padding-bottom: 10px;">
            <div>
                <div style="font-weight: 600;margin-bottom: 6px;">Property</div>
                <div><a target="_new"
                        href="{{ route('public.project_single', ['uid' => $ad->unique_id, 'slug' => $ad->slug]) }}">{{ $ad->name }}</a>
                </div>
            </div>
        </div>
    @else
        <div style="border-bottom: 1px solid #e5e3e3;margin-bottom: 1rem;margin-top: 1rem;padding-bottom: 10px;">
            <div>
                <div style="font-weight: 600;margin-bottom: 6px;">Project</div>
                <div><a target="_new"
                        href="{{ route('public.property_single', ['uid' => $ad->unique_id, 'slug' => $ad->slug]) }}">{{ $ad->name }}</a>
                </div>
            </div>
        </div>
    @endif
@endif
{{-- <div style="border-bottom: 1px solid #ffffff00;margin-bottom: 1rem;margin-top: 1rem;padding-bottom: 10px;">
    <div>
        <div style="font-weight: 600;margin-bottom: 6px;">Message</div>
        <div>{{ $request->message }}</div>
    </div>
</div> --}}
<div style="margin-top:2rem">
    You can directly reply to {{ "{$request->name}" }} through this email.
</div>
