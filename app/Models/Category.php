<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

        protected $fillable = [
        'name',
        'family_id',
    ];
    //
    public function family()
    {
        return $this->belongsTo(Family::class);
    }


        public function subcategories()
    {
        return $this->hasmany(Subcategory::class);
    }
}
