package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

func main() {
	reader := bufio.NewReader(os.Stdin)
	reader.ReadString('\n')

	line, _ := reader.ReadString('\n')
	line = strings.TrimSpace(line)
	arrayOfStrings := strings.Fields(line)
	length := len(arrayOfStrings)

	array := make([]int, length)
	for i := range arrayOfStrings {
		array[i], _ = strconv.Atoi(arrayOfStrings[i])
	}

	swaps := 0
	for i := 0; i < length; i++ {
		for j := 0; j < length-1; j++ {
			if array[j] > array[j+1] {
				swaps++

				temp := array[j]
				array[j] = array[j+1]
				array[j+1] = temp
			}
		}
	}

	fmt.Printf("Array is sorted in %d swaps. \n", swaps)
	fmt.Printf("First Element: %d \n", array[0])
	fmt.Printf("Last Element: %d \n", array[length-1])
}
