<?php
    class Stagemanager {
        private PDO $c;

        public function __construct(PDO $c) {
            $this->c = $c;
        }

        public function insert(Stage $stage): void {
            $sql = "INSERT INTO former (ID_STAGIAIRE, ID_FORMATEUR, DATE_DEBUT, DATE_FIN) VALUES (:stgr, :frmt, :dd, :df)";
            $res = $this->c->prepare($sql);
            $res->execute(array("stgr" => $stage->getStagiaire()->getId(), "frmt" => $stage->getFormateur()->getId(), "dd" => $stage->getDateD(), "df" => $stage->getDateF()));
        }
    }
?>