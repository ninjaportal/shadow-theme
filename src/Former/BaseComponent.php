<?php

namespace NinjaPortal\Shadow\Former;

use Illuminate\View\View;

abstract class BaseComponent
{

    protected string $id = '';

    protected string $wrapperClass = '';

    protected string $view;

    public function render(): View
    {
        return view($this->view, [
            "cmp" => $this
        ]);
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getWrapperClass(): string
    {
        return $this->wrapperClass;
    }

    // Setters

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $wrapperClass
     */
    public function setWrapperClass(string $wrapperClass): self
    {
        $this->wrapperClass = $wrapperClass;
        return $this;
    }


}
