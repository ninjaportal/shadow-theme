<?php

namespace NinjaPortal\Shadow\Views;

use Illuminate\View\Component;
use Illuminate\View\View;

class SwaggerViewerViewComposer extends Component
{

    public string $swaggerFile;

    public function render()
    {
        return view("shadow::components.swagger-viewer", [
            'swaggerFile' => $this->swaggerFile
        ]);
    }
}
