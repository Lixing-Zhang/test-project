<?php

namespace App\Http\Livewire\DataTable;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

trait WithBulkActions
{
    use WithCachedRows;

    public bool $selectPage = false;
    public bool $selectAll = false;
    public array $selected = [];

    public function renderingWithBulkActions()
    {
        if ($this->selectAll) {
            $this->selectPageRows();
        }
    }

    public function updatedSelected()
    {
        $this->useCachedRows();

        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function updatedSelectPage($value)
    {
        $this->useCachedRows();

        if ($value) {
            return $this->selectPageRows();
        }

        $this->selectAll = false;
        $this->selected = [];
    }

    public function selectPageRows()
    {
        $this->useCachedRows();

        $this->selected = $this->rows->pluck('id')->map(fn($id) => (string) $id)->all();
    }

    public function selectAll()
    {
        $this->selectAll = true;
    }

    public function getSelectedRowsQueryProperty()
    {
        return (clone $this->rowsQuery)
            ->unless($this->selectAll, fn($query) => $query->whereKey($this->selected));
    }

    abstract public function getRowsQueryProperty(): Builder;

    abstract public function getRowsProperty();
}
