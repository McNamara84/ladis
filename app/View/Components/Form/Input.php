<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public function __construct(
        public string $name,
        public string $label,
        public string $type = 'text',
        public ?string $value = null,
        public ?string $hint = null,
        public ?string $placeholder = null,
        public bool $required = false,
        public ?string $step = null,
        public ?string $min = null,
        public ?string $max = null,
    ) {
        $this->value = $value ?? old($name);
    }

    public function render()
    {
        return view('components.form.input');
    }
}
