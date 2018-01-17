package main

import (
	"bufio"
	"fmt"
	"os"
	"strings"
)

func main() {
	reader := bufio.NewReader(os.Stdin)

	stringA, _ := reader.ReadString('\n')
	stringA = strings.TrimSpace(stringA)
	stringB, _ := reader.ReadString('\n')
	stringB = strings.TrimSpace(stringB)

	countMap := make(map[string]int)
	result := 0

	for _, char := range stringA {
		c := string(char)

		if value, ok := countMap[c]; ok {
			countMap[c] = value + 1
		} else {
			countMap[c] = 1
		}
	}

	for _, char := range stringB {
		c := string(char)

		if value, ok := countMap[c]; !ok || value == 0 {
			result += 1
		} else {
			countMap[c] = value - 1
		}
	}

	for _, value := range countMap {
		result += value
	}

	fmt.Println(result)
}
