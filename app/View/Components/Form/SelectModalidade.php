<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class SelectModalidade extends Component
{
    public $label;
    public $name;
    public $required;
    public $selected;

    public function __construct($label = 'Modalidade', $name = 'modalidade', $required = false, $selected = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->required = $required;
        $this->selected = $selected;
    }

    public function render()
    {
        return view('components.form.select-modalidade');
    }
}
