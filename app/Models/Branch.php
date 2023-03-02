<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory , SoftDeletes;
    public function company(){
        return $this->belongsTo(Company::class);
    }



    public function users(){
        return $this->hasMany(User::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
