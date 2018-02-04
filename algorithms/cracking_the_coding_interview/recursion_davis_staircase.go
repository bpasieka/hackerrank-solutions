package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

func numberOfWays(n int) int {
	memo := make(map[int]int)
	return numberOfWaysIter(n, 0, memo)
}

func numberOfWaysIter(n int, ways int, memo map[int]int) int {
	if n < 0 {
		return 0
	}

	if n == 0 {
		ways++
		return ways
	}

	if value, ok := memo[n]; ok {
		return value
	}

	ways = numberOfWaysIter(n-1, ways, memo) +
		numberOfWaysIter(n-2, ways, memo) +
		numberOfWaysIter(n-3, ways, memo)
	memo[n] = ways

	return ways
}

func main() {
	reader := bufio.NewReader(os.Stdin)
	reader.ReadString('\n')

	for {
		line, err := reader.ReadString('\n')
		number, _ := strconv.Atoi(strings.TrimSpace(line))

		fmt.Println(numberOfWays(number))

		if err != nil {
			break
		}
	}
}
