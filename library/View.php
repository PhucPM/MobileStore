<?php

class View {

    public $title;
    public $layout;
    public $viewFile;

    public function render($name) {
        $this->viewFile = $name;
        $layout = LAYOUT . $this->layout . '.php';
        if (file_exists($layout)) {
            require LAYOUT . $this->layout . '.php';
        }
    }

    public function loadView() {
        require VIEW . $this->viewFile . '.php';
    }

}