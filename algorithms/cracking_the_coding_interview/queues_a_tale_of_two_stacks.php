<?php
declare(strict_types=1);

const TYPE_ENQUEUE = 1;
const TYPE_DEQUEUE = 2;
const TYPE_PEEK = 3;

class Queue
{
    private $stackInput = [];
    private $stackOutput = [];

    /**
     * @param int $value
     * @return void
     */
    public function enqueue(int $value)
    {
        $this->stackInput[] = $value;
    }

    /**
     * @return void
     */
    public function dequeue()
    {
        if (empty($this->stackOutput)) {
            $this->moveInputToOutput();
        }

        $length = count($this->stackOutput);
        if ($length === 0) {
            return;
        }

        array_pop($this->stackOutput);
    }

    /**
     * @return int|null
     */
    public function peek()
    {
        if (empty($this->stackOutput)) {
           $this->moveInputToOutput();
        }

        $length = count($this->stackOutput);
        if ($length === 0) {
            return null;
        }

        return $this->stackOutput[$length - 1];
    }

    /**
     * @return void
     */
    private function moveInputToOutput()
    {
        $length = count($this->stackInput);
        for ($i = $length - 1; $i >= 0; $i--) {
            $this->stackOutput[] = $this->stackInput[$i];
        }
        $this->stackInput = [];
    }
}

/**
 * @param Queue $queue
 * @param int $type
 * @param int|null $typeValue
 * @return mixed
 */
function process(Queue $queue, int $type, int $typeValue = null)
{
    if ($type === TYPE_ENQUEUE && !is_null($typeValue)) {
        $queue->enqueue($typeValue);
        return null;
    }

    if ($type === TYPE_DEQUEUE) {
        $queue->dequeue();
        return null;
    }

    if ($type === TYPE_PEEK) {
        return $queue->peek();
    }

    return null;
}

$handle = fopen('php://stdin', 'r');
fscanf($handle, '%d', $t);

$result = [];
$queue = new Queue();
for ($a0 = 0; $a0 < $t; $a0++) {
    fscanf($handle, '%d %d', $type, $typeValue);

    $value = process($queue, $type, $typeValue);
    if (!is_null($value)) {
        $result[] = $value;
    }
    // not to reuse value from a previous loop
    $typeValue = null;
}
echo implode("\n", $result);
