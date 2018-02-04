package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

func isPrime(n int) bool {
	if n <= 1 {
		return false
	}

	for i := 2; i*i <= n; i++ {
		if n%i == 0 {
			return false
		}
	}

	return true
}

func main() {
	reader := bufio.NewReader(os.Stdin)
	reader.ReadString('\n')

	for {
		line, err := reader.ReadString('\n')
		number, _ := strconv.Atoi(strings.TrimSpace(line))

		if isPrime(number) {
			fmt.Println("Prime")
		} else {
			fmt.Println("Not prime")
		}

		if err != nil {
			break
		}
	}
}
