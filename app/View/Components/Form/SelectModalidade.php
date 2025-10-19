<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class SelectModalidade extends Component
{
    public $label;
    public $name;
    public $required;
    public $value;

    public function __construct($label = 'Modalidade', $name = 'modalidade', $required = false, $value = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->required = $required;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.form.select-modalidade');
    }
}
