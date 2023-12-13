<?php
    class Stagemanager {
        private PDO $c;

        public function __construct(PDO $c) {
            $this->c = $c;
        }

        //Recupere toutes les formations d'un stagiaire passé en parametre et renvoie un tableau d'objets Stage (formations)
        public function getStages(Stagiaire $stgr): array {
            $sql = "SELECT * FROM former JOIN formateur ON former.ID_FORMATEUR = formateur.ID_FORMATEUR JOIN salle ON formateur.ID_SALLE = salle.ID_SALLE WHERE ID_STAGIAIRE = :id";
            $res = $this->c->prepare($sql);
            $res->execute(["id" => $stgr->getId()]);
            $arr = [];
            while ($ligne = $res->fetch()) {
                $f = new Formateur();
                $f->setNom($ligne["NOM"]);
                $f->setSalle($ligne["LIBELLE_SALLE"]);
                $stg = new Stage();
                $stg->setFormateur($f);
                $stg->setDateD($ligne["DATE_DEBUT"]);
                $stg->setDateF($ligne["DATE_FIN"]);
                array_push($arr, $stg);
            }
            return $arr;
        }

        //Recupere les dates d'une formation entre un stagiaire et un formateur passé en parametre et les return dans un objet Stage
        public function getAllDates(Stagiaire $stgr, Formateur $f): Stage {
            $sql = "SELECT * FROM former WHERE ID_STAGIAIRE = :stgr AND ID_FORMATEUR = :f";
            $res = $this->c->prepare($sql);
            $res->execute(array("stgr" => $stgr->getId(), "f" => $f->getId()));
            $s = new Stage();
            if($ligne = $res->fetch()) {
                $s->setDateD($ligne["DATE_DEBUT"]);
                $s->setDateF($ligne["DATE_FIN"]);
            }
            return $s;
        }

        //Fonction d'insertion des formations
        public function insert(Stage $stage): void {
            $sql = "INSERT INTO former (ID_STAGIAIRE, ID_FORMATEUR, DATE_DEBUT, DATE_FIN) VALUES (:stgr, :frmt, :dd, :df)";
            $res = $this->c->prepare($sql);
            $res->execute(array("stgr" => $stage->getStagiaire()->getId(), "frmt" => $stage->getFormateur()->getId(), "dd" => $stage->getDateD(), "df" => $stage->getDateF()));
        }

        //Fonction de supression, on passe un tableau d'ids pour savoir lequels suprimer
        public function delete(array $arr): void {
            $sql = "DELETE FROM former WHERE";
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
    }
?>