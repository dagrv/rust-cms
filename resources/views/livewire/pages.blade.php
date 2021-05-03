<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
        </x-jet-button>
    </div>

    <!-- Data Table -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-300 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Link</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Content</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @if ($data->count())
                            @foreach ($data as $item)
                                <tr>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                        {{ $item->title }}
                                        {!! $item->is_default_home ? '<span class="text-green-400 text-xs font-bold">[Default Home Page]</span>':''!!}
                                        {!! $item->is_default_not_found ? '<span class="text-red-400 text-xs font-bold">[Default 404 Page]</span>':''!!}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                        <a
                                            class="text-indigo-600 hover:text-indigo-900"
                                            target="_blank"
                                            href="{{ URL::to('/'.$item->slug)}}">
                                            {{ $item->slug }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">{!! \Illuminate\Support\Str::limit($item->content, 50, ' ...') !!}</td>
                                    <td class="px-6 py-4 text-right text-sm">
                                        <x-jet-secondary-button wire:click="updateShowModal({{ $item->id }})">
                                            {{ __('Edit') }}
                                        </x-jet-secondary-button>

                                        <x-jet-danger-button wire:click="deleteShowModal({{ $item->id }})">
                                            {{ __('Delete') }}
                                        </x-jet-danger-button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">No Results Found</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End DataTable -->

    <br>

    <!-- Pagination -->
        {{ $data->links() }}
    <!-- End -->

    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Save Page') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Title') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" wire:model.debounce.400ms="title" />

                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Slug') }}" />

                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 py-2 rounded-l-md border border-dashed border-r-1 border-gray-500 bg-gray-100 text-gray-900 text-sm">
                        http://localhost:8000/
                    </span>
                    <input wire:model="slug" class="form-input ml-1 flex-1 block w-full rounded-none rounded-r-md transition duration-150 ease-in-out sm:text-sm sm:leading-5 outline-none" placeholder="your-slug-goes-here">
                </div>

                @error('slug') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <label for="">
                    <input type="checkbox" class="form-checkbox text-green-400" value="{{ $isSetToDefaultHomePage }}" wire:model="isSetToDefaultHomePage" >
                    <span class="ml-2 text-sm text-gray-700">Set as default Home Page</span>
                </label>
            </div>

            <div class="mt-4">
                <label for="">
                    <input type="checkbox" class="form-checkbox text-red-500" value="{{ $isSetToDefaultNotFoundPage }}" wire:model="isSetToDefaultNotFoundPage" >
                    <span class="ml-2 text-sm text-red-700">Set as default Error 404 Page</span>
                </label>
            </div>

            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Content') }}" />
                <div class="rounded-md shadow-sm">
                    <div class="bg-white">
                        <div class="body-content" wire:ignore>
                            <trix-editor class="trix-content" x-ref="trix" wire:model.debounce.100000ms="content" wire:key="trix-content-unique-key"></trix-editor>
                        </div>
                    </div>
                </div>

                @error('content') <span class="error">{{ $message }}</span> @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            @if ($modelId)
                <x-jet-secondary-button wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-secondary-button>
            @else
                <x-jet-secondary-button wire:click="create" wire:loading.attr="disabled">
                        {{ __('Create') }}
                </x-jet-secondary-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>


    {{-- The Delete Modal --}}
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete Page') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this page? All resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
