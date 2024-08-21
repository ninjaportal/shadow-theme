<?php

namespace NinjaPortal\Shadow\Views;

use Illuminate\View\Component;
use Illuminate\View\View;

class ModalComposer extends Component
{

    public string $title;
    public string $trigger;
    public string $triggerClass = "btn";

    public function render()
    {
        return view("shadow::components.model", [
            'title' => $this->title,
            'trigger' => $this->trigger,
            'triggerClass' => $this->triggerClass,
        ]);
    }
}
