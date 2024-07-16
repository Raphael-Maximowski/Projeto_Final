<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $guarded = []; 

    public function user()
    {
        return $this->belongsTo(User::class); // uma coleção pertence a um usuário
    }

    public function funnels()
    {
        return $this->hasMany(Funnel::class); // uma coleção pode ter vários funis
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_collection', 'collection_id', 'team_id');
    }
}
