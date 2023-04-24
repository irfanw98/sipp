<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Offset,
    Production
};

class OffsetProduction extends Model
{
    use HasFactory;

    protected $table = 'offset_production';

    public function getAllOffsetProduction()
    {
        return Offset::with('production')
                    ->where('status_offset', '=', '1')
                    ->latest()
                    ->get();
    }

    public function getOffsetProductionById($id)
    {
        return Offset::with('production')->findOrFail($id);
    }

    public function getAllProductions()
    {
        return Production::all();
    }

    public function offset()
    {
        return $this->belongsTo(Offset::class);
    }

    public function production()
    {
        return $this->belongsTo(Production::class);
    }
}