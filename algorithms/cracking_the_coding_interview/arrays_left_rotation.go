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

	lineOneString, _ := reader.ReadString('\n')
	lineOneArray := strings.Fields(lineOneString)
	lineTwoString, _ := reader.ReadString('\n')
	lineTwoArray := strings.Fields(lineTwoString)

	rotate, _ := strconv.Atoi(lineOneArray[1])
	fmt.Println(strings.Join(rotateLeft(lineTwoArray, rotate), " "))
}

func rotateLeft(a []string, rotate int) []string {
	length := len(a)
	if rotate > length {
		rotate = rotate % length
	}

	result := make([]string, length)
	for key := range a {
		var index int
		preIndex := key + rotate

		if preIndex < length {
			index = preIndex
		} else {
			index = preIndex - length
		}
		result[key] = a[index]
	}
	return result
}
