<?php

namespace NinjaPortal\Shadow\Views;

use Illuminate\View\Component;
use Illuminate\View\View;

class ActionConfirmModalComposer extends ModalComposer
{

    public string $message;

    public string $method;

    public string $action;

    public function render()
    {
        return view("shadow::components.action-confirm-modal", [
            'title' => $this->title,
            'trigger' => $this->trigger,
            'message' => $this->message,
            'method' => $this->method,
            'action' => $this->action,
            'triggerClass' => $this->triggerClass
        ]);
    }
}
