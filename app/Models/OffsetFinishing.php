<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Offset,
    Finishing
};

class OffsetFinishing extends Model
{
    use HasFactory;

    protected $table = 'offset_finishing';

    public function getAllOffsetFinishing()
    {
        return Offset::with('finishing')
                    ->where(['status_offset' => '1', 'status_produksi' => '1'])
                    ->latest();
    }

    public function getOffsetFinishingById($id)
    {
        return Offset::with('finishing')->findOrFail($id);
    }

    public function getAllFinishings()
    {
        return Finishing::all();
    }

    public function offset()
    {
        return $this->belongsTo(Offset::class);
    }

    public function finishing()
    {
        return $this->belongsTo(Finishing::class);
    }
}
