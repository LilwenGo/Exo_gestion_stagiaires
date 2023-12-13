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
            return $this->prenom;
        }

        public function setPrenom(string $prenom): void {
            $this->prenom = $prenom;
        }

        public function getFormateurs(): array {
            return $this->formateurs;
        }

        //Je ne me sert pas de cette fonction, je l'avais créée pour stocker les formateurs
        public function setFormateurs(array|Formateur $formateurs, string $method = "set"): bool {
            //On passe un tableau ou un objet Formateur et un mot clé set|push pour la methode d'affectation
            //Pour le mot clé set on remplace le tableau $this->formateurs par le nouveau
            if($method === "set" && is_array($formateurs)) {
                $this->formateurs = $formateurs;
                return true;
            //Pour le mot clé push ça fait un push d'un element
            } else if ($method === "push" && is_object($formateurs)) {
                array_push($this->formateurs, $formateurs);
                return true;
            } else {
                return false;
            }
        }
    }
?>