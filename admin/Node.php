<?php

abstract class Node
{
    /** @var array */
    protected $subjects = array();
    /** @var Node[] */
    protected $subNodes = array();
    public abstract function classify();
    public function addSubject($subject)
    {
        $this->subjects[] = &$subject;
        return $this;
    }
    public function addSubjects($subjects)
    {
        foreach ($subjects as &$subject) {
            $this->subjects[] = &$subject;
        }
        return $this;
    }
    public function &getSubjects()
    {
        return $this->subjects;
    }
    public function &getSubject($index)
    {
        return $this->subjects[$index];
    }
    public function addSubNode(Node &$subNode)
    {
        $this->subNodes[] = &$subNode;
        return $this;
    }
    public function addSubNodes(array &$subNodes)
    {
        foreach ($subNodes as &$subNode) {
            $this->subNodes[] = &$subNode;
        }
        return $this;
    }
    public function &getSubNode($index)
    {
        return $this->subNodes[$index];
    }
    public function &getSubNodes()
    {
        return $this->subNodes;
    }
}