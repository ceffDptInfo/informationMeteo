<?php

class Webcam
{
    private $id_web;
    private $url_web;
    private $nom_web;
    private $act_web;
    private $def_web;

    public function __construct()
    {
        $this ->pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASSWORD,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
    }

    public function __toString()
    {
        $str = "<pre>";
        $str .= "\nid_web" . $this->getIdWeb();
        $str .= "\nurl_web" . $this->getUrlWeb();
        $str .= "\nnom_web" . $this->getNomWeb();
        $str .= "\nact_web" . $this->getActWeb();
        $str .= "\ndef_web" . $this->getDefWeb();
        return $str;
    }

    public function modificationDesAct($id_web)
    {
        global $wpdb;
        $args['id_webCh'] = $id_web;
        $query = "UPDATE {$wpdb->prefix}bs_webcam set `act_web` = 0 WHERE (`id_web`) = :id_webCh";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($args);
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    public function modificationAct($id_web)
    {
        global $wpdb;
        $args['id_webCh'] = $id_web;
        $query = "UPDATE {$wpdb->prefix}bs_webcam set `act_web` = 1 WHERE (`id_web`) = :id_webCh";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($args);
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    public function modificationDef($id_web)
    {
        global $wpdb;
        $args['id_webRa'] = $id_web;
        $query1 = "UPDATE {$wpdb->prefix}bs_webcam set `def_web` = 0 where `id_web` NOT LIKE 0";
        $query2 = "UPDATE {$wpdb->prefix}bs_webcam set `def_web` = 1 WHERE (`id_web`) = :id_webRa";
        $query3 = "UPDATE {$wpdb->prefix}bs_webcam set `act_web` = 0 WHERE (`def_web`) = 1";
        try {
            $stmt = $this->pdo->prepare($query1);
            $stmt2 = $this->pdo->prepare($query2);
            $stmt3 = $this->pdo->prepare($query3);
            $stmt->execute($args);
            $stmt2->execute($args);
            $stmt3->execute($args);
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    /**
     * @param mixed $id_web
     */
    public function setIdWeb($id_web): void
    {
        $this->id_web = $id_web;
    }

    /**
     * @return mixed
     */
    public function getIdWeb()
    {
        return $this->id_web;
    }

    /**
     * @param mixed $url_web
     */
    public function setUrlWeb($url_web): void
    {
        $this->url_web = $url_web;
    }

    /**
     * @return mixed
     */
    public function getUrlWeb()
    {
        return $this->url_web;
    }

    /**
     * @param mixed $nom_web
     */
    public function setNomWeb($nom_web): void
    {
        $this->nom_web = $nom_web;
    }

    /**
     * @return mixed
     */
    public function getNomWeb()
    {
        return $this->nom_web;
    }

    /**
     * @param mixed $act_web
     */
    public function setActWeb($act_web): void
    {
        $this->act_web = $act_web;
    }

    /**
     * @return mixed
     */
    public function getActWeb()
    {
        return $this->act_web;
    }

    /**
     * @param mixed $def_web
     */
    public function setDefWeb($def_web): void
    {
        $this->def_web = $def_web;
    }

    /**
     * @return mixed
     */
    public function getDefWeb()
    {
        return $this->def_web;
    }


}
