<?php

namespace App;


class View
{
    use TraitV;

    /**
     * @param $template
     * @return string
     */
    public function render($template)
    {
        ob_start();
        include $template;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }

    /**
     * @param $template
     */
    public function display($template)
    {
        echo $this->render($template);
    }
}