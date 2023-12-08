<?php
    class Stagiaire {
        private int $id;
        private string $type_formation;
        private string $nationalite;
        private string $nom;
        private string $prenom;
        private array $formateurs;

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

        public function getFormateurs(): array {
            return $this->formateurs;
        }

        public function setFormateurs(array|Formateur $formateurs, string $method = "set"): bool {
            if($method === "set" && is_array($formateurs)) {
                $this->formateurs = $formateurs;
                return true;
            } else if ($method === "push" && is_object($formateurs)) {
                array_push($this->formateurs, $formateurs);
                return true;
            } else {
                return false;
            }
        }
    }
?>