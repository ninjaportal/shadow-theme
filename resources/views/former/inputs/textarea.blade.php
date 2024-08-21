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
    <textarea
        cols="{{ $cmp->getCols() }}"
        rows="{{ $cmp->getRows() }}"
        id="{{ $cmp->getId() }}"
        name="{{ $cmp->getName() }}"
        @if($cmp->isRequired()) required @endif
        class="textarea textarea-primary w-full max-w-full">{{ old($cmp->getName()) ?? $cmp->getValue()  }}</textarea>
</label>
