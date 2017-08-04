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

	aliceInput, _ := reader.ReadString('\n')
	aliceInput =  strings.TrimSpace(aliceInput)
	bobInput, _ := reader.ReadString('\n')
	bobInput =  strings.TrimSpace(bobInput)

	aliceRates := strings.Split(aliceInput, " ")
	bobRates := strings.Split(bobInput, " ")

	aliceRating := 0
	bobRating := 0

	for index, value := range aliceRates {
		aliceValue, _ := strconv.Atoi(value)
		bobValue, _ := strconv.Atoi(bobRates[index])

		if aliceValue > bobValue {
			aliceRating++
		}

		if aliceValue < bobValue {
			bobRating++
		}
	}

	result := strings.Join([]string{
		strconv.Itoa(aliceRating),
		strconv.Itoa(bobRating),
	}, " ")

	fmt.Println(result)
}
