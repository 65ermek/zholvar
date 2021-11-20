<?php

namespace App\Models\Parcels;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class ParcelSender extends Model
{
    use HasFactory;
    use AsSource;

    protected $table = 'parcel_senders';

    protected $fillable = ['name', 'user_id'];
    public function recepient(): BelongsTo
    {
        return $this->belongsTo(Parcel::class, 'parcelsender_id');
    }

}
