<?php

namespace NinjaPortal\Shadow\Former\Fields;

use NinjaPortal\Shadow\Former\BaseInput;

class SelectInput extends BaseInput
{
    protected array $options = [];
    protected string $view = "shadow::former.inputs.select";

    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
