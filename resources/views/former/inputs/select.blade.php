<div
    @class([
    $cmp->getWrapperClass(),
        'form-control w-full',
    ])
>
        <label class="label">
            <span class="label-text">
                {{ $cmp->getLabel() }}
            </span>
        </label>

        <select
            name="{{ $cmp->getName() }}"
            required="{{ $cmp->isRequired() }}"
            class="select select-primary w-full">
            @foreach($cmp->getOptions() as $key => $value)
                <option value="{{ $key }}" @if($cmp->getValue() == $key) selected @endif>{{ $value }}</option>
            @endforeach
        </select>
</div>
