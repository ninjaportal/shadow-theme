<?php

namespace NinjaPortal\Shadow\Former;

use Illuminate\View\Component;

class Former
{

    protected string $method = 'POST';
    protected string $action = '';
    protected string $enctype = 'multipart/form-data';
    protected string $id = '';
    protected string $class = '';
    protected string $submitText = 'Submit';
    protected int $columns = 2;

    protected array $schema = [];

    public function __construct(array $schema = [])
    {
        $this->schema = $schema;
    }

    public static function make(array $schema = []): static
    {
        return new static($schema);
    }

    public function render(): \Illuminate\View\View
    {
        return view('shadow::former.form',[
            'form' => $this
        ]);
    }

    // getters and setters

    /**
     * @return int
     */
    public function getColumns(): int
    {
        return $this->columns;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getEnctype(): string
    {
        return $this->enctype;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getSchema(): array
    {
        return $this->schema;
    }

    /**
     * @return string
     */
    public function getSubmitText(): string
    {
        return $this->submitText;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * @param string $enctype
     */
    public function setEnctype(string $enctype): self
    {
        $this->enctype = $enctype;
        return $this;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param int $columns
     */
    public function setColumns(int $columns): self
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * @param string $submitText
     */
    public function setSubmitText(string $submitText): self
    {
        $this->submitText = $submitText;
        return $this;
    }

    /**
     * @param array $array
     * @return void
     */
    public function fill(array $array): void
    {
        foreach ($this->schema as $field) {
            $key = $field->getName();
            if ($field instanceof BaseInput && isset($array[$key])) {
                $field->setValue($array[$key]);
            }
        }
    }

    public function withFakeValue()
    {
        $fake = \Faker\Factory::create();
        foreach ($this->schema as $field) {
            if ($field instanceof BaseInput) {
                $field->setValue($fake->word);
            }
        }
    }


}
