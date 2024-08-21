<?php

namespace NinjaPortal\Shadow\Former\Fields;

use NinjaPortal\Shadow\Former\BaseInput;

class MultiSelect extends BaseInput
{

    protected array $options = [];

    protected mixed $value = [];


    public function render(): \Illuminate\View\View
    {
        return view('shadow::former.inputs.multi-select', [
            'cmp' => $this
        ]);
    }

    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name . '[]';
    }
}
