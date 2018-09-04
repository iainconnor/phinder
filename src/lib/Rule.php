<?php

namespace Phinder;

use Phinder\Error\InvalidRule;


final class Rule {

    public $id;

    public $xpath;

    public $message;

    public $exceptions;

    public function __construct($id, $xpath, $message, $exceptions) {
        $this->id = $id;
        $this->xpath = $xpath;
        $this->message = $message;
        $this->exceptions = $exceptions;
    }

}
