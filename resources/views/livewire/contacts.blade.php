<div>
    <div class="space-y-4">
        <div class="flex justify-between">
            <div class="w-1/4">
            </div>

            <div class="space-x-2 flex items-center">
                <x-input.group borderless paddingless for="perPage" label="Per Page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>

                <x-button.primary wire:click="create">
                    <x-icon.plus document class="mr-2" />
                    New
                </x-button.primary>
            </div>
        </div>

        <!-- Quotes Table -->
        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="pr-0 w-8">
                        @if (count($contacts))
                            <x-input.checkbox wire:model="selectPage" />
                        @endif
                    </x-table.heading>
                    <x-table.heading />
                    <x-table.heading sortable multi-column wire:click="sortBy('full_name')"
                        :direction="$sorts['full_name'] ?? null">Name
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('email')"
                        :direction="$sorts['email'] ?? null">Email
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('address')"
                        :direction="$sorts['address'] ?? null">Address
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('created_at')"
                        :direction="$sorts['created_at'] ?? null">Created
                    </x-table.heading>

                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                        <x-table.row class="bg-gray-200" wire:key="row-message">
                            <x-table.cell colspan="6">
                                @unless($selectAll)
                                    <div>
                                        <span>You have selected <strong>{{ $contacts->count() }}</strong> rows, do you
                                            want to select all <strong>{{ $contacts->total() }}</strong>?</span>
                                        <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select All
                                        </x-button.link>
                                    </div>
                                @else
                                    <span>You are currently selecting all <strong>{{ $contacts->total() }}</strong>
                                        rows.</span>
                        @endif
                        </x-table.cell>
                        </x-table.row>
                        @endif

                        @forelse ($contacts as $contact)
                            <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $contact->id }}">
                                <x-table.cell class="pr-0">
                                    <x-input.checkbox wire:model="selected" value="{{ $contact->id }}" />
                                </x-table.cell>

                                <x-table.cell>
                                    <img src="{{ $contact->avatarUrl() }}" class="w-20 h-20" />

                                </x-table.cell>

                                <x-table.cell>
                                    <span class="text-gray-600 font-medium">
                                        {{ $contact->full_name }}

                                    </span>
                                </x-table.cell>

                                <x-table.cell>
                                    <span class="text-gray-600 font-medium">{{ $contact->email }} </span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span class="text-gray-600 font-medium">{{ $contact->address }} </span>
                                </x-table.cell>

                                <x-table.cell>
                                    <span class="text-gray-600 font-medium">{{ $contact->created_at }}</span>
                                </x-table.cell>

                                <x-table.cell>

                                    <x-dropdown>
                                        <x-dropdown.item type="button" wire:click="edit({{ $contact->id }})"
                                            class="flex items-center space-x-2">
                                            <span>View/Edit</span>
                                        </x-dropdown.item>
                                        <x-dropdown.item type="button" wire:click="delete({{ $contact->id }})"
                                            class="flex items-center space-x-2">
                                            <span>Remove</span>
                                        </x-dropdown.item>
                                    </x-dropdown>
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.row>
                                <x-table.cell colspan="8">
                                    <div class="flex justify-center items-center space-x-2">
                                        <x-icon.inbox class="h-8 w-8 text-gray-400" />
                                        <span class="font-medium py-8 text-gray-400 text-xl">No Users found...</span>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @endforelse
                    </x-slot>
                </x-table>

                <div>
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>

        <!-- Delete Product Discount Modal -->
        <form wire:submit.prevent="deleteSelected">
            <x-modal.confirmation wire:model.defer="showDeleteModal">
                <x-slot name="title">Delete Contact</x-slot>

                <x-slot name="content">
                    <div class="py-8 text-gray-700">Are you sure you? This action is irreversible.</div>
                </x-slot>

                <x-slot name="footer">
                    <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>

                    <x-button.primary type="submit">Delete</x-button.primary>
                </x-slot>
            </x-modal.confirmation>
        </form>

        <!-- Save Product Discount Modal -->
        <form wire:submit.prevent="save">
            <x-modal.dialog wire:model.defer="showEditModal">
                <x-slot name="title">
                    @if ($editing && !$editing->id) Create @else Edit @endif Contact
                </x-slot>
                <x-slot name="content">
                    <div class="grid grid-cols-2 gap-1">
                        <div>
                            <x-input.group for="email" label="Email" :error="$errors->first('editing.email')">
                                <x-input.text wire:model.defer="editing.email" id="email"></x-input.text>
                            </x-input.group>

                            <x-input.group for="full_name" label="Full Name" :error="$errors->first('editing.full_name')">
                                <x-input.text wire:model.defer="editing.full_name" id="full_name"></x-input.text>
                            </x-input.group>

                            <x-input.group for="address" label="Address" :error="$errors->first('editing.address')">
                                <x-input.text wire:model.defer="editing.address" id="address"></x-input.text>
                            </x-input.group>
                        </div>
                        <div class="flex flex-col">
                            <x-input.group for="avatar" :error="$errors->first('avatar')">
                                <x-input.file-upload wire:model="avatar" id="avatar">
                                    <span class="h-40 w-40 overflow-hidden bg-gray-100">
                                        @if ($avatar && stripos($avatar->getMimeType(), 'image') !== false)
                                            <img src="{{ $avatar->temporaryUrl() }}" alt="Company Logo"
                                                class="h-40 w-40">
                                        @elseif($editing)
                                            <img src="{{ $editing->avatarUrl() }}" alt="Company Logo" class="h-40 w-40">
                                        @endif
                                    </span>
                                </x-input.file-upload>
                            </x-input.group>
                        </div>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <x-button.secondary class="bg-white" wire:click="$set('showEditModal', false)">Cancel
                    </x-button.secondary>
                    <x-button.primary type="submit">Save</x-button.primary>
                </x-slot>
            </x-modal.dialog>
        </form>

    </div>
