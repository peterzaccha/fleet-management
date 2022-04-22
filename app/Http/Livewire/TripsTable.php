<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use App\Models\Trip;
use Livewire\Component;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class TripsTable extends DataTableComponent
{
    protected $model = Trip::class;

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
            Column::make('Cities', 'id')
                ->collapseOnTablet()
                ->view("trips.cities"),
            Column::make('Bookings', 'id')
                ->label(fn ($row) => Booking::whereTripId($row->id)->count()),
            LinkColumn::make("Edit")
                ->title(fn ($row) => "Edit")
                ->location(function ($row) {
                    return route("trips.edit", $row);
                }),
        ];
    }
}
