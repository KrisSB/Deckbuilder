<?php

class Deckbuilder extends Controller {

    function __construct() {
        parent::__construct();
        $this->_load_deck_model();
    }
    public function index() {
        $this->view->render('deckbuilder','index');
    }
    private function check($choice) {
        $classes = ['Druid','Hunter','Mage','Paladin','Priest','Rogue','Shaman','Warlock','Warrior'];
        for($i = 0; $i < count($classes); $i++) {
            if($choice == $classes[$i]) {
                return TRUE;
            }
        }
        return FALSE;
    }
    public function classes($choice = FALSE) {
        if(($choice == FALSE) || ($this->check($choice) == FALSE)) {
            Error::page_not_exist();
        }
        $this->view->class = $choice;

        $this->view->cardCollection = $this->deckBuilder->cards($choice,1);
        
        $this->view->totalClass = $this->deckBuilder->totalCards($choice);
        $this->view->totalNeutral = $this->deckBuilder->totalCards('Neutral');
        
        $this->view->render('deckbuilder','classes');
    }
    public function cards($class = 'Neutral', $page = 1) {
        $this->view->cardCollection = $this->deckBuilder->cards($class,$page);
        $this->view->require_page('deckbuilder/cards');
    } 
    private function _load_deck_model() {
        require_once 'models/deckbuilder_model.php';
        $this->deckBuilder = new Deckbuilder_Model();
    }
}