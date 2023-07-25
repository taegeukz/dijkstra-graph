<?php

include('./classess/Graph.php');
include('./classess/Dijkstra.php');
include('./classess/Log.php');
include('./classess/Report.php');

$graph = new Graph();

$graph->addNode("1");
$graph->addNode("2");
$graph->addNode("3");
$graph->addNode("4");
$graph->addNode("5");
$graph->addNode("6");

$graph->addEdge("1", "2", 2);
$graph->addEdge("1", "6", 20);
$graph->addEdge("2", "3", 9);
$graph->addEdge("2", "4", 2);
$graph->addEdge("2", "6", 12);
$graph->addEdge("3", "4", 2);
$graph->addEdge("3", "5", 2);
$graph->addEdge("4", "5", 9);
$graph->addEdge("4", "6", 10);
$graph->addEdge("5", "6", 2);

$from = "1";
$to = "6";

$report = new Report($graph);
$dijkstra = new Dijkstra($graph);
$path = ($dijkstra->getShortestPath($from, $to));

$log = new Log();
$log->addContent("Граф:");
$log->addContent($report->getGraphView());
$log->addContent("");
$log->addContent("Кратчайший путь от вершины {$from} до вершины {$to}:");
$log->addContent($path);
$log->saveToFile('log.txt');

echo $log->getContent();