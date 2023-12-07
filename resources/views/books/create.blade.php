<x-app-layout>

<div class="container">
    <form action="/books" enctype="multipart/form-data" method="post">
        @csrf

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1 class="text-center">Add New Book</h1>
                </div>

                <div class="row mb-2">
                    <label for="title" class="col-md-4 col-form-label">Title</label>

                    <input id="title" name="title" type="text" 
                        class="form-control @error('title') is-invalid @enderror" 
                        autofocus>

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-2">
                    <label for="author" class="col-md-4 col-form-label">Author</label>

                    <input id="author" name="author" type="text" 
                        class="form-control @error('author') is-invalid @enderror">

                    @error('author')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-2">
                    <label for="publisher" class="col-md-4 col-form-label">Publisher</label>

                    <input id="publisher" name="publisher" type="text" 
                        class="form-control @error('publisher') is-invalid @enderror">

                    @error('publisher')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-2">
                    <label for="date_published" class="col-md-4 col-form-label">Publication Date</label>

                    <input id="date_published" name="date_published" type="date"
                        class="form-control @error('date_published') is-invalid @enderror">

                    @error('date_published')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-2">
                    <label for="description" class="col-md-4 col-form-label">Description</label>

                    <input id="description" name="description" type="text" 
                        class="form-control @error('description') is-invalid @enderror">

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-2">
                    <label for="price" class="col-md-4 col-form-label">Price</label>

                    <input id="price" name="price" type="number" 
                        class="form-control @error('price') is-invalid @enderror">

                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-2">
                    <label for="page_count" class="col-md-4 col-form-label">Total Page</label>

                    <input id="page_count" name="page_count" type="number" 
                        class="form-control @error('page_count') is-invalid @enderror">

                    @error('page_count')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="row mb-2">
                    <label for="image" class="col-md-4 col-form-label">Book's Cover</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-success">Add New Book</button>
                        <a href="{{ route('books.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

</x-app-layout>