<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = [
        'user_id',
        'title',
        // 'author',
        'publisher',
        'genre',
        'price',
        'published_at',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // protected $guarded = ['id'];  #Khusus Kolom yang tidak diisi secara manual di definisikan menggunakan guarded

}
