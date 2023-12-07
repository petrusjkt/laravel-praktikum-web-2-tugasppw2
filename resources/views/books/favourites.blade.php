<x-app-layout>

<div class="flex justify-center">
    <div class="container">
        <h1 class="text-center mt-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Favourites Books</h1>
        
        <h3 class="text-center text-3xl dark:text-white">total: {{ $bookCount }}</h3>
        <h3 class="text-center text-3xl dark:text-white">price total: {{ "Rp ".number_format($priceSum, 2, ',', '.') }}</h3>
    
        <div class="flex justify-center">
            <div class="my-4 flex justify-center">
                <a href="{{ route('books.index') }}" class="btn btn-primary px-8">Back</a>
            </div>
        </div>
    
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-5 py-3 text-center">No</th>
                        <th scope="col" class="px-5 py-3 text-center">Title</th>
                        <th scope="col" class="px-5 py-3 text-center">Author</th>
                        <th scope="col" class="px-5 py-3 text-center">Price</th>
                        <th scope="col" class="px-5 py-3 text-center">Date Published</th>
                        <th scope="col" class="px-5 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td scope="row" class="px-6 py-4">{{ ++$no }}</td>
                            <td class="px-5 py-4 flex flex-col items-center">
                                <span class="font-medium text-xl text-gray-900 whitespace-nowrap dark:text-white py-2">
                                    {{ $book->title }}
                                </span>
                                <img src="{{ $book->cover_url }}" alt="book cover">
                            </td>
                            <td class="px-5 py-4">{{ $book->author }}</td>
                            <td class="px-5 py-4">{{ "Rp ".number_format($book->price, 2, ',', '.') }}</td>
                            <td class="px-5 py-4">{{ $book->date_published->format('d F Y') }}</td>
                            <td class="px-5 py-4">
                                <a href="{{ route('books.show', $book->book_seo) }}" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                    @if (count($books) == 0)
                        <tr>
                            <td colspan="6" class="px-5 py-3 text-lg font-bold text-center">You don't have a favorite book</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="flex justify-center">
                <div>{{ $books->links() }}</div>
            </div>
        </div>
    </div>


</div>

</x-app-layout>

