<?php

namespace App\Http\Livewire\DataTable;

use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;

trait WithPerPagePagination
{
    use WithPagination;

    public int $perPage = 10;

    public function mountWithPerPagePagination()
    {
        $this->perPage = session()->get('perPage', $this->perPage);
    }

    public function updatedPerPage(int $value)
    {
        session()->put('perPage', $value);
    }

    public function applyPagination(Builder $query)
    {
        return $query->paginate($this->perPage);
    }
}
