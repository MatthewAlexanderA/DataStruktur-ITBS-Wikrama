<?php 

class MaxHeap{
    private $heap;

    public function __construct(){
        $this->heap = array();
    }

    // Function for get index from parent node
    private function getParentIndex($index){
        return floor(($index - 1) / 2);
    }

    // Function for get index from left child node
    private function getLeftChildIndex($index){
        return 2 * $index + 1;
    }

    // Function for get index from right child node
    private function getRightChildIndex($index){
        return 2 * $index + 2;
    }

    // Function for add elemen into the heap
    public function insert($value){
        $this->heap[] = $value;
        $this->heapifyUp();
    }

    // Function for keeping heap properties from bottom to top
    private function heapifyUp(){
        $index = count($this->heap) - 1;
        while($index > 0 && $this->heap[$index] > $this->heap[$this->getParentIndex($index)]){
            $this->swap($index, $this->getParentIndex($index));
        }
    }

    // Function for delete bigest element (root) from heap
    public function extractMax(){
        if(count($this->heap) == 0){
            throw new Exception("Heap is empty");
        }
        $max = $this->heap[0];
        $this->heap[0] = array_pop($this->heap);
        $this->heapifyDown(0);
        return $max;
    }

    // Funciton for implement heap properties from top to bottom
    private function heapifyDown($index){
        $leftChildIndex = $this->getLeftChildIndex($index);
        $rightChildIndex = $this->getRightChildIndex($index);
        $largest = $index;

        if($leftChildIndex < count($this->heap) && $this->heap[$leftChildIndex] > $this->heap[$largest]){
            $largest = $leftChildIndex;
        }

        if($rightChildIndex < count($this->heap) && $this->heap[$rightChildIndex] > $this->heap[$largest]){
            $largest = $rightChildIndex;
        }

        if($largest != $index){
            $this->swap($index, $largest);
            $this->heapifyDown($largest);
        }
    }

    // Function for swap 2 element in heap
    private function swap($index1, $index2){
        $temp = $this->heap[$index1];
        $this->heap[$index1] = $this->heap[$index2];
        $this->heap[$index2] = $temp;
    }

    // Function for get bigest element (root) without deleting it
    public function peek(){
        if(count($this->heap) == 0){
            throw new Exception("Heap is empty");
        }
        return $this->heap[0];
    } 

    // Function for print elements in heap
    public function printHeap(){
        foreach($this->heap as $value) {
            echo $value . ", ";
        }
        echo "<br>";
    }
}

// Usage
$maxHeap = new MaxHeap();
$maxHeap->insert(3);
$maxHeap->insert(10);
$maxHeap->insert(5);
$maxHeap->insert(6);
$maxHeap->insert(2);

$maxHeap->printHeap();

echo "Max value: " . $maxHeap->extractMax() . "<br>";
$maxHeap->printHeap()

// Matthew Alexander Andriyanto
// 231232025

?>