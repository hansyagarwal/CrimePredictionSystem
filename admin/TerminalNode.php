<?php

class TerminalNode extends Node
{
    public function &getResult()
    {
        return $this->subjects;
    }
    public function classify()
    {
        return null;
    }
}