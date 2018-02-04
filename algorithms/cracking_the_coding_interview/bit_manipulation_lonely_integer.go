package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

func findUnique(array []int) int {
	result := 0

	for _, value := range array {
		result ^= value
	}

	return result
}

func main() {
	reader := bufio.NewReader(os.Stdin)
	reader.ReadString('\n')

	line, _ := reader.ReadString('\n')
	arrayOfStrings := strings.Fields(strings.TrimSpace(line))
	array := make([]int, len(arrayOfStrings))
	for i := range arrayOfStrings {
		array[i], _ = strconv.Atoi(arrayOfStrings[i])
	}

	fmt.Println(findUnique(array))
}
