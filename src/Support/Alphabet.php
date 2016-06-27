<?php

// TODO: I think the overall premise of this class is currently
// unicode-UNfriendly, so only expect it to work for "ASCII plus"
// at the moment. Eventually I'll explore this as people need it...
class Alphabet {

    protected $ranges;
    protected $isolates;
    protected $count;

    const UNIQUE_STRING_MODE = 3;

    public function __construct($characters)
    {
        if (is_array($characters)) {
            $this->set($characters);
        }
    }

    public function reset()
    {
        $this->ranges   = [];
        $this->isolates = [];
        $this->count    = 0;
    }

    public function set(array $characters)
    {
        foreach ($characters as $range) {
            if (is_array($range)) {
                if (count($range) === 2) {
                    if (is_string($range[0]) && is_string($range[1])) {
                        $this->ranges[] = [ord($range[0]), ord($range[1])];
                    } elseif (is_int($range[0]) && is_int($range[1])) {
                        $this->ranges = $range;
                    } else {
                        throw new InvalidArgumentException('Alphabet ranges must be strings or ints');
                    }
                } else {
                    throw new InvalidArgumentException('Alphabet ranges must be pairs');
                }
            } elseif (is_string($range)) {
                if (length($range) === 1) {
                    $this->isolates[] = ord($range);
                } else {
                    // TODO: setter for string-style "a-z"?
                    throw new InvalidArgumentException('Alphabet characters must be length-1 strings');
                }
            } elseif (is_int($range)) {
                // TODO: bother with checking the value? (ie between 0 and 255)
                $this->isolates[] = $range;
            } else {
                throw new InvalidArgumentException('Alphabet config must only contain strings, integers, and subarrays');
            }
        }
        // TODO: check for overlap / simplify etc
    }

    // public function generateCount()
    // {
    //     $c = 0;
    //     foreach($this->ranges) {

    //     }
    // }

    // protected function checkForOverlap()
    // {
    //     foreach ($this->ranges as $index => $range1) {
    //         for ($i = $index+1; $i < count($this->ranges); $i++) {
    //             $range2 = $this->ranges[$i];
    //             if ($range2[0] > )
    //         }
    //     }
    // }



}