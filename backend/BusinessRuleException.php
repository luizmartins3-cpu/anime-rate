<?php

class BusinessRuleException extends Exception {
    public function __construct($message = "Erro na regra de negócio do Anime Rate", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
