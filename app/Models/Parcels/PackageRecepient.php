<?php

namespace App\Models\Parcels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class PackageRecepient extends Model
{
    use HasFactory;
    use AsSource;

    protected $table = 'package_recepients';

    protected $fillable = ['name', 'user_id', 'parcel_id'];

    public function recepient(): BelongsTo
    {
        return $this->belongsTo(Parcel::class, 'packagerecepient_id');
    }
}
