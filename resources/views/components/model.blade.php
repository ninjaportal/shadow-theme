<div
    x-data="{
        showModal: false,
        openModal() {
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        }
    }"
    class="inline">
    <button
        class="{{ $triggerClass ?? "" }}"
        @click="openModal"
    >
        {{ $trigger }}
    </button>
    <dialog
        x-show="showModal"
        class="modal"
        :class="{ 'modal-open': showModal }"
    >
        <div class="modal-box">
            <h3 class="text-lg font-bold">
                {{ $title }}
            </h3>
            {{ $slot }}
        </div>
        <div
            @click="closeModal"
            class="modal-backdrop fixed inset-0 bg-black/50"></div>
    </dialog>
</div>
