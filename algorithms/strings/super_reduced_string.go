package main

import (
	"bufio"
	"fmt"
	"os"
)

func main() {
	reader := bufio.NewReader(os.Stdin)
	s, _ := reader.ReadString('\n')

	fmt.Println(superReducedString(s))
}

func superReducedString(s string) string {
	if s == "" {
		return "Empty String"
	}

	result := ""
	runes := []rune(s)
	length := len(runes)

	i := 0
	for i < length {
		if i == length-1 || runes[i] != runes[i+1] {
			result += string(runes[i])
			i++
			continue
		}

		if i < length-1 && runes[i] == runes[i+1] {
			i += 2
			continue
		}
	}

	if result == s {
		return result
	}

	return superReducedString(result)
}
