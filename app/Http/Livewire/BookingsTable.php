<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use Livewire\Component;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class BookingsTable extends DataTableComponent
{

    protected $model = Booking::class;

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
            Column::make('User', 'user.name')
                ->sortable()
                ->searchable(),
            Column::make('From', 'start_id')
                ->collapseOnMobile()
                ->view("bookings.city"),
            Column::make('To', 'end_id')
                ->collapseOnMobile()
                ->view("bookings.city"),
            LinkColumn::make("Edit")
                ->title(fn ($row) => "Edit")
                ->location(function ($row) {
                    return route("cities.edit", $row);
                }),
        ];
    }
}
