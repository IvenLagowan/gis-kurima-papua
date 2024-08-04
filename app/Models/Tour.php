<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $table = "tours";
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
