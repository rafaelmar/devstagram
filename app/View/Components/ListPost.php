<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListPost extends Component
{
    public $posts;

    public function __construct($posts)
    {
        $this->posts = $posts; // en el momento de ingresar variables dinamicas al proyecto es necesario limpiar el cache de las vistas para que funcionen bien, de la misma manera que las rutas
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list-post');
    }
}
