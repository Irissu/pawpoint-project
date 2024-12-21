<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\AppointmentStatus;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'vet_id',
        'owner_id',
        'pet_id', 
        'slot_id',
        'status',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => AppointmentStatus::class,
    ];

    // relaciones

    public function ownerUser()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function vetUser()
    {
        return $this->belongsTo(User::class, 'vet_id');
    }

    public function slot()
    {
        return $this->belongsTo(Slot::class);
        
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
