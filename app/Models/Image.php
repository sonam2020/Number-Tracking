<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'image',
    ];
    
    
    public function tickets()
{
    return $this->hasMany(Ticket::class, 'image_id');
}

}
