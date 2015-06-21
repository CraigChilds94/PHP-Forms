<?php namespace PHPForm\Utility;

/**
 * Simple string object wrapper for clean
 * code.
 *
 * @author Craig Childs
 */
class String {

    /**
     * Where to store it
     *
     * @var string
     */
    private $value;

    /**.
     * Construct the new string with a value
     *
     * @param string|PHPForm\Utility\String $value
     */
    public function __construct($value = '')
    {
        if($value instanceof String) {
            $value = $value->get();
        }

        $this->value = $value;
    }

    /**
     * Append a String to the String, can chain.
     *
     * @param  string|PHPForm\Utility\String $extra
     * @return PHPForm\Utility\String
     */
    public function append($extra = '')
    {
        if($value instanceof String) {
            $value = $value->get();
        }

        $this->value .= $extra;
        return $this;
    }

    /**
     * Get the string value.
     *
     * @return string
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * Handle cases where string
     * will need to be echoed.
     *
     * @return string The value
     */
    public function __toString()
    {
        return $this->value;
    }

}
