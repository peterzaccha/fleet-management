<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class CitiesTable extends DataTableComponent
{

    protected $model = City::class;

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
            LinkColumn::make("Edit")
                ->title(fn ($row) => "Edit")
                ->location(function ($row) {
                    return route("cities.edit", $row);
                }),
        ];
    }
}
