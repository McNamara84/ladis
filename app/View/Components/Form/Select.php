<?php

namespace App\View\Components\Form;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Select extends Component
{
    public function __construct(
        public string $name,
        public string $label,
        public Collection|array $options,
        public ?string $value = null,
        public ?string $hint = null,
        public ?string $placeholder = null,
        public bool $required = false,
        public string $optionValue = 'id',
        public string $optionLabel = 'name',
    ) {
        $this->value = $value ?? old($name);
    }

    public function render()
    {
        return view('components.form.select');
    }
}
