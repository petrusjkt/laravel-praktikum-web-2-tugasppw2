@props([
    'isBookInFavorites' => false, 
    'bookId'
])

<form id="addToFavoritesForm" method="POST" action="{{ route('books.toggleFavourite') }}" class="inline">
    @method('PUT')
    @csrf
    <input type="hidden" name="book_id" value="{{ $bookId }}">
    
    <button id="addToFavorites" type="submit" class="flex items-center justify-center space-x-2 px-4 py-2 rounded-md cursor-pointer {{ $isBookInFavorites ? 'bg-red-500 text-white' : 'border-gray-300 text-gray-500 border' }}">
        <svg id="heartIconOutline" class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M10 18.35l-1.45-1.32C4.53 12.36 1 9.28 1 5.5 1 3.02 3.03 1 5.5 1c1.74 0 3.41.81 4.5 2.09C11.09 1.81 12.76 1 14.5 1 16.97 1 19 3.02 19 5.5c0 3.78-3.53 6.86-8.55 11.54L10 18.35z"/>
        </svg>
        <span id="addToFavoritesText" class="{{ $isBookInFavorites ? 'text-white' : 'text-gray-500' }}">
            {{ $isBookInFavorites ? 'Remove from favorites' : 'Add this book to favorites' }}
        </span>
    </button>
</form>
