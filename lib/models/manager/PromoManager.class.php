<?php
/**
 * PromoManager.class.php in ahjav.
 * User: Nathan
 * Date: 05/03/14
 * Time: 09:49
 */

namespace ahjav\models\manager;
require_once __DIR__.'/../../utils/Upload.class.php';

class PromoManager {
    private static $_instance;
    public static function getInstance()
    {
        if(!isset(self::$_instance))
            self::$_instance = new PromoManager();
        return self::$_instance;
    }

    public function addPromo(\Promotion $promo)
    {
        try
        {
            $promo->save();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getAllPromos()
    {
        $table = \Doctrine_Core::getTable('Promotion');
        return $table->findAll()->toArray();
    }

    public function deletePromotion($id)
    {
        try{
            $query = \Doctrine_Query::create()
                ->delete('Promotion p')
                ->where('p.id = ?')
                ->limit(1);
            $query->execute($id);
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function updatePromotion(\Promotion $promotion)
    {
        try{
            $query = \Doctrine_Query::create()
                ->update('Promotion p')
                ->where('p.id = ?', $promotion->id)
                ->set(array(
                   'nom' => $promotion->nom,
                   'categorie' => $promotion->categorie,
                   'partenaire_id' => $promotion->partenaire_id
                ));
            $query->execute();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getPromoById($id)
    {
        $table = \Doctrine_Core::getTable('Promotion');
        return $table->find($id);
    }

    public function handleImageUpload($fileKeyName)
    {
        $handle = new \upload($_FILES[$fileKeyName], 'fr_FR');
        $handle->file_safe_name = true;
        $handle->file_name_body_pre = 'promocode-'.date('Y-m-d');
        $handle->image_resize = true;
        $handle->image_x = 400;
        $handle->image_ratio_y = true;
        $handle->image_ratio_no_zoom_in = true;
        $handle->process(__DIR__.'/../../../web/assets/img/media');
        if($handle->processed)
        {
            $path = $handle->file_dst_name;
            $handle->clean();
            return $path;
        }
        else
        {
            throw new \ErrorException(stripslashes($handle->error), 101001);
        }
    }

}