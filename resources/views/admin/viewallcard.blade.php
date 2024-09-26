@extends('admin.layouts.dashboard')

@section('title', 'Cards List')

@section('content')
<link rel="stylesheet" href="{{ asset('css/test.css') }}">
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <p>Dashboard</p>
    {{-- Flash Cards --}}
    <div class="row">
        <div class="col-xl-4 col-md-6">
          <div class="card bg-primary text-white mb-4">
            <div class="card-body fs-1">{{$userCount}}</div>
            <div
              class="card-footer d-flex align-items-center justify-content-between"
            >
              <p class="small text-white stretched-link">No. of Registered Users</p>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card bg-warning text-white mb-4">
            <div class="card-body fs-1">{{$catCount}}</div>
            <div
              class="card-footer d-flex align-items-center justify-content-between"
            >
              <p class="small text-white stretched-link">No. of Categories</p>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card bg-success text-white mb-4">
            <div class="card-body fs-1">{{$cardCount}}</div>
            <div
              class="card-footer d-flex align-items-center justify-content-between"
            >
              <p class="small text-white stretched-link" >No. of Cards</p>
            </div>
          </div>
        </div>
      </div>
         
       
      <h3 class="mt-4">All Cards</h3>
      <div class="row row-cols-4  mid-grid">
          @foreach ($cards as $card)
              <div class="col col-xl-3 col-md-6 col-sm-12 col-12" data-category="{{ $card->category }}">
              <div> </div> 
                <div class="image-over">
                      <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->title }}" class="img-fluid" />
                  </div>
                  <div class="card-details">
                      <div class="card-title btn btn-lg">{{ $card->title }}</div>
                      <div class="card-category">{{ $card->category }}</div>
                  </div>
              </div>
          @endforeach
      </div>
      
            
       
</div>
@endsection
