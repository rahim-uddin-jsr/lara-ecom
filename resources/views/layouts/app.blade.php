<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <div class="w-25 mx-auto">
                @if (session('success'))
                    <div id="successMessage" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div id="errorMessage" class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            @yield('content')
        </main>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('successMessage');
            var errorMessage = document.getElementById('errorMessage');

            if (successMessage) {
                successMessage.parentNode.removeChild(successMessage);
            }

            if (errorMessage) {
                errorMessage.parentNode.removeChild(errorMessage);
            }
        }, 2000); // 2 seconds
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#addBook', function(e) {
                e.preventDefault();
                let title = $('#title').val()
                let description = $('#description').val()
                let pages = $('#pages').val()
                let price = $('#price').val()

                let data = {
                    title,
                    description,
                    pages,
                    price
                }

                $.ajax({
                    url: "{{ route('books.store') }}",
                    method: 'POST',
                    data: data,
                    success: function(res) {
                        console.log(res)
                        $('#booksTable').load(location.href + ' #booksTable')
                        $('.pagination-book').load(location.href + ' .pagination-book')
                        $('#addBookForm')[0].reset()
                        $('#addBookModal').removeClass('show');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('.errorMassage').empty();
                        Swal.fire({
                            title: "Added!",
                            text: "Your Book has been added.",
                            icon: "success"
                        });
                    },
                    error: function(err) {
                        $('.errorMassage').empty();
                        console.log(err)
                        let errors = err.responseJSON.errors;
                        console.log(errors)
                        if (errors) {
                            $.each(errors, function(field, messages) {
                                $.each(messages, function(i, message) {
                                    $('.errorMassage').append(
                                        '<span class="text-danger">' +
                                        message + '</span><br>');
                                });
                            });
                        }
                    }
                })

            })
        })
        // Edit form books
        $(document).on('click', '#editBtn', function(e) {
            let dataId = $(this).data('id');
            let dataTitle = $(this).data('title');
            let dataDescription = $(this).data('description');
            let dataPrice = $(this).data('price');
            let dataPages = $(this).data('pages');

            $('#up_id').val(dataId)
            $('#up_title').val(dataTitle)
            $('#up_description').val(dataDescription)
            $('#up_pages').val(dataPages)
            $('#up_price').val(dataPrice)
        })

        // Update books
        $(document).on('click', '#updateBook', function(e) {
            e.preventDefault()
            let id = $('#up_id').val()
            let title = $('#up_title').val()
            let description = $('#up_description').val()
            let pages = $('#up_pages').val()
            let price = $('#up_price').val()

            let data = {
                id,
                title,
                description,
                pages,
                price
            }
            console.log(data);

            $.ajax({
                url: "{{ route('books.update', '') }}" + "/" + id,
                method: 'PUT',
                data: data,
                success: function(res) {
                    console.log(res)
                    $('#booksTable').load(location.href + ' #booksTable')
                    $('#editBookForm')[0].reset()
                    $('#editBookModal').removeClass('show');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('.errorMassage').empty();
                    Swal.fire({
                        title: "Updated!",
                        text: "Your info has been updated.",
                        icon: "success"
                    });

                },
                error: function(err) {
                    $('.errorMassage').empty();
                    console.log(err)
                    let errors = err.responseJSON.errors;
                    console.log(errors)
                    if (errors) {
                        $.each(errors, function(field, messages) {
                            $.each(messages, function(i, message) {
                                $('.errorMassage').append('<span class="text-danger">' +
                                    message + '</span><br>');
                            });
                        });
                    }
                }
            })


            // $('#editBookForm')[0].reset()
            // $('#editBookModal').removeClass('show');
            // $('body').removeClass('modal-open');
            // $('.modal-backdrop').remove();

        })

        // DELETE Book
        $(document).on('click', '.deleteBtn', function(e) {


            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id')
                    $.ajax({
                        url: "{{ route('books.destroy', '') }}" + '/' + id,
                        method: 'delete',
                        success: function(res) {
                            $('#booksTable').load(location.href + ' #booksTable')
                            $('.pagination-book').load(location.href + ' .pagination-book')
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                        },
                        error: function(err) {
                            $('.errorMassage').empty();
                            console.log(err)
                            let errors = err.responseJSON.errors;
                            console.log(errors)
                            if (errors) {
                                $.each(errors, function(field, messages) {
                                    $.each(messages, function(i, message) {
                                        $('.errorMassage').append(
                                            '<span class="text-danger">' +
                                            message + '</span><br>');
                                    });
                                });
                            }
                        }
                    })
                }
            });

        })

        function paginationlinkClicked() {
            $(document).on('click', '.page-item>a', function (e) {
                e.preventDefault()
                let page = $(this).attr('href').split('page=')[1]
                books(page)
            })
        }

        // Pagination
        paginationlinkClicked();

        function books(page) {
            $.ajax({
                url: "/books-data?page=" + page,
                success: function(res) {
                    $('.table-data').html(res)
                }
            })
        }

        $(document).on('keyup', '#searchInput', function(e) {
            let key = $(this).val();

            $.ajax({
                url: "{{ route('books.search') }}",
                method: 'GET',
                data: {
                    key: key
                }, // Corrected data format
                success: function(res) {
                    $('.table-data').html(res);
                }
            });
        });
    </script>
</body>

</html>
