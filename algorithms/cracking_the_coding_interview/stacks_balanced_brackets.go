package main

import (
	"bufio"
	"fmt"
	"os"
	"strings"
)

const (
	YES = "YES"
	NO  = "NO"
)

func main() {
	reader := bufio.NewReader(os.Stdin)
	reader.ReadString('\n')

	for {
		brackets, err := reader.ReadString('\n')
		brackets = strings.TrimSpace(brackets)

		fmt.Println(areBalancedBrackets(brackets))

		if err != nil {
			break
		}
	}
}

func areBalancedBrackets(brackets string) string {
	var stack []string

	for _, v := range brackets {
		bracket := string(v)
		if bracket == "(" || bracket == "{" || bracket == "[" {
			stack = append([]string{bracket}, stack...)
			continue
		}

		if len(stack) == 0 {
			return NO
		}

		popFromStack := stack[0]
		stack = stack[1:]

		if bracket == ")" && popFromStack != "(" {
			return NO
		}
		if bracket == "}" && popFromStack != "{" {
			return NO
		}
		if bracket == "]" && popFromStack != "[" {
			return NO
		}
	}

	if len(stack) > 0 {
		return NO
	}

	return YES
}
