<?php

namespace App\Orchid\Screens\Admin;

use App\Models\Senders;
use App\Models\User;
use App\Orchid\Layouts\Admin\SenderListTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Map;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class SenderListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Отправители';
    public $permission = 'platform.senders';
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
            'senders' => User::whereHas('roles', function (Builder $query) {$query->where('slug', 'sender');})
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
        return array(
            SenderListTable::class,
            Layout::modal('editSender', Layout::rows([
                Input::make('sender.id')->type('hidden'),
                Group::make([
                    Input::make('sender.num')->required()->title('Порядковый номер в системе'),
                    Select::make('sender.status')->required()->title('Активация в системе')->options([
                        'active' => 'Активен',
                        'not_active' => 'Неактивен',
                    ]),
                ]),
                Group::make([
                    Input::make('sender.phone')->disabled()->title('Номер телефона'),
                    Input::make('sender.name')->disabled()->title('Название фирмы'),
                ]),
            ]))->title('Активировать и присвоить порядковый номер')->applyButton('Активировать')
        ->async('asyncGetSender'),

        );
    }

    public function asyncGetSender(User $senders): array
    {
        return [
            'sender' => $senders
        ];
    }

    public function update(Request $request)
    {
        User::find($request->input('sender.id'))->update($request->sender);
        Toast::info('Активация прошла успешно');
    }
    public function deleteSenders($senders_id)
    {
        $senders = User::where('id', $senders_id)->first();

        if ($senders != null) {
            $senders -> delete();
            return redirect()->route('platform.senders');
        }
        Toast::info('Ваша запись успешно удалена');
    }
}
