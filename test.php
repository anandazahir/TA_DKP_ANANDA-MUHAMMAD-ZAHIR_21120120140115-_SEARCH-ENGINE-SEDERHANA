<?php
    class test {
        private $test1;
        private $test2 = 100;

        public function __construct($test1){
            $this->test1 = $test1;
        }
        public function gettest(){
            return $this->test1 * $this-> test2;
        }
    }
    $test = 100;
    $kelas = new test($test);
    $hasil = $kelas->gettest();
    echo $hasil;
?>    