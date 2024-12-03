<form class="generic-form" id="contact-form" method="post" action="{{ route('public.send.consult') }}">
    @csrf
    <input type="hidden" value="{{ $type }}" name="type">
    <input type="hidden" value="{{ $data->id }}" name="data_id">
    <div class="p-6 space-y-3">
        <h3 class="bg-light bg-succs border-1 font-bold mb-4 mx-5 p-2 rounded text-center text-dark text-sm">{{ __('CALL: 9686607663') }}</h3>
        <div>
            <input name="name" type="text" class="bg-white form-input dark:bg-slate-700"
                placeholder="{{ __('Name') }}">
        </div>
  
            <div>
                <input name="phone" type="text" class="bg-white form-input dark:bg-slate-700"
                    placeholder="{{ __('Phone') }} required">
            </div>
      
            <div>
                <input name="email" type="email" class="bg-white form-input dark:bg-slate-700"
                    placeholder="{{ __('Email') }}">
            </div>
       
        <div>
            <input type="text" readonly class="text-gray-400 form-input d-none" disabled value="{{ $data->name }}">
        </div>
        <div>
            <span>Are you Agent</span>
            <div class="flex flex-wrap mt-2">
                <div class="flex items-center me-4">
                    <input id="yes-radio" type="radio" value="yes" name="agent" checked
                        class="w-4 h-4 text-yellow-600 bg-gray-100 border-gray-300 focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="yes-radio" class="ms-2 text-sm font-medium text-white dark:text-white">Yes</label>
                </div>
                <div class="flex items-center me-4">
                    <input id="no-radio" type="radio" value="no" name="agent"
                        class="w-4 h-4 text-yellow-600 bg-gray-100 border-gray-300 focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="no-radio"
                        class="ms-2 text-sm font-medium text-white-900 dark:text-white">No</label>
                </div>
            </div>
        </div>
        <div>
            {{-- <textarea name="content" rows="3" class="form-input h-24 dark:bg-slate-700 bg-white" placeholder="Message"></textarea> --}}
        </div>
      
        <div class="text-center"> 
            <button type="submit" class=" text-sm  text-white btn bg-black">{{ __('Get Phone Number') }}</button>
        </div>

    

    </div>
</form>
