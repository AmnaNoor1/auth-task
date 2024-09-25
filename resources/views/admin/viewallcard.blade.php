@extends('admin.layouts.dashboard')

@section('title', 'Cards List')

@section('content')
<link rel="stylesheet" href="{{ asset('css/test.css') }}">
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row row-cols-4 gy-3 gx-3 mid-grid">
                @foreach ($cards as $card)
                    <div class="col col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12" data-category="{{ $card->category }}">
                        <div class="image-over">
                            <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->title }}" class="img-fluid" />
                        </div>
                        <div class="card-details">
                            <div class="card-title">{{ $card->title }}</div>
                            <div class="card-category">{{ $card->category }}</div>
                            <div class="card-buttons">
                                <a href="#" target="_blank" class="btn primary-button">Multi-Page</a>
                                <a href="#" target="_blank" class="btn primary-button">One-Page</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
