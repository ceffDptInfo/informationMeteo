<?php

class BulletinMeteo
{
    private $id_bul;
    private $heure_bul;
    private $date_bul;
    private $temperature_bul;
    private $id_met;
    private $id_pst;
    private $id_nge;
    private $id_web;
    private $texte_bul;
    private $pdo;

    public function __construct()
    {
        $this ->pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASSWORD,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
    }

    public function __toString()
    {
        $str = "<pre>";
        $str .= "\nheure_bul" . $this->getHeureBul();
        $str .= "\ndate_bul" . $this->getDateBul();
        $str .= "\ntemperature_bul" . $this->getTemperatureBul();
        $str .= "\nid_met" . $this->getIdMet();
        $str .= "\nid_pst" . $this->getIdPst();
        $str .= "\nid_nge" . $this->getIdNge();
        $str .= "\nid_web" . $this->getIdWeb();
        $str .= "\ntexte_bul" . $this->getTexteBul();
        $str .= "</pre>";
        return $str;
    }

    public function add($tab){
        $args['heure_bul'] = $tab['heure_bul'];
        $args['date_bul'] = $tab['date_bul'];
        $args['temperature_bul'] = $tab['temperature_bul'];
        $args['id_met'] = $tab['id_met'];
        $args['id_pst'] = $tab['id_pst'];
        $args['id_nge'] = $tab['id_nge'];
        $args['id_web'] = $tab['id_web'];
        $args['texte_bul'] = $tab['texte_bul'];

        $query= "INSERT INTO wp_bs_bulletin (`heure_bul`, `date_bul`, `temperature_bul`, `id_met`, `id_pst`, `id_nge`, `id_web`, `texte_bul`) VALUES
                                            (:heure_bul, :date_bul, :temperature_bul, :id_met, :id_pst, :id_nge, :id_web, :texte_bul)";
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
     * @param mixed $id_bul
     */
    public function setIdBul($id_bul): void
    {
        $this->id_bul = $id_bul;
    }

    /**
     * @return mixed
     */
    public function getIdBul()
    {
        return $this->id_bul;
    }

    /**
     * @param mixed $heure_bul
     */
    public function setHeureBul($heure_bul): void
    {
        $this->heure_bul = $heure_bul;
    }

    /**
     * @return mixed
     */
    public function getHeureBul()
    {
        return $this->heure_bul;
    }

    /**
     * @param mixed $date_bul
     */
    public function setDateBul($date_bul): void
    {
        $this->date_bul = $date_bul;
    }

    /**
     * @return mixed
     */
    public function getDateBul()
    {
        return $this->date_bul;
    }

    /**
     * @param mixed $temperature_bul
     */
    public function setTemperatureBul($temperature_bul): void
    {
        $this->temperature_bul = $temperature_bul;
    }

    /**
     * @return mixed
     */
    public function getTemperatureBul()
    {
        return $this->temperature_bul;
    }

    /**
     * @param mixed $id_met
     */
    public function setIdMet($id_met): void
    {
        $this->id_met = $id_met;
    }

    /**
     * @return mixed
     */
    public function getIdMet()
    {
        return $this->id_met;
    }

    /**
     * @param mixed $id_pst
     */
    public function setIdPst($id_pst): void
    {
        $this->id_pst = $id_pst;
    }

    /**
     * @return mixed
     */
    public function getIdPst()
    {
        return $this->id_pst;
    }

    /**
     * @param mixed $id_nge
     */
    public function setIdNge($id_nge): void
    {
        $this->id_nge = $id_nge;
    }

    /**
     * @return mixed
     */
    public function getIdNge()
    {
        return $this->id_nge;
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
     * @param mixed $texte_bul
     */
    public function setTexteBul($texte_bul): void
    {
        $this->texte_bul = $texte_bul;
    }

    /**
     * @return mixed
     */
    public function getTexteBul()
    {
        return $this->texte_bul;
    }
}

?>