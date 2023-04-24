<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offset;

class Finishing extends Model
{
    use HasFactory;

    protected $table = 'finishings';
    protected $guarded = ['id'];

    public function getAllFinishings()
    {
        return $this->with('production.offset')->latest()->get();
    }

    public function getAllProductions()
    {
        return Production::with('offset')->where('status', '=', '1')->get();
    }

    public function offset()
    {
        return $this->belongsToMany(Offset::class, 'offset_finishing', 'finishing_id', 'offset_id');
    }

    public function offsetfinishing()
    {
        return $this->hasMany(Offset::class);
    }
}