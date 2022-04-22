<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\User;
use Livewire\Component;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class UsersTable extends DataTableComponent
{

    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Id')
                ->sortable()
                ->searchable(),
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Email')
                ->sortable()
                ->searchable(),
            BooleanColumn::make('Is Admin'),
        ];
    }
}
