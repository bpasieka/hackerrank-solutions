<?php
declare(strict_types=1);

class Graph
{
    const EDGE_LENGTH = 6;

    /** @var int */
    private $numberOfVertices;

    /** @var int[][] */
    private $edges = [];

    /**
     * @param int $numberOfVertices
     */
    public function __construct(int $numberOfVertices)
    {
        $this->numberOfVertices = $numberOfVertices;
    }

    /**
     * @param int $a
     * @param int $b
     * @return void
     */
    public function addEdge(int $a, int $b)
    {
        $this->edges[$a][$b] = true;
        $this->edges[$b][$a] = true;
    }

    /**
     * @param int $from
     * @return int[]
     */
    public function getPaths(int $from): array
    {
        $result = [];

        $queue = [[$from, 0]];
        $paths = [];

        while (!empty($queue)) {
            list($element, $level) = array_pop(array_reverse($queue));
            unset($queue[key($queue)]);

            if (!isset($paths[$element])) {
                $paths[$element] = $level * self::EDGE_LENGTH;
            }

            foreach ($this->edges[$element] as $connectedElement => $exist) {
                if (!isset($paths[$connectedElement])) {
                    $queue[] = [$connectedElement, $level + 1];
                }
            }
        }

        for ($i = 1; $i <= $this->numberOfVertices; $i++) {
            if ($i === $from) {
                continue;
            }
            $result[$i] = $paths[$i] ?? -1;
        }

        return $result;
    }

    /**
     * @param int $from
     * @return void
     */
    public function printPaths(int $from)
    {
        echo implode(' ', $this->getPaths($from)) . " \n";
    }
}

$handle = fopen('php://stdin', 'r');
fscanf($handle, '%d', $n);
for ($i = 0; $i < $n; $i++) {
    fscanf($handle, '%d %d', $nVertices, $nEdges);
    $graph = new Graph((int) $nVertices);
    for ($j = 0; $j < $nEdges; $j++) {
        fscanf($handle, '%d %d', $fromEdge, $toEdge);
        $graph->addEdge((int) $fromEdge, (int) $toEdge);
    }
    fscanf($handle, '%d', $startingEdge);
    $graph->printPaths($startingEdge);
}