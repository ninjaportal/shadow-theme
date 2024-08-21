<?php

namespace NinjaPortal\Shadow\Former\Fields;

use NinjaPortal\Shadow\Former\BaseInput;


class TextInput extends BaseInput
{

    protected string $type = 'text';

    protected string $view = "shadow::former.inputs.text";


    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return TextInput
     */
    public function setType(string $type): self
    {
        if (!in_array($type, ['text', 'password', 'email', 'number', 'date', 'url', 'tel', 'search', 'color', 'range', 'time', 'datetime-local', 'month', 'week'])) {
            throw new \InvalidArgumentException('Invalid input type');
        }
        $this->type = $type;
        return $this;
    }

}
