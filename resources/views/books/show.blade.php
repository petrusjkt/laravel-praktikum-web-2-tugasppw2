<x-app-layout>

<div class="flex justify-center pb-10">
    <div class="container">
        <h1 class="text-center m-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Book Detail</h1>
        <div class="flex justify-center">
            <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" style="min-width: 70%">
                <img src="{{ $book->cover_url }}" alt="Book Cover" class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $book->title }}</h2>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $book->description }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Author: {{ $book->author }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Date Published: {{ $book->date_published->format('d F Y') }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Publisher: {{ $book->publisher }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Page Count: {{ $book->page_count }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Price: {{ "Rp ".number_format($book->price, 2, ',', '.') }}</p>
                    <div class="flex justify-between">
                        @include('components.add-to-favorites-button', [
                            'isBookInFavorites' => $book->isBookFavouritedByUser(auth()->user()),
                            'bookId' => $book->id
                        ])
                        <a href="{{ route('books.index') }}" class="text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mx-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-24">Back</a>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="text-center m-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Gallery</h1>
        <div class="flex justify-center">
            @if ($book->galleries->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 bg-white border border-gray-200 rounded-lg shadow md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" 
                    style="min-width: 70%">
                    @foreach ($book->galleries as $gallery)
                        <div class="grid grid-item gap-4">
                            <div>
                                <a href="{{ $gallery->image_url }}"
                                    data-lightbox="image-1"
                                    data-title="{{ $gallery->title }}"
                                    class="h-auto max-w-full rounded-lg">
                                    <img src="{{ $gallery->image_url }}" alt="Book Gallery" class="h-auto max-w-full rounded-lg">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex justify-center bg-white border border-gray-200 rounded-lg shadow max-h-96 md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" style="min-width: 70%">
                    <div class="p-4 leading-normal">
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">This book has no gallery</h2>
                    </div>
                </div>
            @endif
        </div>

        <h1 class="text-center m-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Rating</h1>
        <div class="flex flex-col justify-center items-center">
            @if ($book->ratings->count() > 0)
                <div class="flex justify-center gap-4 p-4 bg-white border border-gray-200 rounded-lg shadow md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" 
                    style="min-width: 70%">
                    {{-- Dislay average rating --}}
                    <div class="my-3 text-center">
                        <h2 class="text-xl font-semibold mb-2 dark:text-white">Average Rating</h2>
                        <div class="flex items-center justify-center">
                            <div class="mr-2">
                                <!-- Display stars based on the average rating -->
                                <div class="flex text-yellow-400 text-3xl">
                                    @for ($i = 0; $i < floor($book->ratings->avg('rating')); $i++)
                                        <svg class="h-8 w-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor">
                                            <defs>
                                                <linearGradient id="fullstar">
                                                <stop offset="100%" stop-color="rgb(250 204 21 / var(--tw-text-opacity)"/>
                                                </linearGradient>
                                            </defs>
                                            <path fill="url(#fullstar)" d="M20.388,10.918L32,12.118l-8.735,7.749L25.914,31.4l-9.893-6.088L6.127,31.4l2.695-11.533L0,12.118 l11.547-1.2L16.026,0.6L20.388,10.918z"/>
                                        </svg>
                                    @endfor
                                    <!-- If the rating has a decimal part, display a half star -->
                                    @if ($book->ratings->avg('rating') - floor($book->ratings->avg('rating')) > 0)
                                        <svg class="h-8 w-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor">
                                            <defs>
                                                <linearGradient id="halfstar">
                                                  <stop offset="50%" stop-color="rgb(250 204 21 / var(--tw-text-opacity)"/>
                                                  <stop offset="50%" stop-color="transparent"/>
                                                </linearGradient>
                                              </defs>
                                            <path fill="url(#halfstar)" d="M20.388,10.918L32,12.118l-8.735,7.749L25.914,31.4l-9.893-6.088L6.127,31.4l2.695-11.533L0,12.118 l11.547-1.2L16.026,0.6L20.388,10.918z"/>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <!-- Display the average rating value -->
                            <span class="text-gray-600 text-2xl dark:text-white">{{ number_format($book->ratings->avg('rating'), 2) }}</span>
                        </div>
                    </div>
                    {{-- @foreach ($book->ratings as $rating)
                        <div class="grid grid-item gap-4">
                            <div>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Rating: {{ $rating->rating }}</p>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Comment: {{ $rating->comment }}</p>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">User: {{ $rating->user->name }}</p>
                            </div>
                        </div>
                    @endforeach --}}
                </div>
            @else
                <div class="flex justify-center bg-white border border-gray-200 rounded-lg shadow max-h-96 md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" style="min-width: 70%">
                    <div class="p-4 leading-normal">
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Rating is not available</h2>
                    </div>
                </div>
            @endif

            {{-- Formnput to rate --}}
            <div class="flex justify-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" style="min-width: 70%">
                <div class="p-4  leading-normal">
                    <form action="{{ route('books.rate', $book->id) }}" method="POST">
                        <h2 class="text-xl mb-4 font-semibold dark:text-white">Rate this book</h2>
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="rating" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Rating</label>
                            <select name="rating" 
                                   id="rating" 
                                   class="block w-full p-4 text-sm dark:text-gray-300 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Rating" 
                                   required>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Very Good</option>
                                    <option value="3">3 - Good</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Comment</label>
                            <textarea name="comment" 
                                      id="comment" 
                                      cols="30" 
                                      rows="10" 
                                      class="block w-full p-4 text-sm dark:text-gray-300 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:ring-blue-500 focus:border-blue-500" 
                                      placeholder="Comment"></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Rate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>