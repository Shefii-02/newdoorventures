
<div class="mt-5">
    {{-- <label class="form-label" for="min-price" class="font-medium form-label text-slate-900 dark:text-white">Number of Bedrooms</label> --}}
    <div class="relative mt-2 filter-search-form filter-border">
        <ul class="ks-cboxtags p-0">
            @foreach(range(1, 5) as $i)
                <li><input type="checkbox" name="bedrooms[]" id="bedroom{{$i}}_{{ $type }}" value="{{ $i }}">
                        <label for="bedroom{{$i}}_{{ $type }}">@if($i !== 5)
                            {{ trans_choice(__('1 bedroom|:number bedrooms'), $i, ['number' => $i]) }}
                        @else
                            {{ __('5+ bedrooms') }}
                        @endif
                        </label>
                </li>
            @endforeach
        </ul>
    </div>
</div>

