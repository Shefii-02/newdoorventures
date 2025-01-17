<div>
    @if ($lead->property || $lead->project)
        You have received a response for your inquiry for
        @if ($request->type == 'project')
            <a
                href="{{ route('public.project_single', ['uid' => $lead->project->unique_id, 'slug' => $lead->project->slug]) }}">{{ $lead->project->name }}</a>
        @else
            <a
                href="{{ route('public.property_single', ['uid' => $lead->property->unique_id, 'slug' => $lead->property->slug]) }}">{{ $$lead->property->name }}</a>
        @endif
        from {{ $lead->name }}.
    @else
        You have received a response for your inquiry from {{ $lead->name }}.
    @endif
</div>
@if ($lead->property)
    <div style="border-bottom: 1px solid #e5e3e3;margin-bottom: 1rem;margin-top: 1rem;padding-bottom: 10px;">
        <div>
            <div style="font-weight: 600;margin-bottom: 6px;">Property</div>
            <div><a href="{{ route('public.property_single', ['uid' => $lead->property->unique_id, 'slug' => $lead->property->slug]) }}">{{ $lead->property->name }}</a></div>
        </div>
    </div>
@elseif($lead->project)
    <div style="border-bottom: 1px solid #e5e3e3;margin-bottom: 1rem;margin-top: 1rem;padding-bottom: 10px;">
        <div>
            <div style="font-weight: 600;margin-bottom: 6px;">Project</div>
            <div><a href="{{ route('public.project_single', ['uid' => $lead->project->unique_id, 'slug' => $lead->project->slug]) }}">{{ $lead->property->name }}</a></div>
        </div>
    </div>
@endif
{{-- <div style="border-bottom: 1px solid #ffffff00;margin-bottom: 1rem;margin-top: 1rem;padding-bottom: 10px;">
    <div>
        <div style="font-weight: 600;margin-bottom: 6px;">Message</div>
        <div>{{ $lead->message }}</div>
    </div>
</div> --}}
<div style="border-bottom: 1px solid #ffffff00;margin-bottom: 1rem;margin-top: 1rem;padding-bottom: 10px;">
    <div>
        <div style="font-weight: 600;margin-bottom: 6px;">Response</div>
        <div>We have successfully followed up on your inquiry </div>
    </div>
</div>
 <div style="margin-top:2rem">
    You can directly reply to our support center through this Email/Phone.
</div> 
