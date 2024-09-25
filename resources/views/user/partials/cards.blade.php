<div class="row row-cols-4 gy-3 gx-3 mid-grid">
    @foreach ($cards as $card)
    <div
      class="col col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12"
      data-category={{$card->category}}>
      <div class="image-over">
        <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->title }}" class="img-fluid" />
      </div>
      <div class="card-details">
        <div class="card-title">{{$card->title}}</div>
        <div class="card-category">{{$card->category}}</div>
        <div class="card-buttons">
          <a href="home-1.html" target="_blank" class="btn primary-button"
            >Multi-Page</a
          >
          <a
            href="home-1-one-page.html"
            target="_blank"
            class="btn primary-button"
            >One-Page</a
          >
        </div>
      </div>
    </div>
    @endforeach    
</div>