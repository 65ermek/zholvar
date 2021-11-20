<?php

namespace App\Orchid\Screens\Parcels;

use App\Models\Parcels\PackageRecepient;
use App\Models\Parcels\Parcel;
use App\Models\Parcels\ParcelSender;
use App\Orchid\Layouts\Parcels\ParcelListTable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use TheSeer\Tokenizer\Exception;

class ParcelListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Почтовая посылка';

    public $description = 'Почтовая посылка';

    public $permission = 'platform.parcels';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {

        return [
            'parcels' => Parcel::query()->when(Auth::user(), function ($query) {return $query->where('user_id', Auth::id());})->paginate(10)

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
            ModalToggle::make('Послать новую посылку')->modal('createParcel')->method('create')->type(Color::PRIMARY()),
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
            $this->query->get('parcels');
        }
        return [
            ParcelListTable::class,
            Layout::modal('createParcel', Layout::rows([
                Input::make('num')->required()->title('Порядковый номер'),
                Group::make([
                    Input::make('phone')->required()->title('Телефон'),
                    Input::make('email')->required()->type('email')->title('Email'),
                ]),
                Group::make([
                    Input::make('name')->required()->title('Имя получателя'),
                    Input::make('last_name')->required()->title('Фирма получателя'),
                ]),
                Group::make([
                    Input::make('weight')->required()->title('Вес посылки'),
                    Input::make('insurance')->required()->title('Страховая стоимость'),
                ]),
                Relation::make('packagerecepient_id')->fromModel(PackageRecepient::class, 'name')->title('Пункт приёма-выдачи посылки')->required(),
            ]))->title('Создать новую посылку')->applyButton('Создать'),
            Layout::modal('editParcel', Layout::rows([
                Input::make('parcel.id')->type('hidden'),
                Input::make('parcel.num')->required()->title('Порядковый номер'),
                Group::make([
                    Input::make('parcel.phone')->required()->title('Телефон'),
                    Input::make('parcel.email')->required()->type('email')->title('Email'),
                ]),
                Group::make([
                    Input::make('parcel.name')->required()->title('Имя получателя'),
                    Input::make('parcel.last_name')->required()->title('Фирма получателя'),
                ]),
                Group::make([
                    Input::make('parcel.weight')->required()->title('Вес посылки'),
                    Input::make('parcel.insurance')->required()->title('Страховая стоимость'),
                ]),
                Relation::make('parcel.packagerecepient_id')->fromModel(PackageRecepient::class, 'name')->title('Пункт приёма-выдачи посылки')->required(),
            ]))->async('asyncGetParcel')
        ];
    }

    public function asyncGetParcel(Parcel $parcel):array
    {
        return [
            'parcel' => $parcel
        ];
    }

    public function updateParcel(Request $request)
    {
        Parcel::find($request->input('parcel.id'))->update($request->parcel);
        Toast::info('Изменения внесены');
    }

    public function create(Request $request): void
    {
        $request->validate([
            'num' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'name' => ['required'],
            'last_name' => ['required'],
            'weight' => ['required'],
            'insurance' => ['required'],
//            'parcelsender_id' => ['exists:parcel_senders,id', 'required'],
        ]);
        Parcel::create($request->merge([
            'status' => 'pending_reception',
            'barcode' => IdGenerator::generate(['table' => 'parcels','field'=>'barcode', 'length' => 10, 'prefix' =>'P']),
            'user_id' => Auth::user()->id,
            'parcelsender_id' => ParcelSender::where('user_id', Auth::user()->id)->first()->id,
        ])->except('_token'));
        Toast::info('Новая посылка включена в систему');
    }
    public function deleteParcel($parcel_id, $parcelSender_id)
    {
        $parcel = Parcel::where('id', $parcel_id)->first();
        DB::beginTransaction();
        try {
            if ($parcel != null) {
                $parcel->delete();
            }
            Toast::info('Ваша запись успешно удалена');
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Toast::info('Ошибка! Вы не можете удалить эту запись');
        }
    }
}
