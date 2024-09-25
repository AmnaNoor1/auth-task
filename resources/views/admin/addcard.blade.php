@extends('admin.layouts.dashboard')

@section('title', 'Home Page') <!-- Fills in the title section -->

@section('content')

    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="card border border-light-subtle rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">
                                        <h4 class="text-center">Cards</h4>
                                    </div>
                                    <button class="btn btn-success add-btn mb-5"  data-bs-toggle="modal" data-bs-target="#addCardModal" >
                                        Add New Category 
                                    </button>
                                </div>
                            </div>
                           
                            <table class="table table-striped table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cards as $card)
                                    <tr>
                                        <td>{{$card->id}}</td>
                                        <td>{{ $card->title }}</td>
                                        <td>{{ $card->category }}</td>
                                        <td> <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->title }}" width="100" height="100"/></td>
                                        <td> 
                                            <button class="btn btn-primary edit-btn"  data-bs-toggle="modal" data-bs-target="#editCardModal" 
                                            data-id="{{ $card->id }}" 
                                            data-title="{{ $card->title }}" 
                                            data-category="{{ $card->category }}"
                                            data-image="{{ asset('storage/' . $card->image) }}">
                                            Edit </button>
                                        </td>
                                        <td> 
                                            <form action="{{ route('admin.deletecard', $card->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

       

        <!-- Modal for edit-->
        <div class="modal fade" id="editCardModal" tabindex="-1" aria-labelledby="editCardModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCardModalLabel">Edit Card</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.updatecard') }}" method="POST" enctype="multipart/form-data" id="editCardForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="cardId">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="cardTitle">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select  name="category" id="cardCategory" class="form-control" >
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}" {{ old('category') == $category->name ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="cardImage">
                                <img src="" id="previewImage" width="100" height="100" class="mt-2">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

          <!-- Modal for Add-->
          <div class="modal fade" id="addCardModal" tabindex="-1" aria-labelledby="addCardModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCardModalLabel">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.processAddcard')}}" method="post" enctype="multipart/form-data" id="addCategoryForm">
                            @csrf
                            <div class="row gy-3 overflow-hidden">
                               
                                <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Enter card title" >
                                        @error('title')
                                        <p class="invalid-feedback">{{$message}}</p>
                                        @enderror
                                </div> 
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="category" id="category" class="form-select @error('category') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->name }}" {{ old('category') == $category->name ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" >
                                    @error('image')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div> 
                               
                                
                                <div class="modal-footer">
                                    <div class="d-grid">
                                        <button class="btn  btn-primary" type="submit">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-btn');
        const cardTitleInput = document.getElementById('cardTitle');
        const cardCategoryInput = document.getElementById('cardCategory');
        const cardIdInput = document.getElementById('cardId');
        const previewImage = document.getElementById('previewImage');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const cardId = this.getAttribute('data-id');
                const cardTitle = this.getAttribute('data-title');
                const cardCategory = this.getAttribute('data-category');
                const cardImage = this.getAttribute('data-image');

                cardIdInput.value = cardId;
                cardTitleInput.value = cardTitle;
                cardCategoryInput.value = cardCategory;
                previewImage.src = cardImage;

                console.log({cardId, cardTitle, cardCategory, cardImage});

              

            });
        });
    });

    document.getElementById('editCardForm').addEventListener('submit', function() {
    console.log('Form submitted');
});

</script>
@endsection