<x-app-layout>

    @if (count($books))
        
    <div class="flex justify-center">
        <div class="container">
            <h1 class="text-center mt-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Book Collection</h1>
        
            <h3 class="text-center text-3xl dark:text-white">total: {{ $bookCount }}</h3>
            <h3 class="text-center text-3xl dark:text-white">price total: {{ "Rp ".number_format($priceSum, 2, ',', '.') }}</h3>
            <div class="flex-col justify-center items-center">
                <div class="my-4 flex justify-center">
                    <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
                </div>
                <div class="flex justify-center">
                    <div class="alert alert-success w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>Ditemukan <strong>{{ $bookCount }}</strong> buku dengan kata kunci <strong>{{ $search }}</strong></span>
                    </div>
                </div>
            </div>
    
            <form action="{{ route('books.search') }}" method="get" class="flex-row my-4"> 
                @csrf
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" 
                           name="search"
                           id="search"
                           class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                           placeholder="Search ..." 
                           style="width: 30%;">
                </div>
            </form>
            
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Author</th>
                            <th scope="col" class="px-6 py-3">Price</th>
                            <th scope="col" class="px-6 py-3">Date Published</th>
                            <th scope="col" class="px-6 py-3">Publisher</th>
                            <th scope="col" class="px-6 py-3">Page Count</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td scope="row" class="px-6 py-4">{{ ++$no }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $book->title }}</td>
                                <td class="px-6 py-4">{{ $book->author }}</td>
                                <td class="px-6 py-4">{{ "Rp ".number_format($book->price, 2, ',', '.') }}</td>
                                <td class="px-6 py-4">{{ $book->date_published->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">{{ $book->publisher }}</td>
                                <td class="px-6 py-4">{{ $book->page_count }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="flex gap-1">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('books.show', $book->book_seo) }}" class="btn btn-primary">Detail</a>
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-success">Edit</a>
                                        <button type="submit" class="btn bg-red-500 hover:bg-red-600 text-white" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-center">
                    <div>{{ $books->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    @else
        <div class="flex justify-center">
            <div class="container">
                <div class="flex justify-center">
                    <div class="alert alert-warning text-center mt-12 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        <h4>Tidak ditemukan buku dengan kata kunci <strong>{{ $search }} </strong></h4>
                    </div>
                </div>
                <div class="flex justify-center my-4">
                    <a href="{{ route('books.index') }}" class="btn btn-warning">Back</a>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>