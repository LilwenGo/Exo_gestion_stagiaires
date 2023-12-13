<?php
    class Formateurmanager {
        private PDO $c;

        public function __construct(PDO $c) {
            $this->c = $c;
        }

        //Fonction de retour de tous les formateurs dans un tableau d'objets du même nom
        public function getAllFormateurs(): array {
            $sql = "SELECT * FROM formateur JOIN salle ON formateur.ID_SALLE = salle.ID_SALLE";
            $res = $this->c->query($sql);
            $arr = [];
            while ($ligne = $res->fetch()) {
                $f = new Formateur();
                $f->setId($ligne["ID_FORMATEUR"]);
                $f->setNom($ligne["NOM"]);
                $f->setPrenom($ligne["PRENOM"]);
                $f->setSalle($ligne["LIBELLE_SALLE"]);
                $sql2 = "SELECT * FROM specialiser JOIN type_formation ON specialiser.ID_TYPE = type_formation.ID_TYPE WHERE ID_FORMATEUR = :id";
                $res2 = $this->c->prepare($sql2);
                $res2->execute(array("id" => $f->getId()));
                while ($ligne2 = $res2->fetch()) {
                    $f->setTypes($ligne2["LIBELLE_TYPE"], "push");
                }
                array_push($arr, $f);
            }
            return $arr;
        }
    }
?>