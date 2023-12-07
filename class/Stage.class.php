<?php
    class Stage {
        private Stagiaire $stagiaire;
        private Formateur $formateur;
        private $date_d;
        private $date_f;
        
        public function getStagiaire(): Stagiaire {
            return $this->stagiaire;
        }

        public function setStagiaire(Stagiaire $stagiaire): void {
            $this->stagiaire = $stagiaire;
        }

        public function getFormateur(): Formateur {
            return $this->formateur;
        }

        public function setFormateur(Formateur $formateur): void {
            $this->formateur = $formateur;
        }

        public function getDateD() {
            return $this->date_d;
        }

        public function setDateD($date_d): void {
            $this->date_d = $date_d;
        }

        public function getDateF() {
            return $this->date_f;
        }

        public function setDateF($date_f): void {
            $this->date_f = $date_f;
        }
    }
?>