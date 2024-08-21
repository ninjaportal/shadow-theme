<label
    for="{{ $cmp->getId() }}"
    @class([
        $cmp->getWrapperClass(),
        'form-control w-full max-w-full'
    ])
>
    <div class="label">
        <span class="label-text">
            {{ $cmp->getLabel() }}
        </span>
    </div>
    <input
        value="{{ old($cmp->getName()) ?? $cmp->getValue()  }}"
        id="{{ $cmp->getId() }}"
        name="{{ $cmp->getName() }}"
        type="{{ $cmp->getType() }}"
        @if($cmp->isRequired()) required @endif
        @if($cmp->isReadonly()) readonly @endif
        @if($cmp->isDisabled()) disabled @endif
        class="input input-bordered input-primary w-full max-w-full">
    <small class="label-text-alt mt-2">
        {{ $cmp->getHint() }}
    </small>
</label>
