<x-shadow::model
    trigger-class="{{ $triggerClass ?? '' }}"
    title="{{ __('shadow.warning') }}"
    trigger="{{ $trigger }}">
    <div class="p-6">
        <div class="my-4 flex flex-col justify-center items-center space-y-4">
            <x-heroicon-o-exclamation-circle class="h-14 w-14 text-red-500" />
            <p>
                {{ $message ?? __("shadow::shadow.are_you_sure") }}
            </p>
        </div>
    </div>
    <div class="mt-6 flex justify-end space-x-2">
        <button
            @click="closeModal"
            class="btn btn-sm  dark:text-white">
            @lang("shadow::shadow.cancel")
        </button>

        <form id="confirm-form" action="{{ $action }}" method="{{ $method == "GET" ? "GET" : "POST"  }}">
            @csrf
            @method($method)
            <button
                class="btn btn-sm btn-error dark:text-white">
                @lang("shadow::shadow.confirm")
            </button>
        </form>
    </div>
</x-shadow::model>
