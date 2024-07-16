<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
    use HasFactory;

    protected $guarded = []; 

    public function users()
    {
        return $this->belongsToMany(User::class); // um funil pode pertencer a vários usuários
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class); // um funil pertence a uma coleção
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }
}


