<div
    @class([
        $cmp->getWrapperClass(),
        'form-control'
    ])
>
    <label class="label cursor-pointer justify-start">
        <input
            name="{{ $cmp->getName() }}"
            required="{{ $cmp->isRequired() }}"
            type="checkbox"
            checked="{{ old($cmp->getName()) ?? $cmp->getValue()  }}"
            class="checkbox checkbox-primary checkbox-sm"
        />
        <span class="label-text ml-4">
                {{ $cmp->getLabel() }}
            </span>
    </label>
</div>
