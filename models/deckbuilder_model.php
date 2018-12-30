<?php

class Deckbuilder_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function cards($class, $page = 1) {
        $data = [];
        $start = ($page * 8) - 8;
        $sql = "SELECT * FROM cards WHERE class=? ORDER BY mana, name LIMIT $start,8";
        $sth = $this->db->prepare($sql);
        $sth->execute(array($class));
        $content = $sth->fetchAll();
        foreach($content as $row) {
            array_push($data,$row);
        }
        return $data;
    }
    public function totalCards($class) {
        $sql = "SELECT COUNT(*) FROM cards WHERE class=?";
        $sth = $this->db->prepare($sql);
        $sth->execute(array($class));
        $content = $sth->fetch();
        return $content[0];
    }

}
