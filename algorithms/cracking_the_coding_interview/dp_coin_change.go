package main

import (
	"bufio"
	"fmt"
	"os"
	"sort"
	"strconv"
	"strings"
)

func numberOfWays(goal int, coins []int) int {
	memo := make(map[string]int)
	sort.Sort(sort.Reverse(sort.IntSlice(coins)))

	return numberOfWaysIter(goal, coins, 0, memo)
}

func numberOfWaysIter(toGoal int, coins []int, index int, memo map[string]int) int {
	if toGoal < 0 {
		return 0
	}

	if toGoal == 0 {
		return 1
	}

	if index == len(coins) && toGoal > 0 {
		return 0
	}

	key := fmt.Sprintf("%d_%d", toGoal, index)
	if value, ok := memo[key]; ok {
		return value
	}

	memo[key] = numberOfWaysIter(toGoal-coins[index], coins, index, memo) +
		numberOfWaysIter(toGoal, coins, index+1, memo)

	return memo[key]
}

func main() {
	reader := bufio.NewReader(os.Stdin)
	lineOne, _ := reader.ReadString('\n')
	lineOneElements := strings.Fields(strings.TrimSpace(lineOne))
	goal, _ := strconv.Atoi(lineOneElements[0])

	lineTwo, _ := reader.ReadString('\n')
	lineTwoElements := strings.Fields(strings.TrimSpace(lineTwo))
	coins := make([]int, len(lineTwoElements))
	for i := range lineTwoElements {
		coins[i], _ = strconv.Atoi(lineTwoElements[i])
	}

	fmt.Println(numberOfWays(goal, coins))
}
