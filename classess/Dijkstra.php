<?php

class Dijkstra
{
    private $graph;
    private $used = [];
    private $esum = [];
    private $path = [];

    public function __construct(Graph $graph)
    {
        $this->graph = $graph;
    }

    public function getShortestPath(string $fromNode, string $toNode): string
    {
        $this->init();
        $this->esum[$fromNode] = 0;
        while($currNode = $this->findNearestUnusedNode())
            $this->setEsumToNextNodes($currNode);
        return $this->restorePath($fromNode, $toNode);
    }

    public function init(): void
    {
        foreach ($this->graph->getNodes() as $node) {
            $this->used[$node] = false;
            $this->esum[$node] = INF;
            $this->path[$node] = '';
        }
    }

    public function findNearestUnusedNode(): string
    {
        $nearestNode = '';
        foreach ($this->graph->getNodes() as $node) {
            if (! $this->used[$node]) {
                if($nearestNode == '' || $this->esum[$node] < $this->esum[$nearestNode]) {
                    $nearestNode = $node;
                }
            }
        }
        return $nearestNode;
    }

    public function setEsumToNextNodes(string $currNode): void
    {
        $this->used[$currNode] = true;
        foreach ($this->graph->getEdges($currNode) as $nextNode => $length) {
            if(! $this->used[$nextNode])
            {
                $newEsum = $this->esum[$currNode] + $length;
                if($newEsum < $this->esum[$nextNode])
                {
                    $this->esum[$nextNode] = $newEsum;
                    $this->path[$nextNode] = $currNode;
                }
            }
        }
    }

    public function restorePath(string $fromNode, string $toNode): string
    {
        $path = $toNode;
        while($toNode != $fromNode)
        {
            $toNode = $this->path[$toNode];
            $path = $toNode . ' -> ' . $path;
        }
        return $path;
    }
}