<?php

namespace QB;

trait QuotableTrait
{
    protected function quote(string $argument)
    {
        return "`$argument`";
    }
}