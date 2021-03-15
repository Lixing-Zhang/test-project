<?php

namespace App\Http\Livewire;

use App\Events\ContactCreated;
use App\Models\Contact;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use Livewire\WithFileUploads;

class Contacts extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows, WithFileUploads;

    public bool $showEditModal = false;
    public bool $showDeleteModal = false;

    public ?Contact $editing = null;

    public $avatar;

    public array $rules = [
        'editing.full_name' => 'required|string|max:50',
        'editing.email' => 'required|email',
        'editing.address' => 'required|string',
        'avatar' => 'nullable|image|max:1024',
    ];


    public function updatedProfile()
    {
        $this->validate([
            'avatar' => 'image|max:1024',
        ]);
    }

    public function create()
    {
        $this->useCachedRows();

        $this->editing = Contact::make();

        $this->showEditModal = true;

        $this->resetValidation();
    }

    public function edit(Contact $contact)
    {
        $this->useCachedRows();

        $this->editing = $contact;

        $this->showEditModal = true;
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
    }

    public function save()
    {
        $this->validate();

        $create = false;

        if (!$this->editing->id) {
            $create = true;
        }

        $this->editing->save();

        $this->avatar && $this->editing->update([
            'avatar' => $this->avatar->store('/', 'public'),
        ]);

        $this->showEditModal = false;

        $this->notify('Contact saved');

        if ($create) {
            ContactCreated::dispatch($this->editing);
        }
    }

    public function getRowsQueryProperty(): Builder
    {
        $query = Contact::query();

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function render()
    {
        return view('livewire.contacts', [
            'contacts' => $this->rows
        ]);
    }
}
