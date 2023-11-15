@extends('layouts.app')

@section('title', 'Terimakasih Telah Berbelanja '. auth()->user()->name)
@section('content')

<div class="py-3 pyt-md-4">
    <div class="container">
        {{-- <div class="row">
            <div class="col-md-12 text-center">
                @if (session('danger-alert'))
                    <div class="alert alert-danger">
                        {{ session('danger-alert') }}
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="p-4 shadow bg-white">
                    <h2>Logo</h2>
                    <h4>Terimakasih telah berbelanja di Limike Olshop</h4>
                    <a href="{{ url('collections') }}" class="btn btn-primary">Belanja lagi</a>
                </div>
            </div>
        </div> --}}
        <div class="container">
            @if (session('danger-alert'))
                <div class="alert alert-danger">
                    {{ session('danger-alert') }}
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="center-checkout-massage">
                <div class="checkout-sukses">
                    <div class="gambar"> <img src="{{ asset('assets/basic/thank-you-lettering-with-curls_1262-6964.jpg') }}" alt="thanks.jpg"></div>
                        <div class="massage-thanks">
                            <h1> Terima kasih !!</h1>
                            <p>Pesanan Anda telah masuk. Terima kasih atas kepercayaan Anda. Produk akan segera dikirim setelah dikonfirmasi!</p>
                            <a href="{{ url('collections') }}" class="btn btn-primary pt-2">Belanja lagi</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection