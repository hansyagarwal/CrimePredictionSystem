<?php

class RootNode extends Node
{
    public function __construct(array &$subjects)
    {
        $this->subjects = &$subjects;
    }
    public function classify()
    {
        foreach ($this->subNodes as &$subNode) {
            foreach ($this->subjects as &$subject) {
                $subNode->addSubject($subject);
            }
            $subNode->classify();
        }
    }
}