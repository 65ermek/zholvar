<?php

namespace App\Orchid\Layouts\Admin;

use App\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Color;

class PointListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'points';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('created_at','Время регистрации')->width('200px'),
            TD::make('num', 'Порядковый номер')->width('150px'),
            TD::make('status', 'Статус')->sort(),
            TD::make('name', 'Название'),
            TD::make('phone', 'Телефон')->filter(TD::FILTER_TEXT),
            TD::make('action', 'Действия')
                ->width('130px')
                ->render(function (User $points){
                    return Group::make(
                        [
                            ModalToggle::make()
                                ->icon('pencil')
                                ->type(Color::SUCCESS())
                                ->modal('editPoint')->method('update')
                                ->modalTitle('Редактирование'.'  '.$points->name)
                                ->asyncParameters([
                                    'sender' => $points->id
                                ]),

                            Button::make()
                                ->icon('trash')
                                ->confirm('Как только запись будет удалена, все ее ресурсы и данные будут удалены безвозвратно. Перед удалением вашей записи, пожалуйста, загрузите любые данные или информацию, которые вы хотите сохранить.')
                                ->method('deleteSenders')
                                ->type(Color::DANGER())
                                ->parameters([
                                    'sender' => $points->id
                                ]),

                        ]);
                })
        ];
    }
}
