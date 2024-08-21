<?php

namespace NinjaPortal\Shadow\Former;

use Illuminate\View\View;

abstract class BaseInput extends BaseComponent
{
    protected string $name;
    protected mixed $value = '';
    protected string $label = '';
    protected string $hint = '';

    protected bool $isRequired = false;
    protected bool $isDisabled = false;
    protected bool $isReadonly = false;

    protected string $labelClass = '';
    protected string $inputClass = '';

    public function __construct(string $name)
    {
        $this->setName($name);
        $this->setId(str($name)->slug());
    }

    public static function make(string $name): static
    {
        return new static($name);
    }


    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getHint(): string
    {
        return $this->hint;
    }

    /**
     * @return string
     */
    public function getValue(): mixed
    {
        return $this->value;
    }


    /**
     * @return string
     */
    public function getLabel(): string
    {
//        dd(str($this->name)->title());
        return $this->label ?: str($this->name)
            ->replace('_', ' ')
            ->replace('-', ' ')->title()->toString();
    }

    /**
     * @return string
     */
    public function getInputClass(): string
    {
        return $this->inputClass;
    }

    /**
     * @return string
     */
    public function getLabelClass(): string
    {
        return $this->labelClass;
    }


    public function isDisabled(): bool
    {
        return $this->isDisabled;
    }


    public function isReadonly(): bool
    {
        return $this->isReadonly;
    }

    // Setters

    /**
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $value
     */
    public function setValue(mixed $value): self
    {
        $this->value = $value;
        return $this;
    }


    /**
     * @param string $label
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param string $inputClass
     */
    public function setInputClass(string $inputClass): self
    {
        $this->inputClass = $inputClass;
        return $this;
    }

    /**
     * @param string $labelClass
     */
    public function setLabelClass(string $labelClass): self
    {
        $this->labelClass = $labelClass;
        return $this;
    }

    /**
     * @param string $wrapperClass
     */
    public function setWrapperClass(string $wrapperClass): self
    {
        $this->wrapperClass = $wrapperClass;
        return $this;
    }

    /**
     * @param string $hint
     * @return $this
     */
    public function setHint(string $hint): self
    {
        $this->hint = $hint;
        return $this;
    }

    public function required(): self
    {
        $this->isRequired = true;
        return $this;
    }

    public function disabled(): self
    {
        $this->isDisabled = true;
        return $this;
    }

    public function readonly(): self
    {
        $this->isReadonly = true;
        return $this;
    }
}

