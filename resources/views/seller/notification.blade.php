@extends('seller.layouts.master')
@section('content')

<div style="height: 70vh" class="flex flex-column justify-content-center mb-4 p-4 rounded-lg items-center text-center text-light-700">
    <div class="mr-4">
        <!-- Notification Image -->
        <img src="{{ asset('images/general/error.png') }}" alt="Pending Approval" class="w-30 h-30 rounded-full">
    </div>
    <div class="mt-4">
        <!-- Notification Message -->
        <h1 class="font-bold display-6 mb-4">{{ auth('account')->user()->status == 'pending' ? 'Account Under Review' : 'Account Suspended' }}</h1>
        @if(auth('account')->user()->status == 'pending')
            <p class="text-lg mb-1 font-bold">
                Thank you for your patience! Your account is currently under review. <br>
            </p>
            <p class="text-lg">    This process helps us ensure everything is set up properly for your experience.<br>
                    If you have any urgent concerns, feel free to reach out to our customer support team.
            </p>
        @else
            <p class="text-lg mb-1 font-bold">
                Thank you for your patience. Unfortunately, your account does not comply with our policies. <br>
            </p>
                <p class="text-lg">    
                    We regret to inform you that your account has been suspended due to a policy violation or unresolved issues.<br>
                    To resolve this matter or for further assistance, please contact our customer support team.
            </p>
        @endif
        <a href="tel:+18001234567" class="mt-2 font-bold inline-block text-blue-600 hover:underline gap-3 justify-center mt-5 flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-forward-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877zm10.761.135a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708"/>
              </svg>
               Call Support Center
        </a>
    </div>
</div>



@endsection