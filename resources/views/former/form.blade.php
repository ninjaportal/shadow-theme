<form
    class="max-w-full grid"
    action="{{ $form->getAction() }}"
    method="{{ $form->getMethod() == 'GET' ? 'GET' : 'POST' }}"
    id="{{ $form->getId() }}"
    enctype="{{ $form->getEnctype() }}"
>
    @csrf

    @if(isset($errors) && count($errors) > 0)
        <div class="p-4 bg-red-200 my-2 max-w-full col-span-full dark:bg-red-800">
            <ul>
                @foreach($errors->all() as $error)
                    <li class="text-red-800 dark:text-red-200">
                        {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    @method($form->getMethod())
    <div
        @class([
            'grid gap-4',
            'lg:grid-cols-'. $form->getColumns(),
            $form->getClass(),
        ])
    >
        @foreach($form->getSchema() as $input)
            {{ $input->render() }}
        @endforeach
    </div>



    <button
        type="submit"
        class="btn btn-primary max-w-full mt-8">
        {{ $form->getSubmitText() }}
    </button>

</form>
