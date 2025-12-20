<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Textarea extends Component
{
    public function __construct(
        public string $name,
        public string $label,
        public ?string $value = null,
        public ?string $hint = null,
        public ?string $placeholder = null,
        public bool $required = false,
        public int $rows = 3,
    ) {
        $this->value = $value ?? old($name);
    }

    public function render()
    {
        return view('components.form.textarea');
    }
}
