package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

const failingLimit = 38

func main() {
	reader := bufio.NewReader(os.Stdin)
	numString, _ := reader.ReadString('\n')
	num, _ := strconv.Atoi(strings.TrimSpace(numString))

	for i := 0; i < num; i++ {
		scoreString, _ := reader.ReadString('\n')
		score, _ := strconv.Atoi(strings.TrimSpace(scoreString))
		if score >= failingLimit && score%5 >= 3 {
			score = score - (score % 5) + 5
		}
		fmt.Println(score)
	}
}
