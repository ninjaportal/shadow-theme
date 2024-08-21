<?php

namespace NinjaPortal\Shadow\Former\Fields;

use NinjaPortal\Shadow\Former\BaseInput;

class TextArea extends BaseInput
{

    protected string $view = "shadow::former.inputs.textarea";

    protected int $cols = 3;
    protected int $rows = 3;

    public function getCols(): int
    {
        return $this->cols;
    }

    public function setCols(int $cols): self
    {
        $this->cols = $cols;
        return $this;
    }

    public function getRows(): int
    {
        return $this->rows;
    }

    public function setRows(int $rows): self
    {
        $this->rows = $rows;
        return $this;
    }
}
