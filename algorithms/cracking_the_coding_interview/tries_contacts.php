<?php
declare(strict_types=1);

const OPERATION_ADD = 'add';
const OPERATION_FIND = 'find';

class Trie
{
    /** @var int */
    private $numberOfWords = 0;

    /** @var Trie[] [$char => $trie...] */
    private $children = [];

    /**
     * @param string $word
     */
    public function add(string $word)
    {
        $this->numberOfWords++;

        if (empty($word)) {
            return;
        }

        $firstChar = $word[0];
        $word = substr($word, 1);
        if (empty($this->children) || empty($this->children[$firstChar])) {
            $child = new Trie();
            $this->children[$firstChar] = $child;
            $child->add($word);
        } else {
            $this->children[$firstChar]->add($word);
        }

    }

    /**
     * @param string $word
     * @return int
     */
    public function find(string $word): int
    {
        if (empty($word)) {
            return $this->numberOfWords;
        }

        $firstChar = $word[0];
        if (empty($this->children[$firstChar])) {
            return 0;
        }

        return $this->children[$firstChar]->find(substr($word, 1));
    }
}

$handle = fopen ('php://stdin', 'r');
fscanf($handle,'%d',$n);

$trie = new Trie();
$dictionary = [];

for ($i = 0; $i < $n; $i++) {
    fscanf($handle, '%s %s', $op, $contact);

    if ($op === OPERATION_ADD && empty($dictionary[$contact])) {
        $trie->add($contact);
        $dictionary[$contact] = true;
    } elseif ($op === OPERATION_FIND) {
        echo $trie->find($contact) . "\n";
    }
}
