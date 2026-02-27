@props(['task'])
<div class="flex items-center mx-8 px-8 py-4 bg-white shadow rounded-lg">
    <div class="text-xl md:text-2xl font-medium">
        {{ $task['title'] }}
    </div>
    <div class="flex-1 flex gap-4 justify-end">
        <x-secondary-button :href="route('task.edit', $task)">
            {{ __('edit') }}
        </x-secondary-button>
        <form action="{{ route('task.destroy', $task) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
            @csrf
            @method('DELETE')
            <x-danger-button>
                {{ __('delete') }}
            </x-danger-button>
        </form>
    </div>
</div>