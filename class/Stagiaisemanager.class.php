<?php
    class Stagiairemanager {
        private PDO $c;

        public function __construct(PDO $c) {
            $this->c = $c;
        }

        public function getAllStagiaires(): array {
            $sql = "SELECT * FROM stagiaire JOIN nationalite ON stagiaire.ID_NATIONALITE = nationalite.ID_NATIONALITE JOIN type_formation ON stagiaire.ID_TYPE = type_formation.ID_TYPE";
            $res = $this->c->query($sql);
            $arr = [];
            while ($ligne = $res->fetch()) {
                $s = new Stagiaire();
                $s->setId($ligne["ID_FORMATEUR"]);
                $s->setNom($ligne["NOM"]);
                $s->setPrenom($ligne["PRENOM"]);
                $s->setTypeFormation($ligne["LIBELLE_TYPE"]);
                $s->setNationalite($ligne["LIBELLE_NATIONALITE"]);
                /* $sql2 = "SELECT * FROM specialiser JOIN type_formation ON specialiser.ID_TYPE = type_formation.ID_TYPE WHERE ID_FORMATEUR = :id";
                $res2 = $this->c->prepare($sql2);
                $res2->execute(array("id" => $s->getId()));
                while ($ligne2 = $res2->fetch()) {
                    $s->setFormateurs($ligne2["LIBELLE_TYPE"], "push");
                } */
                array_push($arr, $s);
            }
            return $arr;
        }
    }
?>