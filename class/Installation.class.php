<?php


class Installation
{
    private $id_ins;
    private $date_ins;

    public function __construct()
    {
        $this ->pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASSWORD,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
    }

    public function __toString()
    {
        $str = "<pre>";
        $str .= "\nid_ins" . $this->getIdIns();
        $str .= "\ndate_ins" . $this->getDateIns();
        $str .= "</pre>";
        return $str;
    }

    public function desactive($tab){
        global $wpdb;
        $args['id_ins'] = $tab['id_ins'];
        $args['date_ins'] = $tab['date_ins'];
        $query= "DELETE FROM {$wpdb->prefix}bs_installations_active WHERE (`id_ins`) =:id_ins and `date_ins`=:date_ins LIMIT 1";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($args);
        }catch (Exception $e){
            echo $e;
            return false;
        }
    }

    public function active($tab){
        global $wpdb;
        $args['id_ins'] = $tab['id_ins'];
        $args['date_ins'] = $tab['date_ins'];
        $query= "INSERT INTO {$wpdb->prefix}bs_installations_active (`id_ins`, `date_ins`) VALUES
                                                         (:id_ins, :date_ins)";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($args);
            return $this->pdo->lastInsertId();
        }catch (Exception $e){
            echo $e;
            return false;
        }
    }


    /**
     * @param mixed $id_ins
     */
    public function setIdIns($id_ins): void
    {
        $this->id_ins = $id_ins;
    }

    /**
     * @return mixed
     */
    public function getIdIns()
    {
        return $this->id_ins;
    }

    /**
     * @param mixed $date_ins
     */
    public function setDateIns($date_ins): void
    {
        $this->date_ins = $date_ins;
    }

    /**
     * @return mixed
     */
    public function getDateIns()
    {
        return $this->date_ins;
    }
}