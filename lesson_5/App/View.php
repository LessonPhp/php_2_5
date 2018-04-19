<?php

namespace App;


class View implements \Countable
{
    use TraitView;

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
     * @return mixed
     */
    public function display($template)
    {
        return $this->render($template);
    }

    public function count()
    {
        return count($this->data);
    }
}