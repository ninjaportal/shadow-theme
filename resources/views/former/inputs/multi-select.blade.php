<div
    @class([
        $cmp->getWrapperClass(),
        'form-control'
    ])
>
    <div class="multi-check">
        <span class="label-text">
            {{ $cmp->getLabel() }}
        </span>
        @foreach($cmp->getOptions() as $key => $option)
            <label class="label cursor-pointer justify-start">
                <input
                    name="{{ $cmp->getName() }}"
                    type="checkbox"
                    value="{{ $key }}"
                    @if(in_array($key, $cmp->getValue())) checked @endif
                    class="checkbox checkbox-primary checkbox-sm"
                />
                <span class="label-text ml-4">
                {{ $option }}
            </span>
            </label>
        @endforeach
    </div>
</div>
