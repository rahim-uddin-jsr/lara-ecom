@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Books</h2>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBookModal">
            Add Book
        </button>
        <input type="text" id="searchInput" class="form-control mt-3 mb-2" placeholder="Search...">


        <div class="table-data">
           <table class="table" id="booksTable">
               <thead>
               <tr>
                   <th>Title</th>
                   <th>Description</th>
                   <th>Pages</th>
                   <th>Price</th>
                   <th class="text-center">Action</th>
               </tr>
               </thead>
               <tbody>
               @foreach($books as $book)
                   <tr>
                       <td>{{$book->title}}</td>
                       <td>{{$book->description}}</td>
                       <td>{{$book->pages}}</td>
                       <td>{{$book->price}}</td>
                       <td>
                           <div class="w-100 d-flex justify-content-center gap-3">
                               <a href=""
                                  class="btn btn-outline-info btn-sm"
                                  data-toggle="modal" id="editBtn"
                                  data-target="#editBookModal"
                                  data-id="{{$book->id}}"
                                  data-title="{{$book->title}}"
                                  data-description="{{$book->description}}"
                                  data-pages="{{$book->pages}}"
                                  data-price="{{$book->price}}"
                               >edit</a>
                               <button data-id="{{$book->id}}" class="btn btn-outline-danger btn-sm deleteBtn">delete</button>
                           </div>
                       </td>
                   </tr>
               @endforeach
               <!-- Repeat the above row for each book -->
               </tbody>
           </table>
           <div class="pagination-book">
               {{$books->links()}}
           </div>
       </div>

        <!-- book add Modal -->
        <div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="addBookModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" id="addBookForm">
                        @csrf
                        <div class="modal-header justify-content-between">
                            <h5 class="modal-title" id="addBookModalLabel">Add Book</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for adding a new book -->
                            <div class="errorMassage"></div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pages">Pages</label>
                                <input type="number" class="form-control" id="pages" name="pages">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="addBook">Add Book</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{--        Book Edit modal--}}
        <div class="modal fade" id="editBookModal" tabindex="-1" role="dialog" aria-labelledby="editBookModal"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="get" id="editBookForm">
                        @csrf
                        <div class="modal-header justify-content-between">
                            <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for adding a new book -->
                            <div class="errorMassage"></div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="hidden" name="id" id="up_id" >
                                <input type="text" class="form-control" id="up_title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="up_description" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pages">Pages</label>
                                <input type="number" class="form-control" id="up_pages" name="pages">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="up_price" name="price">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="updateBook">Update Book</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
