<?php namespace PHPForm\HTML;

use PHPForm\Utility\String;

/**
 * Represent a generic HTML tag
 *
 * @author Craig Childs
 */
class Tag {

    /**
     * The properties of a generic
     * HTML tag.
     */
    protected $tagName,
              $attributes,
              $selfClosing;

    /**
     * Constuct a new Tag
     *
     * @param string $name
     * @param array $attributes
     * @param boolean $selfClosing
     */
    public function __construct($name = '', $attributes = [], $selfClosing = true)
    {
        $this->tagName = $name;
        $this->attributes = $attributes;
        $this->selfClosing = $selfClosing;
    }

    /**
     * Render the tag as outputted html.
     *
     * @return String
     */
    public function render()
    {
        $tag = (new String('<'))->append($this->$tagName)
            ->append($this->buildAttributes());

        if($this->selfClosing) {
            $tag->append('/>');

            echo $tag;
            return;
        }

        $tag->append('>')
            ->append(isset($this->attributes['value']) ? $this->attributes['value'] : '')
            ->append('</')
            ->append($this->$tagName)
            ->append('>');

        echo $tag;
    }

    /**
     * Take key=>value attributes and build them into
     * a string object.
     *
     * @return PHPForm\Utility\String
     */
    private function buildAttributes()
    {
        $attributeString = new String();
        $end = end(array_keys($this->attributes));

        foreach($this->attributes as $name => $value)
        {
            if(!$this->selfClosing && $name == 'value') continue;

            $attributeString->append(' ')
                ->append($name)
                ->append('="')
                ->append($value)
                ->append('"');

            if($name != $end) {
                $attributeString->append(' ');
            }
        }

        return $attributeString;
    }
}
