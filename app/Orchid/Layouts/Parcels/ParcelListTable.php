<?php

namespace App\Orchid\Layouts\Parcels;

use App\Models\Parcels\Parcel;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Color;


class ParcelListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'parcels';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('created_at','Дата подачи')->width('150px'),
            TD::make('num', 'Номер'),
            TD::make('barcode', 'Штрих код'),
            TD::make('phone', 'Телефон'),
            TD::make('email', 'Email получателя'),
            TD::make('name', 'Имя получателя'),
            TD::make('last_name', 'Фирма получателя'),
            TD::make('parcelsender_id', 'Отправитель')
                ->render(function (Parcel $parcel){
                    return optional($parcel->senders)->name;}),
            TD::make('packagerecepient_id', 'Пункт приёма-выдачи')
                ->render(function (Parcel $parcel){
                    return optional($parcel->recepients)->name;}),
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
            TD::make('action','Выберите действие')
                ->width('200px')
                ->render(function (Parcel $parcel) {
                    return Group::make(
                        [
                            ModalToggle::make()
                                ->icon('pencil')
                                ->modal('editParcel')->method('updateParcel')
                                ->modalTitle('Редактирование посылки'. '  ' . $parcel->num)
                                ->asyncParameters([
                                    'parcel' => $parcel->id
                                ]),

                            Button::make()
                                ->icon('trash')
                                ->confirm('Как только запись будет удалена, все ее ресурсы и данные будут удалены безвозвратно. Перед удалением вашей записи, пожалуйста, загрузите любые данные или информацию, которые вы хотите сохранить.')
                                ->method('deleteParcel')
                                ->type(Color::DANGER())
                                ->parameters([
                                    'parcel' => $parcel->id
                                ]),

                        ]);
                }),
        ];
    }
}
