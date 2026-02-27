<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All tasks') }}
            </h2>
            <div class="flex-1 flex px-4 justify-end">
                <x-primary-button :href="route('task.create')">
                    {{ __('+ add task') }}
                </x-primary-button>
            </div>
        </div>
    </x-slot>

    
    <div class="max-w-7xl flex flex-col mx-auto gap-4 task-list">
        @foreach ($tasks as $task)
            <x-task-card :task="$task" />
        @endforeach
    </div>
</x-app-layout>