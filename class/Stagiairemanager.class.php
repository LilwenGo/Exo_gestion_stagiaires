<?php
    class Stagiairemanager {
        private PDO $c;

        public function __construct(PDO $c) {
            $this->c = $c;
        }

        public function getAllStagiaires(): array {
            $sql = "SELECT * FROM stagiaire JOIN nationalite ON stagiaire.ID_NATIONALITE = nationalite.ID_NATIONALITE JOIN type_formation ON stagiaire.ID_TYPE = type_formation.ID_TYPE ORDER BY NOM_STAGIAIRE";
            $res = $this->c->query($sql);
            $arr = [];
            while ($ligne = $res->fetch()) {
                $s = new Stagiaire();
                $s->setId($ligne["ID_STAGIAIRE"]);
                $s->setNom($ligne["NOM_STAGIAIRE"]);
                $s->setPrenom($ligne["PRENOM_STAGIAIRE"]);
                $s->setTypeFormation($ligne["LIBELLE_TYPE"]);
                $s->setNationalite($ligne["LIBELLE_NATIONALITE"]);
                array_push($arr, $s);
            }
            return $arr;
        }

        public function insert(Stagiaire $stagiaire): int {
            $sql = "SELECT * FROM type_formation WHERE LIBELLE_TYPE LIKE :type";
            $res = $this->c->prepare($sql);
            $res->execute(array("type" => $stagiaire->getTypeFormation()));
            if($ligne = $res->fetch()) {
                $typeid = $ligne["ID_TYPE"];
            }
            $res = null;
            $sql = "SELECT * FROM nationalite WHERE LIBELLE_NATIONALITE LIKE :nationalite";
            $res = $this->c->prepare($sql);
            $res->execute(array("nationalite" => $stagiaire->getNationalite()));
            if($ligne = $res->fetch()) {
                $nationaliteid = $ligne["ID_NATIONALITE"];
            }
            $res = null;
            $sql = "INSERT INTO stagiaire (ID_TYPE, ID_NATIONALITE, NOM_STAGIAIRE, PRENOM_STAGIAIRE) VALUES (:type, :nationalite, :nom, :prenom)";
            $res = $this->c->prepare($sql);
            $res->execute(array("type" => $typeid, "nationalite" => $nationaliteid, "nom" => $stagiaire->getNom(), "prenom" => $stagiaire->getPrenom()));
            return $this->c->lastInsertId();
        }

        public function delete(array $arr): void {
            $sql = "DELETE FROM stagiaire WHERE";
            foreach($arr as $key => $val) {
                if($key == 0 || $key == "0") {
                    $sql .= " ID_STAGIAIRE = ".htmlspecialchars($val);
                } else {
                    $sql .= " OR ID_STAGIAIRE = ".htmlspecialchars($val);
                }
            }
            $this->c->query($sql);
        }

        public function getAllNationalites(): array {
            $sql = "SELECT * FROM nationalite";
            $res = $this->c->query($sql);
            $arr = [];
            while ($row = $res->fetch()) {
                array_push($arr, $row["LIBELLE_NATIONALITE"]);
            }
            $res->closeCursor();
            return $arr;
        }

        public function getAllTypeFormations(): array {
            $sql = "SELECT * FROM type_formation";
            $res = $this->c->query($sql);
            $arr = [];
            while ($row = $res->fetch()) {
                array_push($arr, $row["LIBELLE_TYPE"]);
            }
            $res->closeCursor();
            return $arr;
        }
    }
?>