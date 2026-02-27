<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create task') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-4 bg-white shadow rounded-lg">

        <form action="{{ route('task.store') }}" method="POST" class="max-w-xl mx-auto">
            @csrf

            <x-input-label for="title" :value="'タイトル'"/>
            <x-text-input
                name="title"
                id="title"
                type="text"
                :value="old('title')"
                class="w-full"
            />
            <x-input-error :messages="$errors->get('title')"/>

            <x-input-label for="comment" :value="'コメント'"/>
            <x-textarea name="comment" id="comment" rows=12 class="w-full">{{ old('comment') }}</x-textarea>
            <x-input-error :messages="$errors->get('comment')"/>

            <div class="flex justify-end gap-4">
                <x-secondary-button :href="route('task.showall')">
                    {{ __('return') }}
                </x-secondary-button>
                <x-primary-button>{{ __('Create') }}</x-primary-button>
            </div>
        </form>

        

</x-app-layout>