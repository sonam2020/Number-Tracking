<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'area',
        'image_id',
        'number',
        'amount',
        'direction',
        'mix',
        'status',
    ];
    
    public function image()
{
    return $this->belongsTo(Image::class, 'image_id');
}

    
    public function area()
    {
        return $this->belongsTo(Area::class, 'area', 'id');
    }

}
