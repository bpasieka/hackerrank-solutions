package main

import (
	"bufio"
	"fmt"
	"os"
	"sort"
	"strconv"
	"strings"
)

func solve(flavors []int, money int) {
	flavorMap := make(map[int]int)
	var result []int

	for index, flavor := range flavors {
		if value, ok := flavorMap[flavor]; ok {
			result = append(result, index+1, value)
			break
		}

		flavorMap[money-flavor] = index + 1
	}

	sort.Ints(result)
	fmt.Printf("%d %d \n", result[0], result[1])
}

func main() {
	reader := bufio.NewReader(os.Stdin)
	visitsLine, _ := reader.ReadString('\n')
	visits, _ := strconv.Atoi(strings.TrimSpace(visitsLine))

	for i := 0; i < visits; i++ {
		moneyLine, _ := reader.ReadString('\n')
		money, _ := strconv.Atoi(strings.TrimSpace(moneyLine))

		reader.ReadString('\n')

		flavorsLine, _ := reader.ReadString('\n')
		flavorsLine = strings.TrimSpace(flavorsLine)
		flavorsString := strings.Fields(flavorsLine)
		flavors := make([]int, len(flavorsString))
		for i := range flavorsString {
			flavors[i], _ = strconv.Atoi(flavorsString[i])
		}

		solve(flavors, money)
	}
}
