<?php

namespace App\Orchid\Screens\Companies;

use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class CompanyListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Информация о пользователе';
    public $description = 'Информация о пользователе';
    public $permission = 'platform.companies';


    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'company' => User::where('id', auth()->id())->firstOrFail(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            ModalToggle::make('Добавить информацию')->modal('editInfo')->method('update'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */


    public function layout(): array
    {
        if (!empty($this->query)) {
            $this->query->get('company');
        }
        return [
            Layout::columns([
                Layout::legend('company', [
                    Sight::make('num'),
                    Sight::make('name'),
                    Sight::make('last_name'),
                    Sight::make('status'),
                    Sight::make('type'),
                ])->title(' Основная информация '),
                Layout::legend('company', [
                    Sight::make('street'),
                    Sight::make('post'),
                    Sight::make('city'),
                    Sight::make('ico'),
                    Sight::make('dic'),
                ])->title('Платёжные данные'),
                Layout::legend('company', [
                    Sight::make('phone'),
                    Sight::make('email'),
                    Sight::make('web'),
                    Sight::make('state'),
                ])->title('Контакты'),
            ]),
            Layout::modal('editInfo', Layout::rows([
                Input::make('company.id')->type('hidden'),
                Group::make([
                    Input::make('company.phone')->title('Телефон компании')->required(),
                    Input::make('company.email')->type('email')->title('Email компании')->disabled(),
                ]),
                Group::make([
                    Input::make('company.name')->title('Название компании')->disabled(),
                    Input::make('company.last_name')->title('Фамилия и Имя'),
                ]),
                Group::make([
                    Input::make('company.ico')->title('Регистрационный номер'),
                    Input::make('company.dic')->title('Номер налогоплательщика'),
                ]),
                Group::make([
                    Input::make('company.street')->title('Улица и номер дома'),
                    Input::make('company.post')->title('Индекс'),
                ]),
                Input::make('company.city')->title('Населённый пункт'),
                Input::make('company.web')->title('Ваша интернет страница'),
                Select::make('company.type')->title('Тип')->options([
                    'company' => 'Компания',
                    'e_shop' => 'E-shop',
                    'person' => 'Частное лицо',
                ]),
                Input::make('company.description')->title('Примечание'),
            ]))->title('Добавление информации'),
        ];
    }

    public function update(Request $request)
    {
        User::find($request->input('company.id'))->update(array_merge($request->company, [
            'state' => 'Казахстан'
        ]));
        Toast::info('Ваши данные добавлены');
    }
}
