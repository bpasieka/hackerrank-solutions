package main

import "fmt"

func fibonacci(n int) int {
	memo := make(map[int]int)
	return fibonacciIter(n, memo)
}

func fibonacciIter(n int, memo map[int]int) int {
	if n == 0 || n == 1 {
		return n
	}

	value, ok := memo[n]
	if !ok {
		value = fibonacciIter(n-1, memo) + fibonacciIter(n-2, memo)
		memo[n] = value
	}

	return value
}

func main() {
	var n int
	fmt.Scanf("%d\n", &n)
	fmt.Println(fibonacci(n))
}
