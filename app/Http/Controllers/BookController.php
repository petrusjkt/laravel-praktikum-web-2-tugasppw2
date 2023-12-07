<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageSize = 10;
        $books = Book::orderBy('id', 'desc')->paginate($pageSize);
        $no = $pageSize * ($books->currentPage() - 1);
        $bookCount = Book::count();
        $priceSum = Book::sum('price');

        return view('books.index', compact('books', 'no', 'bookCount', 'priceSum'));
    }

    public function indexFavourites()
    {
        $pageSize = 10;
        $books = auth()->user()->favouriteBooks()->orderBy('id', 'desc')->paginate($pageSize);
        $no = $pageSize * ($books->currentPage() - 1);
        $bookCount = auth()->user()->favouriteBooks()->count();
        $priceSum = auth()->user()->favouriteBooks()->sum('price');

        return view('books.favourites', compact('books', 'no', 'bookCount', 'priceSum'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $pageSize = 10;
        $books = Book::where('title', 'like', '%'.$search.'%')
            ->orWhere('author', 'like', '%'.$search.'%')
            ->orderBy('id', 'desc')
            ->paginate($pageSize);
        $no = $pageSize * ($books->currentPage() - 1);
        $bookCount = Book::where('title', 'like', '%'.$search.'%')
            ->orWhere('author', 'like', '%'.$search.'%')
            ->count();
        $priceSum = Book::sum('price');

        return view('books.search', compact('books', 'no', 'bookCount', 'priceSum', 'search'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required',
            'date_published' => 'required|date',
            'publisher' => [Rule::excludeIf($request->publisher == null), 'string'],
            'description' => [Rule::excludeIf($request->description == null), 'string'],
            'price' => 'required|integer|min:0',
            'page_count' => [Rule::excludeIf($request->page_count == null), 'integer', 'min:0'],
        ]);

        $data['book_seo'] = Str::slug($data['title'], '-');

        Book::create($data);
        
        return redirect()->route('books.index')->with('success_message', 'Book has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show($url_parameter)
    {
        $book = Book::where('book_seo', $url_parameter)->firstOrFail();
        return view('books.show', compact('book'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $book = Book::find($book->id);
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $book = Book::find($book->id);

        $validated = $request->validated();

        $book->update([
            'title' => $validated['title'] ?? $book->title,
            'author' => $validated['author'] ?? $book->author,
            'date_published' => $validated['date_published'] ?? $book->date_published,
            'publisher' => $validated['publisher'] ?? $book->publisher,
            'description' => $validated['description'] ?? $book->description,
            'price' => $validated['price'] ?? $book->price,
            'page_count' => $validated['page_count'] ?? $book->page_count,
            'book_seo' => Str::slug($validated['title'], '-') ?? $book->book_seo,
        ]);

        if(isset($validated['cover'])) {
            $coverImg = $validated['cover'];
            $coverImgName = $book->id . '.' . $coverImg->extension();
            $filepath = 'public/books/covers/';

            $coverImg->storeAs($filepath, $coverImgName);
            $coverUrl = config('app.url') . '/storage/books/covers/' . $coverImgName;

            Image::make(storage_path(). '/app/' . $filepath . $coverImgName)
                ->fit(240, 320)
                ->save();

            $book->update([
                'cover_url' => $coverUrl
            ]);
        }

        if(isset($validated['gallery'])) {
            foreach($validated['gallery'] as $galleryImg) {
                $galleryImgName = $galleryImg->hashName();
                $filepath = 'public/books/galleries/';

                $galleryImg->storeAs($filepath, $galleryImgName);
                $galleryUrl = config('app.url') . '/storage/books/galleries/' . $galleryImgName;

                $book->galleries()->create([
                    'name' => $galleryImgName,
                    'image_url' => $galleryUrl
                ]);
            }
        }

        return redirect()->route('books.index')->with('success_message', 'Book has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book = Book::find($book->id);
        $book->delete();
        return redirect()->route('books.index')->with('delete_message', 'Book has been deleted!');
    }

    public function rate(Request $request, Book $book)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255'
        ]);

        $user = auth()->user();

        $rating = $book->ratings()->where('user_id', $user->id)->first();

        if($rating) {
            $rating->update([
                'rating' => $validated['rating'],
                'comment' => $validated['comment']
            ]);
        } else {
            $book->ratings()->create([
                'user_id' => $user->id,
                'rating' => $validated['rating'],
                'comment' => $validated['comment']
            ]);
        }

        return redirect()->back()->with('success_message', 'Thank you for your rating!');
    }

    public function favourite(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|integer'
        ]);

        $user = auth()->user();

        $user->favouriteBooks()->toggle($validated['book_id']);

        return redirect()->back()->with('success_message', 'Book has been added to your favourite list!');
    }
}
