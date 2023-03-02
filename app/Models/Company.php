<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory , SoftDeletes;
    public function branches(){
        return $this->hasMany(Branch::class);
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($country) {
            $country->branches()->delete();

        });
    }
}
