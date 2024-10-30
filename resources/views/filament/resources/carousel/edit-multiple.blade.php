<x-filament::page>
    <form wire:submit.prevent="save">
        {{ $this->form }}

        <div class="mt-4">
            <x-filament::button type="submit">
                Save Changes
            </x-filament::button>
        </div>
    </form>

    <div class="mt-8">
        <h3>Preview Images:</h3>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <h4>First Image</h4>
                @if ($carousel->first)
                    <img src="{{ Storage::url($carousel->first) }}" alt="First Image" class="w-full h-auto" />
                @endif
            </div>

            <div>
                <h4>Second Image</h4>
                @if ($carousel->second)
                    <img src="{{ Storage::url($carousel->second) }}" alt="Second Image" class="w-full h-auto" />
                @endif
            </div>

            <div>
                <h4>Third Image</h4>
                @if ($carousel->third)
                    <img src="{{ Storage::url($carousel->third) }}" alt="Third Image" class="w-full h-auto" />
                @endif
            </div>
        </div>
    </div>
</x-filament::page>
