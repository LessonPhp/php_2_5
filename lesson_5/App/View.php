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

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->data);
    }
}