<?php
    class Stagemanager {
        private PDO $c;

        public function __construct(PDO $c) {
            $this->c = $c;
        }
    }
?>