<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'empresa_id'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function company()
    {
        return $this->hasOne(Empresa::class);
    }

    public function admin()
    {
        return $this->hasOne(AdminUser::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'team_collection', 'team_id', 'collection_id');
    }
}


