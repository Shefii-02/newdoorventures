@if ($properties->isNotEmpty())
<div class="row">
    <div class="col-lg-10">
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 mt-8 gap-[30px]">
            @foreach ($properties as $property)
                @if ($property->type == 'pg')
                    @include('front.shortcuts.properties.item-pg', compact('property'))
                @elseif($property->category->name == 'Plot and Land')
       
                    @include('front.shortcuts.properties.item-plot', compact('property'))
                @elseif($property->type == 'rent')
                    @include('front.shortcuts.properties.item-rent', compact('property'))
                @else
                    @include('front.shortcuts.properties.item-sale', compact('property'))
                @endif
            @endforeach
        </div>
    </div>
    <div class="col-lg-2">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('user.properties.create') }}" target="_blank">
                    <div class="box">
                        <div class="px-1.5 bg-gray-300 py-4 rounded">
                            <h1 class="fw-bold  text-center text-dark  " >
                                Sell/Rent your Property with us for Free
                            </h1>
                        </div>
                        <div class="py-4 ">
                            <button class="text-white rounded-full btn bg-primary hover:bg-secondary border-primary dark:border-primary post-property fs-6">Post Property</button>
                        </div>
                        
    
                        <h6 class=" fw-bold fs-16 ">Here's why Our Portal:</h6>
                        <ul class="py-4">
                            <li class="fs-13 mb-2">
                                Get Access to 4 Lakh + Buyers
                            </li>
                            <li class="fs-13 mb-2">
                                Sell Faster with Premium Service
                            </li>
                            <li class="fs-13 mb-2">
                                Find only Genuine Leads
                            </li>
                            <li class="fs-13 mb-2">
                                Get Expert advice on Market Trends & insights
                            </li>
                        </ul>
                        
                    </div>
                </a>
               
                
            </div>
        </div>
        {{-- advertisement --}}
        <div class="py-4" >
            <img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/aae8da113086087.60212ba3b3ae2.jpg">
        </div>

    </div>

</div>
   
@else
    <div class="my-16 text-center">
        <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
        </svg>
        <p class="mt-3 text-xl text-gray-500 dark:text-gray-300">{{ __('No properties found.') }}</p>
    </div>
@endif
