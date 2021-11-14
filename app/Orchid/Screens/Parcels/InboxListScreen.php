<?php

namespace App\Orchid\Screens\Parcels;

use App\Models\Parcels\PackageRecepient;
use App\Models\Parcels\Parcel;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class InboxListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Ожидаемые посылки';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $parcelIdsItesm = PackageRecepient::where('user_id', Auth::id())->pluck('parcel_id')->toArray();
        return [
            'parcels' => Parcel::query()->when($parcelIdsItesm, function ($query, $parcelIdsItesm) {return $query->whereIn('id', $parcelIdsItesm);})->paginate(10),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::table('parcels', [
                TD::make('created_at','Дата подачи')->width('150px')->render(function (Parcel $parcel){
                    return $parcel->created_at;
                }),
                TD::make('barcode', 'Штрих код'),
                TD::make('parcelsender_id', 'Отправитель')
                    ->render(function (Parcel $parcel){
                        return optional($parcel->senders)->name;}),
                TD::make('name', 'Имя получателя'),
                TD::make('last_name', 'Фирма получателя'),
                TD::make('status', 'Статус')->render(function (Parcel $parcel){
                    $status = 'status';
                    switch ($parcel->status) {
                        case 'pending_reception':
                            $status = 'В ожидании подачи';
                            break;
                        case 'in_transit':
                            $status= 'В пути';
                            break;
                        case 'delivered':
                            $status='Доставлено';
                            break;
                    }
                    return $status;
                }),
                TD::make('created_at','Дата выдачи')
            ])
        ];
    }
}
