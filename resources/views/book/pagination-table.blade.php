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
