<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Edit Data Buku</h1>
        <form action="{{ url('update/'.$book->id.'/book') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title">Masukkan Judul Buku</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                    value="{{ $book->title }}">
            </div>
            <div class="mb-3">
                <label for="publisher">Masukkan Nama Publisher</label>
                <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Publisher"
                    value="{{ $book->publisher }}">
            </div>
            <div class="mb-3">
                <label for="genre">Masukkan Nama Genre</label>
                <input type="text" class="form-control" id="genre" name="genre" placeholder="Genre"
                    value="{{ $book->genre }}">
            </div>
            <div class="mb-3">
                <label for="price">Masukkan Harga Buku</label>
                <input type="number" min="1" class="form-control" id="price" name="price" placeholder="price"
                    value="{{ $book->price }}">
            </div>
            <div class="mb-3">
                <label for="published_at">Masukkan Tanggal Terbit</label>
                <input type="date" min="1" class="form-control" id="published_at" name="published_at"
                    placeholder="published_at" value="{{ $book->published_at }}">
            </div>
            <div class="mb-3">
                <label for="user_id">Masukkan Nama Author</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-info" type="submit">Submit</button>


        </form>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
