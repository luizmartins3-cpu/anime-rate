<?php

class BusinessRuleException extends Exception {
    public function __construct($message = "Erro de regra de negócio", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
