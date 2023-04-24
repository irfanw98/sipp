<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offset;

class Production extends Model
{
    use HasFactory;

    protected $table = 'productions';
    protected $guarded = ['id'];

    public function getAllProductions(): Collection
    {
        return $this->with('offset.user')->latest()->get();
    }

    public function getProductionById($id)
    {
        return $this->with('offset')->findOrFail($id);
    }

    public function getAllOffsets(): Collection
    {
        return Offset::with('production')->where('status', '=', '1')
                ->orderBy('nama_konsumen', 'asc')
                ->get();
    }

    public function offset()
    {
        return $this->belongsToMany(Offset::class, 'offset_production', 'production_id', 'offset_id');
    }

    public function offsetproduction()
    {
        return $this->hasMany(Offset::class);
    }
}