package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

func solve(grid [][]int) int {
	max := 0

	for i, row := range grid {
		for j, value := range row {
			if value == 1 {
				count := countRegion(grid, i, j)
				if count > max {
					max = count
				}
			}
		}
	}

	return max
}

func countRegion(grid [][]int, i, j int) int {
	grid[i][j] = 0
	count := 1

	gridRows := len(grid)
	gridColumns := len(grid[0])

	for _, ii := range []int{-1, 0, 1} {
		for _, jj := range []int{-1, 0, 1} {
			// if the same element
			if ii == 0 && jj == 0 {
				continue
			}

			newI := i + ii
			newJ := j + jj

			if newI < 0 || newI >= gridRows {
				continue
			}

			if newJ < 0 || newJ >= gridColumns {
				continue
			}

			if value := grid[newI][newJ]; value == 1 {
				count += countRegion(grid, newI, newJ)
			}
		}
	}

	return count
}

func main() {
	reader := bufio.NewReader(os.Stdin)
	numberOfRowsLine, _ := reader.ReadString('\n')
	numberOfRows, _ := strconv.Atoi(strings.TrimSpace(numberOfRowsLine))
	reader.ReadString('\n')

	grid := make([][]int, numberOfRows)
	for i := 0; i < numberOfRows; i++ {
		rowLine, _ := reader.ReadString('\n')
		rowLine = strings.TrimSpace(rowLine)
		rowAsString := strings.Fields(rowLine)
		row := make([]int, len(rowAsString))
		for j := range rowAsString {
			row[j], _ = strconv.Atoi(rowAsString[j])
		}
		grid[i] = row
	}
	fmt.Println(solve(grid))
}
