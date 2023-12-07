<?php
    class Formateur {
        private int $id;
        private string $salle;
        private string $nom;
        private string $prenom;

        public function getId(): int {
            return $this->id;
        }

        public function setId(int $id): void {
            $this->id = $id;
        }

        public function getSalle(): string {
            return $this->salle;
        }

        public function setSalle(string $salle): void {
            $this->salle = $salle;
        }

        public function getNom(): string {
            return $this->nom;
        }

        public function setNom(string $nom): void {
            $this->nom = $nom;
        }

        public function getPrenom(): string {
            return $this->nom;
        }

        public function setPrenom(string $nom): void {
            $this->nom = $nom;
        }
    }
?>