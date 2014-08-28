<?php
/**
 * PartenairesManager.class.php in ahjav.
 * User: Nathan
 * Date: 02/03/14
 * Time: 19:21
 */

namespace ahjav\models\manager;

require_once __DIR__.'/../../utils/Upload.class.php';
class PartenairesManager {

    private static $_instance;
    public static function getInstance()
    {
        if(!isset(self::$_instance))
            self::$_instance = new PartenairesManager();
        return self::$_instance;
    }

    public function getLastPartenaires()
    {
        $query = \Doctrine_Query::create()
            ->from('Partenaire p')
            ->limit(10);
        return $query->fetchArray();
    }

    public function addPartenaire($partenaire)
    {
        try
        {
            $partenaire->save();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getAllPartenaires($toArray=true)
    {
        $table = \Doctrine_Core::getTable('Partenaire');
        if($toArray)
            return $table->findAll()->toArray();
        else
            return $table->findAll();
    }

    public function deletePartenaire($id)
    {
        try{
            $query = \Doctrine_Query::create()
                ->delete('Partenaire p')
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

    public function updatePartenaire(\Partenaire $partneraire)
    {
        try{
            $query = \Doctrine_Query::create()
                ->update('Partenaire p')
                ->where('p.id = ?', $partneraire->id)
                ->set(array(
                    'nom' => $partneraire->nom,
                    'url' => $partneraire->url,
                    'address' => $partneraire->address,
                    'lat' => $partneraire->lat,
                    'lng' => $partneraire->lng
                ));
            $query->execute();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getPartenaireById($id)
    {
        $table = \Doctrine_Core::getTable('Partenaire');
        return $table->find($id);
    }

    public function handleImageUpload($fileKeyName)
    {
        $handle = new \upload($_FILES[$fileKeyName], 'fr_FR');
        $handle->file_safe_name = true;
        $handle->file_name_body_pre = 'partenaire-'.date('Y-m-d');
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