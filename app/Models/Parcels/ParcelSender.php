<?php

namespace App\Models\Parcels;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class ParcelSender extends Model
{
    use HasFactory;
    use AsSource;

    protected $table = 'parcel_senders';

    protected $fillable = ['name', 'user_id'];

}
