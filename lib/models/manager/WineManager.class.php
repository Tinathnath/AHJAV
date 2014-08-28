<?php
/**
 * WineManager.class.php in ahjav.
 * User: Nathan
 * Date: 02/03/14
 * Time: 18:03
 */

namespace ahjav\models\manager;
require_once __DIR__.'/../../utils/Upload.class.php';

class WineManager {

    private static $_instance;
    public static function getInstance()
    {
        if(!isset(self::$_instance))
            self::$_instance = new WineManager();

        return self::$_instance;
    }

    public function getLastWines()
    {
        $query = \Doctrine_Query::create()
            ->from('Vin v')
            ->limit(10);
        return $query->fetchArray();
    }

    public function getAllVins($toArray=true)
    {
        $table = \Doctrine_Core::getTable('Vin');
        if($toArray)
            return $table->findAll()->toArray();
        else
            return $table->findAll();
    }

    public function addVin(\Vin $vin)
    {
        try
        {
            $vin->save();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function deleteVin($id)
    {
        try{
            $query = \Doctrine_Query::create()
                ->delete('Vin v')
                ->where('v.id = ?')
                ->limit(1);
            $query->execute($id);
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function updateVin(\Vin $vin)
    {
        try{
            $query = \Doctrine_Query::create()
                ->update('Vin v')
                ->where('v.id = ?', $vin->id)
                ->set(array(
                    'nom' => $vin->nom,
                    'couleur' => $vin->couleur,
                    'millesime' => $vin->millesime,
                    'region' => $vin->region,
                    'caracteristiques' => $vin->caracteristiques,
                    'met' => $vin->met,
                    'met_url' => $vin->met_url,
                    'prix' => $vin->prix,
                    'caviste' => $vin->caviste
                ));
            $query->execute();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getVinById($id)
    {
        $table = \Doctrine_Core::getTable('Vin');
        return $table->find($id);
    }

    public function handleImageUpload($fileKeyName)
    {
        $handle = new \upload($_FILES[$fileKeyName], 'fr_FR');
        $handle->file_safe_name = true;
        $handle->file_name_body_pre = date('Y-m-d');
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

    public function deleteImage($filename)
    {
        return @unlink(__DIR__.'/../../../web/assets/img/media/'.$filename);
    }
}