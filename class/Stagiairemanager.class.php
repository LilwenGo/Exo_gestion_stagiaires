<?php
    class Stagiairemanager {
        private PDO $c;

        public function __construct(PDO $c) {
            $this->c = $c;
        }

        //Foction qui return un tableau de tous les stagiaires stockés en bdd
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

        //Fonction qui insere des donnés en bdd pour la table stagiaire
        public function insert(Stagiaire $stagiaire): int {
            //Requete de récuperation de l'id du type (en effet je stocke le libelle seulement en objet)
            $sql = "SELECT * FROM type_formation WHERE LIBELLE_TYPE LIKE :type";
            $res = $this->c->prepare($sql);
            $res->execute(array("type" => $stagiaire->getTypeFormation()));
            if($ligne = $res->fetch()) {
                $typeid = $ligne["ID_TYPE"];
            }
            $res = null;
            //Même chose pour la nationalité
            $sql = "SELECT * FROM nationalite WHERE LIBELLE_NATIONALITE LIKE :nationalite";
            $res = $this->c->prepare($sql);
            $res->execute(array("nationalite" => $stagiaire->getNationalite()));
            if($ligne = $res->fetch()) {
                $nationaliteid = $ligne["ID_NATIONALITE"];
            }
            $res = null;
            //Requete d'insertion de l'objet dans la table
            $sql = "INSERT INTO stagiaire (ID_TYPE, ID_NATIONALITE, NOM_STAGIAIRE, PRENOM_STAGIAIRE) VALUES (:type, :nationalite, :nom, :prenom)";
            $res = $this->c->prepare($sql);
            $res->execute(array("type" => $typeid, "nationalite" => $nationaliteid, "nom" => $stagiaire->getNom(), "prenom" => $stagiaire->getPrenom()));
            //Retour de l'id d'insertion pour utilisation ulterieire
            return $this->c->lastInsertId();
        }

        //Fonction qui modifie des donnés en bdd pour la table stagiaire
        public function update(Stagiaire $stagiaire): void {
            //Requete de récuperation de l'id du type (en effet je stocke le libelle seulement en objet)
            $sql = "SELECT * FROM type_formation WHERE LIBELLE_TYPE LIKE :type";
            $res = $this->c->prepare($sql);
            $res->execute(array("type" => $stagiaire->getTypeFormation()));
            if($ligne = $res->fetch()) {
                $typeid = $ligne["ID_TYPE"];
            }
            $res = null;
            //Même chose pour la nationalité
            $sql = "SELECT * FROM nationalite WHERE LIBELLE_NATIONALITE LIKE :nationalite";
            $res = $this->c->prepare($sql);
            $res->execute(array("nationalite" => $stagiaire->getNationalite()));
            if($ligne = $res->fetch()) {
                $nationaliteid = $ligne["ID_NATIONALITE"];
            }
            $res = null;
            //Requete de modification de l'objet dans la table
            $sql = "UPDATE stagiaire SET ID_TYPE = :type, ID_NATIONALITE = :nationalite, NOM_STAGIAIRE = :nom, PRENOM_STAGIAIRE = :prenom WHERE ID_STAGIAIRE = :id";
            $res = $this->c->prepare($sql);
            $res->execute(array("type" => $typeid, "nationalite" => $nationaliteid, "nom" => $stagiaire->getNom(), "prenom" => $stagiaire->getPrenom(), "id" => $stagiaire->getId()));
        }

        //Fonction de supression, on passe un tableau d'ids pour savoir lequels suprimer
        public function delete(array $arr): void {
            $sql = "DELETE FROM stagiaire WHERE";
            //Boucle qui permet de ne faire qu'une requete pour toutes les supressions
            foreach($arr as $key => $val) {
                if($key == 0 || $key == "0") {
                    $sql .= " ID_STAGIAIRE = ".htmlspecialchars($val);
                } else {
                    $sql .= " OR ID_STAGIAIRE = ".htmlspecialchars($val);
                }
            }
            $this->c->query($sql);
        }

        //Recupere toutes les nationalités stockées en bdd puis renvoie un tableau corespondant
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

        //Même chose mais pour les types de formation
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