package main

import (
	"bufio"
	"fmt"
	"os"
	"strings"
)

const (
	YES = "Yes"
	NO  = "No"
)

func createReplica(magazineNoteWords, ransomNoteWords []string) string {
	if len(magazineNoteWords) < len(ransomNoteWords) {
		return NO
	}

	magazineNoteMap := map[string]int{}
	for _, word := range magazineNoteWords {
		magazineNoteMap[word]++
	}

	for _, word := range ransomNoteWords {
		if value, ok := magazineNoteMap[word]; !ok || value == 0 {
			return NO
		}
		magazineNoteMap[word]--
	}

	return YES
}

func main() {
	reader := bufio.NewReader(os.Stdin)
	reader.ReadString('\n')

	magazineNoteString, _ := reader.ReadString('\n')
	magazineNoteWords := strings.Fields(magazineNoteString)
	ransomNoteString, _ := reader.ReadString('\n')
	ransomNoteWords := strings.Fields(ransomNoteString)

	fmt.Println(createReplica(magazineNoteWords, ransomNoteWords))
}
