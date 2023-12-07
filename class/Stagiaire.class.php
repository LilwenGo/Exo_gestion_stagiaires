<?php
    class Stagiaire {
        private int $id;
        private string $type_formation;
        private string $nationalite;
        private string $nom;
        private string $prenom;

        public function getId(): int {
            return $this->id;
        }

        public function setId(int $id): void {
            $this->id = $id;
        }

        public function getTypeFormation(): string {
            return $this->type_formation;
        }

        public function setTypeFormation(string $type_formation): void {
            $this->type_formation = $type_formation;
        }

        public function getNationalite(): string {
            return $this->nationalite;
        }

        public function setNationalite(string $nationalite): void {
            $this->nationalite = $nationalite;
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