<?php

class Report
{
    private $graph;

    public function __construct(Graph $graph)
    {
        $this->graph = $graph;
    }

    public function getGraphView(): string
    {
        $output = '';
        foreach ($this->graph->getNodes() as $node) {
            $output .= $node ;
            foreach ($this->graph->getEdges($node) as $currNode => $length) {
                $output .= ' -> ' . $currNode . '(' . $length .')';
            }
            $output .= PHP_EOL;
        }
        return $output;
    }
}