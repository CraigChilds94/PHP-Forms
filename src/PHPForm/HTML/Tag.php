<?php namespace PHPForm\HTML;

abstract class Tag {

    protected $tagName,
              $attributes,
              $selfClosing;

    /**
     * Render the tag as outputted html.
     *
     * @return String
     */
    public function render()
    {

    }
}
