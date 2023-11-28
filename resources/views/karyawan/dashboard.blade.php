@extends('layouts.karyawan')
@section('title', 'Karyawan Home')
@section('homeActive', 'active')
@section('content')
    <div class="container">
        <div class="homePage">
            <div class="limikeDesk">
                <h1>Kasir <span>Limike</span> Online Shop</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci,
                    fuga dolorum, voluptate corrupti cupiditate similique rerum, nesciunt neque quam autem dolorem accusamus?
                    Deserunt rem sit saepe. Dicta necessitatibus repellendus voluptas!</p>
                    <button> Get Started <i> > </i></button>
            </div>
            <div class="gambar">
                <img src="{{ asset('karyawan/images/grosir.png') }}" alt="">
            </div>
        </div>
    </div>
@endsection