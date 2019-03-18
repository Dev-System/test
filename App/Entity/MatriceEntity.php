<?php

/**
 * Class MatriceEntity | App\Entity\MatriceEntity.php
 *
 * @package     EasyD - Matrice - v7
 * @subpackage  admin
 * @author      Stéphane Ramé <stephane.rame@dev-system.com>
 * @version     v.1.0.0 (16 mars 2019)
 * @copyright   Copyright (c) 2019, Dev-System
 */

namespace App\Entity;
/**
 * Descriptif de la classe
 */
class MatriceEntity {
    
    private $id;
    private $name;
    private $email;
    private $number;
    private $password;
    private $date;
    private $comment;
    private $date_add;
    private $user_add;
    private $date_upd;
    private $user_upd;
    private $active;
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDate() {
        return $this->date;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getDate_add() {
        return $this->date_add;
    }

    public function getUser_add() {
        return $this->user_add;
    }

    public function getDate_upd() {
        return $this->date_upd;
    }

    public function getUser_upd() {
        return $this->user_upd;
    }

    public function getActive() {
        return $this->active;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

    public function setComment($comment) {
        $this->comment = $comment;
        return $this;
    }

    public function setDate_add($date_add) {
        $this->date_add = $date_add;
        return $this;
    }

    public function setUser_add($user_add) {
        $this->user_add = $user_add;
        return $this;
    }

    public function setDate_upd($date_upd) {
        $this->date_upd = $date_upd;
        return $this;
    }

    public function setUser_upd($user_upd) {
        $this->user_upd = $user_upd;
        return $this;
    }

    public function setActive($active) {
        $this->active = $active;
        return $this;
    }


}
