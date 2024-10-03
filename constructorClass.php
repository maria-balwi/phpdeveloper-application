<?php

    // CLASS THAT WILL PERFORM BUBBLE SORT AND GET THE MEDIAN AND LARGEST NUMBER IN THE ARRAY
    class BubbleSort {
        private $numbers = [];

        public function __construct(array $numbers) {
            $this->numbers = $numbers;
            $this->bubbleSort();
        }

        private function bubbleSort() {
            $n = count($this->numbers);
            for ($i = 0; $i < $n; $i++) {
                for ($j = 0; $j < $n - $i - 1; $j++) {
                    if ($this->numbers[$j] > $this->numbers[$j + 1]) {
                        // Swap values
                        $temp = $this->numbers[$j];
                        $this->numbers[$j] = $this->numbers[$j + 1];
                        $this->numbers[$j + 1] = $temp;
                    }
                }
            }
        }

        // FUNCTION THAT WILL GET THE LARGEST NUMBER
        public function getLargestValue() {
            return $this->numbers[count($this->numbers) - 1];
        }

        // FUNCTION THAT WILL GET MEDIAN NMBER
        public function getMedianValue() {
            $n = count($this->numbers);
            $middleIndex = floor($n / 2);

            if ($n % 2 == 0) {
                return ($this->numbers[$middleIndex - 1] + $this->numbers[$middleIndex]) / 2;
            } else {
                return $this->numbers[$middleIndex];
            }
        }

        public function displaySortedArray() {
            return $this->numbers;
        }
    }

    class SortHandler {
        private $bubbleSort;

        public function __construct(array $numbers) {
            $this->bubbleSort = new BubbleSort($numbers);
        }

        public function displaySortedArray() {
            $sortedArray = $this->bubbleSort->displaySortedArray();
            echo "Sorted Array: " . implode(", ", $sortedArray) . "<br>";
        }
    
        public function displayResults() {
            echo "Largest Value: " . $this->bubbleSort->getLargestValue() . "<br>";
            echo "Median Value: " . $this->bubbleSort->getMedianValue() . "<br>";
        }
    }

    // SAMPLE EXECUTION
    echo "<h3>Bubble Sort Program</h3>";
    $numbers = [34, 7, 23, 32, 5];
    echo "Array: " . implode(", ", array_slice($numbers, 0, 5));
    echo "<br>";
    $sortHandler = new SortHandler($numbers);
    $sortHandler->displaySortedArray();
    $sortHandler->displayResults();

?>