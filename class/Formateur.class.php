<?php
    class Formateur {
        private int $id;
        private string $salle;
        private string $nom;
        private string $prenom;
        private array $types = [];

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

        public function getTypes(): array {
            return $this->types;
        }

        public function setTypes(array|string $types, string $method = "set"): bool {
            if($method === "set" && is_array($types)) {
                $this->types = $types;
                return true;
            } else if ($method === "push" && is_string($types)) {
                array_push($this->types, $types);
                return true;
            } else {
                return false;
            }
        }
    }
?>