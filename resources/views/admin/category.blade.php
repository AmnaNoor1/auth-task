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
                                        <h4 class="text-center">Category</h4>
                                    </div>
                                    <button class="btn btn-success add-btn mb-5"  data-bs-toggle="modal" data-bs-target="#addCategoryModal" >
                                        Add New Category 
                                    </button>
                                </div>
                            </div>

                            <table class="table table-striped table-bordered">
                                <thead class="table-primary">
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
    </section>
   
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-btn');
        const categoryNameInput = document.getElementById('editcategoryName');
        const categoryIdInput = document.getElementById('editcategoryId');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                console.log(categoryId);
                const categoryName = this.getAttribute('data-name');
                categoryIdInput.value = categoryId;
                categoryNameInput.value = categoryName;
            });
        });
    });

    document.getElementById('editCategoryForm').addEventListener('submit', function() {
    console.log('Form submitted');
});

</script>
@endsection