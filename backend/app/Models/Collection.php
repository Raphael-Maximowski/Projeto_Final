<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsToMany(User::class); //uma coleção para vários users
    }

    public function funnels()
    {
        return $this->hasMany(Funnel::class); //pode ter varios funis associados a uma coleção
    }
}
