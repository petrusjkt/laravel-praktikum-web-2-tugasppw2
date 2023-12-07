<x-app-layout>
<div class="flex justify-center">
    <div class="container flex flex-col items-center">

        <h1 class="text-center m-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Edit Detail</h1>

        <form action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data" method="POST" class="flex flex-col justify-center items-center w-3/4 p-4 m-4 rounded-lg bg-gray-700">
            @csrf
            @method('patch')
    
            <div class="m-2 w-full">
                <label for="title" class="col-md-4 col-form-label">Title</label>

                <input id="title" name="title" type="text" 
                    class="input input-bordered input-primary w-full @error('title') is-invalid @enderror" 
                    value="{{ $book->title }}" 
                    autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="m-2 w-full">
                <label for="author" class="col-md-4 col-form-label">Author</label>

                <input id="author" 
                    name="author"
                    type="text" 
                    class="input input-bordered input-primary w-full @error('author') is-invalid @enderror" 
                    value="{{ $book->author }}" 
                    autocomplete="author" autofocus>

                @error('author')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="m-2 w-full">
                <label for="publisher" class="col-md-4 col-form-label">Publisher</label>

                <input id="publisher" 
                    name="publisher"
                    type="text" 
                    class="input input-bordered input-primary w-full @error('publisher') is-invalid @enderror" 
                    value="{{ $book->publisher }}" 
                    autocomplete="publisher" autofocus>

                @error('publisher')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="m-2 w-full">
                <label for="date_published" class="col-md-4 col-form-label">Publication Date</label>

                <input id="date_published" 
                    name="date_published"
                    type="date" 
                    class="input input-bordered input-primary w-full @error('date_published') is-invalid @enderror" 
                    value="{{ $book->date_published->format('Y-m-d') }}" 
                    autocomplete="date_published" autofocus>

                @error('date_published')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="m-2 w-full">
                <label for="description" class="col-md-4 col-form-label">Description</label>

                <textarea id="description" 
                    name="description"
                    class="textarea input-bordered input-primary w-full @error('description') is-invalid @enderror" 
                    rows="3"
                    autocomplete="description" autofocus>{{ $book->description }}</textarea>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="m-2 w-full">
                <label for="price" class="col-md-4 col-form-label">Price</label>

                <input id="price" 
                    name="price"
                    type="number" 
                    class="input input-bordered input-primary w-full @error('price') is-invalid @enderror" 
                    value="{{ $book->price }}" 
                    autocomplete="price" autofocus>

                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="m-2 w-full">
                <label for="page_count" class="col-md-4 col-form-label">Total Page</label>

                <input id="page_count" 
                    name="page_count"
                    type="number" 
                    class="input input-bordered input-primary w-full @error('page_count') is-invalid @enderror"
                    value="{{ $book->page_count }}" 
                    autocomplete="page_count" autofocus>

                @error('page_count')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="m-2 w-full">
                <label for="cover" class="col-md-4 col-form-label">Book's Cover</label>
                <input type="file" id="cover" name="cover" class="file-input file-input-bordered file-input-primary w-full">
                @error('cover')
                    {{-- <span class="invalid-feedback" role="alert"> --}}
                        <strong>{{ $message }}</strong>
                    {{-- </span> --}}
                @enderror
            </div>

            <div class="m-2 w-full">
                <label for="gallery" class="col-md-4 col-form-label">Book's Gallery</label>
                <input type="file" id="gallery" name="gallery[]" multiple class="file-input file-input-bordered file-input-primary w-full">
                @error('gallery')
                    {{-- <span class="invalid-feedback" role="alert"> --}}
                        <strong>{{ $message }}</strong>
                    {{-- </span> --}}
                @enderror
            </div>

            <div class="flex justify-between m-2 w-full max-w-xs">
                <button class="btn btn-success">Update Book</button>
                <a href={{ route('books.index') }} class="btn btn-error">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

</x-app-layout>