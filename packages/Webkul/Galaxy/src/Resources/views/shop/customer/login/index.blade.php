@extends('galaxy::layouts.master')

@section('page_title')
    {{ __('galaxy::app.customer.login') }}
@stop

@section('content')
    <div class="customer-panel therapist-panel mt-10 translate-x-52 w-3/4">
        <a href="{{ route('shop.therapist.login.index') }}">
            <div class="image_container text-center text-lg float-right">
                <div class="container_image">
                    <img src="{{ asset('/themes/galaxy/assets/images/office_365.png') }}" class="h-14 w-48 mx-auto">
                </div>

                <div class="text">
                    <h1>Therapists Login</h1>
                </div>
            </div>
        </a>

        <div class="form-container" style="text-align: center; font-size: 15px; margin-top: 13%;">
            @if(Session::has('message'))
                <p  class="rounded-md mb-5 p-15 border-1 border-pink decoration-[#a94442] bg-pink-500/100">{{ Session::get('message') }}</p>
            @endif
            <img class="h-14 mx-auto" src="{{ asset('/themes/galaxy/assets/images/bankid_logo.png') }}" alt="bankid_logo">
            <div class="mt-5">
                Starta BankID-appen och valj alternativet for <br />
                QR-Kod. Scanna sedan koden nedan.
            </div> 
            <form method="POST" action="" @submit.prevent="onSubmit">
                @csrf  
                <div class="control-group h-22 mx-auto">
                    @if($qrImage)
                        <img src="@php echo $qrImage @endphp" class="h-22 mx-auto"/>
                    @endif    
                </div>
            </form>
        </div>    

        <a href="{{ route('shop.customer.clinic.therapist.company') }}">Login as Test</a>
    </div>
@stop

@push('javascript')
    <script>
        setInterval(function () {
            axios.get('{{ route('shop.customer.login.bankid') }}')
                .then(response => {
                    if (response.data) {
                        var data = response.data;
                    } else {
                        console.log(response);
                    }
                    
                }).catch(error => {
                    this.errorMessage = error.response.data.message;
                });
        }, 5000);
            
        </script>
@endpush