package main

import (
	"bufio"
	"fmt"
	"os"
	"strings"
)

const (
	OperationAdd  = "add"
	OperationFind = "find"
)

type Trie struct {
	numberOfWords int
	children      map[rune]*Trie
}

func NewTrie() *Trie {
	return &Trie{
		children: map[rune]*Trie{},
	}
}

func (t *Trie) add(word string) {
	t.numberOfWords++

	if len(word) == 0 {
		return
	}

	firstChar := []rune(word)[0]
	word = word[1:]
	child, ok := t.children[firstChar]
	if !ok {
		newChild := NewTrie()
		t.children[firstChar] = newChild
		newChild.add(word)
	} else {
		child.add(word)
	}
}

func (t Trie) find(word string) int {
	if len(word) == 0 {
		return t.numberOfWords
	}

	firstChar := []rune(word)[0]
	child, ok := t.children[firstChar]
	if !ok {
		return 0
	}

	return child.find(word[1:])
}

func main() {
	reader := bufio.NewReader(os.Stdin)
	reader.ReadString('\n')

	trie := NewTrie()
	dictionary := make(map[string]bool)

	for {
		line, err := reader.ReadString('\n')
		line = strings.TrimSpace(line)
		lineData := strings.Fields(line)

		operation := lineData[0]
		contact := lineData[1]

		if _, ok := dictionary[contact]; !ok && operation == OperationAdd {
			trie.add(contact)
			dictionary[contact] = true
		} else if operation == OperationFind {
			fmt.Println(trie.find(contact))
		}

		if err != nil {
			break
		}
	}
}
