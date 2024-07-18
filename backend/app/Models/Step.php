<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'posicao',
        'funnel_id',
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function funnel()
    {
        return $this->belongsTo(Funnel::class);
    }
}
