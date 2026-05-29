<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
     protected $fillable = [
        'kegiatan_id',
        'uploaded_by',
        'judul',
        'deskripsi',
        'file_path',
        'file_name',
        'file_type',
        'mime_type',
        'file_size',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Schedule::class, 'kegiatan_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
