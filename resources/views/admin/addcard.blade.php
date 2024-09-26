@extends('admin.layouts.dashboard')

@section('title', 'Cards') 

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Card Table</h1>
        <p>Dynamic Handling of Cards. </p>
        <button class="btn btn-success add-btn mb-5"  data-bs-toggle="modal" data-bs-target="#addCardModal" >
         Add New Card 
        </button>
        <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Card Table
            </div>
            <div class="card-body">
              <table id="datatablesSimple">
                <thead>
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
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" >
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
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-btn');
        const cardTitleInput = document.getElementById('cardTitle');
        const cardCategoryInput = document.getElementById('cardCategory');
        const cardIdInput = document.getElementById('cardId');
        const previewImage = document.getElementById('previewImage');

        document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('edit-btn')) {
            const button = event.target;

            const cardId = button.getAttribute('data-id');
            const cardTitle = button.getAttribute('data-title');
            const cardCategory = button.getAttribute('data-category');
            const cardImage = button.getAttribute('data-image');

            // Set the values in the modal
            cardIdInput.value = cardId;
            cardTitleInput.value = cardTitle;
            cardCategoryInput.value = cardCategory;
            previewImage.src = cardImage;

            console.log({cardId, cardTitle, cardCategory, cardImage});
        }
    });

        
         
        @if (Session::has('success'))
                    toastr.success("{{ Session::get('success') }}");
                @endif
            
                @if (Session::has('error'))
                    toastr.error("{{ Session::get('error') }}");
                @endif
            
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        toastr.error("{{ $error }}");
                    @endforeach
                @endif
           
    });

    document.getElementById('editCardForm').addEventListener('submit', function() {
    console.log('Form submitted');
});

</script>

@endsection