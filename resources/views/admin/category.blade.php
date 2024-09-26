@extends('admin.layouts.dashboard')

@section('title', 'Category') 

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Category Table</h1>
    <p>Dynamic Handling of Categories. </p>
    <button class="btn btn-success add-btn mb-5"  data-bs-toggle="modal" data-bs-target="#addCategoryModal" >
        Add New Category 
    </button>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Category Table
          </div>
          <div class="card-body">
            <table id="datatablesSimple">
              <thead>
                <tr>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td> 
                        <button class="btn btn-primary edit-btn"  data-bs-toggle="modal" data-bs-target="#editCategoryModal" 
                        data-id="{{ $category->id }}" 
                        data-name="{{$category->name }}">
                        Edit </button>
                    </td>
                    <td> 
                        <form action="{{route('admin.deletecategory', $category->id )}}" method="POST" style="display:inline;">
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

 <!-- Modal for Edit-->
 <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.updatecategory')}}" method="POST" enctype="multipart/form-data" id="editCategoryForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editcategoryId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="editcategoryName">
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
 <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.processAddcategory')}}" method="post" enctype="multipart/form-data" id="addCategoryForm">
                    @csrf
                    <div class="row gy-3 overflow-hidden">
                       
                        <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" name="name" id="categoryName" placeholder="Enter category name" >
                              
                                @error('name')
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
        const categoryNameInput = document.getElementById('editcategoryName');
        const categoryIdInput = document.getElementById('editcategoryId');

        
        document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('edit-btn')) {
            const button = event.target;

                const categoryId = button.getAttribute('data-id');
                const categoryName = button.getAttribute('data-name');

                categoryIdInput.value = categoryId;
                categoryNameInput.value = categoryName;
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

    document.getElementById('editCategoryForm').addEventListener('submit', function() {
    console.log('Form submitted');
});

</script>

@endsection