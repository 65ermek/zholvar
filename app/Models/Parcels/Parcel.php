<?php

namespace App\Models\Parcels;

use App\Models\User;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Parcel extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;


    protected $table = 'parcels';

    protected $fillable = ['num', 'barcode', 'phone', 'name', 'last_name', 'email', 'user_id', 'status', 'insurance', 'weight', 'packagerecepient_id', 'parcelsender_id'];

    protected $allowedSorts = [
        'barcode'
    ];
    protected $allowedFilters = [
        'num'
    ];
    public function senders(): BelongsTo
    {
        return $this->belongsTo(ParcelSender::class, 'parcelsender_id');
    }
    public function recepients(): BelongsTo
    {
        return $this->belongsTo(PackageRecepient::class, 'packagerecepient_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->isoformat("D MMMM Y");
    }
}
