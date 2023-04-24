<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    User,
    Production,
    finishing,
    OffsetProduction,
    OffsetFinishing
};

class Offset extends Model
{
    use HasFactory;

    protected $table = 'offsets';
    protected $guarded = ['id'];

    public function getAllOffsets()
    {
        return $this->with(['user','production'])->orderBy('nama_konsumen');
    }

    public function getAllProductions()
    {
        return Production::all();
    }

    public function getAllFinishings()
    {
        return Finishing::all();
    }

    public function getOffsetById($id)
    {
        return $this->with(['offsetproduction'])->findOrFail($id);
    }

    public function countOffsets()
    {
        return $this->count();
    }

    public function countOffsetProcess()
    {
        return $this->where('status_offset', '=', '0')->count();
    }

    public function countOffsetAccept()
    {
        return $this->where('status_offset', '=', '1')->count();
    }

    public function countOffsetProductionProcess()
    {
        return $this->where('status_offset', '=', '1')
                    ->where('status_produksi', '=', '0')
                    ->count();
    }

    public function countOffsetProductionFinish()
    {
        return $this->where('status_produksi', '=', '1')->count();
    }

    public function countOffsetFinishingProcess()
    {
        return $this->where('status_produksi', '=', '1')
                    ->where('status_finishing', '=', '0')
                    ->count();
    }

    public function countOffsetFinishingFinish()
    {
        return $this->where('status_finishing', '=', '1')->count();
    }

    //Relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function offsetproduction()
    {
        return $this->hasMany(OffsetProduction::class);
    }

    public function production()
    {
        return $this->belongsToMany(Production::class, 'offset_production', 'offset_id', 'production_id');
    }

    public function finishing()
    {
        return $this->belongsToMany(Finishing::class, 'offset_finishing', 'offset_id', 'finishing_id');
    }

    public function offsetfinishing()
    {
        return $this->hasMany(OffsetFinishing::class);
    }
}
