<div class="tabs">
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
      <label class="btn">
        <input
          type="radio"
          name="filter"
          value="all"
          class="btn-filter-item-1"
          checked
        />
        <span class="custom-radio-button active">All</span>
      </label>
      @foreach ($categories as $category )
      <label class="btn">
        <input
          type="radio"
          name="filter"
          value="{{$category->name}}"
          class="btn-filter-item-1"
        />
        <span class="custom-radio-button">{{$category->name}}</span>
      </label>
      @endforeach
      
    </div>
  </div>