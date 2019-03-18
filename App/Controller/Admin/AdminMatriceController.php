<?php

/**
 * Class AdminMatriceController | AdminMatriceController.php
 *
 * @package     EasyD - Matrice - v7
 * @subpackage  admin
 * @author      Stéphane Ramé <stephane.rame@dev-system.com>
 * @version     v.1.0.0 (16 mars 2019)
 * @copyright   Copyright (c) 2019, Dev-System
 */

namespace App\Controller\Admin;

use Easyd\Controller\Admin\AdminController;
use App\Model\Admin\AdminMatriceModel;
use App\Entity\MatriceEntity;

/**
 * Descriptif de la classe
 */
class AdminMatriceController extends AdminController {

    protected $model;
    public static $chemin = '/' . SYS_REP . SYS_ADMIN . 'matrice/';
    protected $pathTpl = 'app/article/';
    public $txt = [
        'listTitle' => 'Liste des éléments',
        'editTitle' => 'Modifier un élément',
        'addTitle' => 'Ajouter un élément',
        'confirmDelete' => 'Etes-vous sûr(e) de vouloir supprimer cet élément ?',
        'addButton' => 'Ajouter un élément'
    ];

    public function __construct() {
        parent::__construct();

        $this->model = new AdminMatriceModel();
    }

    public function index() {

        /** Affichage de toutes les fiches */
        $this->model->getList($this->submit);

        $this->smarty->assign('module', $this);

        $this->smarty->assign('liste', $this->model->list);
        $this->smarty->assign('barre_nav2', $this->model->barre_nav2);
        $this->smarty->assign('nbtotal', $this->model->nbtotal);
        $this->smarty->assign('recherche', $this->model->recherche);

        $this->render($this->pathTpl . 'list.tpl');
    }

    /**
     * Affiche une vue d'édition
     */
    public function edit() {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $entity = $this->model->loadEntity($id, 'App\Entity\MatriceEntity');

        if ($entity) {

            if ($this->submit == 'save') {

                $entity->setName(filter_input(INPUT_POST, 'name'))
                        ->setEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL))
                        ->setNumber(filter_input(INPUT_POST, 'number', FILTER_VALIDATE_INT))
                        ->setActive(filter_input(INPUT_POST, 'active', FILTER_VALIDATE_BOOLEAN));

                $this->model->save($entity);
            }
            $this->smarty->assign('entity', $entity);
            $this->smarty->assign('module', $this);

            $this->render($this->pathTpl . 'edit.tpl');
        } else {
            $this->message->add('danger', 'Elément introuvable');
            header('Location:' . self::$chemin);
            exit();
        }
    }

    /**
     * Affiche une vue d'ajout
     */
    public function add() {

        $entity = new MatriceEntity();

        if ($this->submit == 'save') {

            $entity->setName(filter_input(INPUT_POST, 'name'))
                    ->setEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL))
                    ->setNumber(filter_input(INPUT_POST, 'number', FILTER_VALIDATE_INT));

            $this->model->save($entity);
        }
        $this->smarty->assign('entity', $entity);
        $this->smarty->assign('module', $this);

        $this->render($this->pathTpl . 'add.tpl');
    }

    /**
     * Renvoi le menu de gauche de l'espace "Administration"
     */
    public function showLeftMenu() {

        $menu = [];
        $i = 0;

        /**
         * $menu[] = [
         *     0 => Lien,
         *     1 => Ancre,
         *     2 => Id,
         *     3 => class,
         *     4 => target
         * ];
         */
        $menu[] = [
            0 => SYS_PATHDIR . '/matrice/',
            1 => 'Les éléments',
            2 => '',
            3 => 'hover default',
            4 => 'pages'
        ];

        $this->smarty->assign('menu', $menu);
        $this->smarty->assign('menuTitre', 'Matrice');

        $this->render('core/menu.tpl');
    }

}
