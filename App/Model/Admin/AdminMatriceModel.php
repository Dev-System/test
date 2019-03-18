<?php

/**
 * Class AdminMatriceModel | AdminMatriceModel.php
 *
 * @package     EasyD - Matrice - v7
 * @subpackage  admin
 * @author      Stéphane Ramé <stephane.rame@dev-system.com>
 * @version     v.1.0.0 (16 mars 2019)
 * @copyright   Copyright (c) 2019, Dev-System
 */

namespace App\Model\Admin;

use Easyd\Model\Admin\AdminModel;
use Easyd\Recherche\Recherche;
use App\Entity\MatriceEntity;

/**
 * Descriptif de la classe
 */
class AdminMatriceModel extends AdminModel {

    protected $tableDefault = 'matrice';
    public static $tableMatrice = 'matrice';
    public $sessionRech = 'SearchMatrice';

    public function save(MatriceEntity $entity) {

        /** Contrôle des données */
        if (!$this->message->getError()) {
            if ($this->checkExisteChamps('name', $entity)) {
                $this->message->add('danger', 'Ce "Nom" existe déjà.');
            }
        }

        /** Sauvegarde de l'objet */
        if (!$this->message->getError()) {

            if ($entity->getId()) {
                $this->update($entity);
            } else {
                $this->add($entity);
            }
        }
    }

    /**
     * Ajoute un enregistrement
     */
    private function add(MatriceEntity $entity) {

        if (!$this->message->getError()) {

            $sql = 'INSERT INTO ' . self::$tableMatrice . ' SET '
                    . 'name="' . $this->db::cSQL($entity->getName()) . '", '
                    . 'email="' . $this->db::cSQL($entity->getEmail()) . '", '
                    . 'number="' . $this->db::cSQL($entity->getNumber()) . '", '
                    . 'date_add=NOW(), '
                    . 'user_add="' . $this->db::cSQL($this->auth->getPseudo()) . '"';

            $newId = $this->db->newSql($sql);

            if ($newId) {

                $message = '<b>' . $entity->getName() . '</b> enregistré - '
                        . '<a href = "' . self::$chemin . '?a=edit&id=' . $newId . '" '
                        . 'class = "btn btn-outline-secondary">voir</a>';

                $this->message->add('success', $message);
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit();
            } else {
                $this->message->add('danger', 'Problème lors de l\'enregistrement');
            }
        }
    }

    /**
     * Modifier les paramètres d'un enregistrement
     * 
     * @param MatriceEntity $entity
     * @return boolean
     */
    private function update(MatriceEntity $entity) {

        /** Enregitrement des données */
        $sql = 'UPDATE ' . self::$tableMatrice . ' SET '
                . 'name="' . $this->db::cSQL($entity->getName()) . '", '
                . 'email="' . $this->db::cSQL($entity->getEmail()) . '", '
                . 'number="' . $this->db::cSQL($entity->getNumber()) . '", '
                . 'active="' . $this->db::cSQL($entity->getActive()) . '" '
                . 'WHERE id="' . $this->db::cSQL($entity->getId()) . '" ';

        $this->db->upSql($sql, 1, self::$tableMatrice, $this->auth->getPseudo(), $entity->getId());

        return true;
    }
    
    /**
     * Génère la liste des éléments
     * 
     * @param string $submit
     */
    public function getList(?string $submit) {

        $submit = filter_input(INPUT_POST, 'submit');

        /** Formulaire de recherche */
        $Rech = new Recherche();
        $Rech->RechSql($this->sessionRech, $this->tableDefault);

        @$Rech->Param[] = array($Rech->criteres['what'], $Rech->criteres['where'], $Rech->criteres['exact'], 'texte');
        @$Rech->Param[] = array($Rech->criteres['active'], 'active', '=', 'boolean');

        if ($submit) {

            if ($submit == 'recherche') {
                $Rech->criteres['what'] = filter_input(INPUT_POST, 'what');
                $Rech->criteres['where'] = filter_input(INPUT_POST, 'where');
                $Rech->criteres['exact'] = filter_input(INPUT_POST, 'exact');
                $Rech->criteres['active'] = filter_input(INPUT_POST, 'active');

                $Rech->Criteres();
            }

            if ($submit == 'reset') {
                $Rech->Efface();
            }

            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        }

        /** Liste à afficher */
        $sql = 'SELECT ' . $this->tableDefault . '.* '
                . 'FROM ' . $this->tableDefault . ' '
                . 'WHERE ' . $this->tableDefault . '.id!="" '
                . $Rech->RequeteSql()
                . 'ORDER BY ' . $this->tableDefault . '.name ASC';

        $this->list = $this->db->reqMultiPage($sql);
        $this->barre_nav2 = $this->db->BarreNavigation;
        $this->nbtotal = $this->db->nbTotal;
        $this->recherche = $_SESSION[$this->sessionRech] ?? null;
    }

}
