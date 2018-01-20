package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

const (
	TYPE_ENQUEUE = 1
	TYPE_DEQUEUE = 2
	TYPE_PEEK    = 3
)

type Queue struct {
	stackInput  []int
	stackOutput []int
}

func (queue *Queue) Enqueue(value int) {
	queue.stackInput = append(queue.stackInput, value)
}

func (queue *Queue) Dequeue() {
	if len(queue.stackOutput) == 0 {
		queue.moveInputToOutput()
	}

	length := len(queue.stackOutput)
	if length == 0 {
		return
	}

	queue.stackOutput = queue.stackOutput[:length-1]
}

func (queue *Queue) Peek() (int, error) {
	if len(queue.stackOutput) == 0 {
		queue.moveInputToOutput()
	}

	length := len(queue.stackOutput)
	if length == 0 {
		return 0, fmt.Errorf("nothing is returned")
	}

	return queue.stackOutput[length-1], nil
}

func (queue *Queue) moveInputToOutput() {
	length := len(queue.stackInput)
	for i := length - 1; i >= 0; i-- {
		queue.stackOutput = append(queue.stackOutput, queue.stackInput[i])
	}
	queue.stackInput = []int{}
}

func process(queue *Queue, typeId int, typeValue int) (int, error) {
	if typeId == TYPE_ENQUEUE {
		queue.Enqueue(typeValue)
		return 0, fmt.Errorf("nothing is returned")
	}

	if typeId == TYPE_DEQUEUE {
		queue.Dequeue()
		return 0, fmt.Errorf("nothing is returned")
	}

	if typeId == TYPE_PEEK {
		return queue.Peek()
	}

	return 0, fmt.Errorf("nothing is returned")
}

func main() {
	reader := bufio.NewReader(os.Stdin)
	reader.ReadString('\n')
	queue := Queue{}

	for {
		line, err := reader.ReadString('\n')
		line = strings.TrimSpace(line)
		lineData := strings.Fields(line)

		typeId, _ := strconv.Atoi(lineData[0])
		typeValue := 0
		if len(lineData) > 1 {
			typeValue, _ = strconv.Atoi(lineData[1])
		}

		if value, err := process(&queue, typeId, typeValue); err == nil {
			fmt.Println(value)
		}

		if err != nil {
			break
		}
	}
}
