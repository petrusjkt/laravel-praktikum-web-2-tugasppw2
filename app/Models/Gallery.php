<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'name',
        'description',
        'gallery_seo',
        'image_url',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
