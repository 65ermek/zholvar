<?php

namespace App\Orchid\Screens\Admin;

use App\Models\User;
use App\Orchid\Layouts\Admin\PointListTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;


class PointListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Пункты приёма-выдачи';
    public $permission = 'platform.points';
    public $description = 'В этом разделе Ваша задача: присвоить порядковый номер и активировать в системе.
                            Если не заполнены поля в таблице, позвонить клиенту, и заполнить поля самостоятельно.';



    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'points' => User::whereHas('roles', function (Builder $query) {$query->where('slug', 'point');})
                ->filters()
                ->defaultSort('status', 'desc')
                ->paginate(10),

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
                PointListTable::class,
                Layout::modal('editPoint', Layout::rows([
                    Input::make('point.id')->type('hidden'),
                    Group::make([
                        Input::make('point.num')->required()->title('Порядковый номер в системе'),
                        Select::make('point.status')->required()->title('Активация в системе')->options([
                            'active' => 'Активен',
                            'not_active' => 'Неактивен',
                        ]),
                    ]),
                    Group::make([
                        Input::make('point.phone')->disabled()->title('Номер телефона'),
                        Input::make('point.name')->disabled()->title('Название фирмы'),
                    ]),
                ]))->title('Активировать и присвоить порядковый номер')->applyButton('Активировать')
                    ->async('asyncGetPoint'),
            ];
    }
    public function asyncGetPoint(User $points): array
    {
        return [
            'point' => $points
        ];
    }

    public function update(Request $request)
    {
        User::find($request->input('point.id'))->update($request->point);
        Toast::info('Активация прошла успешно');
    }
    public function deleteSenders($points_id)
    {
        $points = User::where('id', $points_id)->first();

        if ($points != null) {
            $points -> delete();
            return redirect()->route('platform.senders');
        }
        Toast::info('Ваша запись успешно удалена');
    }

}
