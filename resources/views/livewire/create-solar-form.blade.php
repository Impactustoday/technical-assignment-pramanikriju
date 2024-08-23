<div>
    <form wire:submit="create">
        {{ $this->form }}

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-6" type="submit">
            Submit
        </button>
    </form>

    <x-filament-actions::modals />
</div>
