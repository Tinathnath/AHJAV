<?php
/**
 * SponsorManager.class.php in ahjav.
 * User: Nathan
 * Date: 19/03/14
 * Time: 22:23
 */

namespace ahjav\models\manager;
require_once __DIR__.'/../../utils/Upload.class.php';

class SponsorManager {
    private static $_instance;

    public static function getInstance()
    {
        if(!isset(self::$_instance))
            self::$_instance = new SponsorManager();

        return self::$_instance;
    }
    public function addSponsor($sponsor)
    {
        try
        {
            $sponsor->save();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getAllSponsors($toArray=true)
    {
        $table = \Doctrine_Core::getTable('Sponsor');
        if($toArray)
            return $table->findAll()->toArray();
        else
            return $table->findAll();
    }

    public function deleteSponsor($id)
    {
        try{
            $query = \Doctrine_Query::create()
                ->delete('Sponsor p')
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

    public function updateSponsor(\Sponsor $sponsor)
    {
        try{
            $query = \Doctrine_Query::create()
                ->update('Sponsor p')
                ->where('p.id = ?', $sponsor->id)
                ->set(array(
                    'nom' => $sponsor->nom,
                    'logo_url' => $sponsor->logo_url,
                    'website' => $sponsor->website
                ));
            $query->execute();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getSponsorById($id)
    {
        $table = \Doctrine_Core::getTable('Sponsor');
        return $table->find($id);
    }

    public function handleImageUpload($fileKeyName)
    {
        $handle = new \upload($_FILES[$fileKeyName], 'fr_FR');
        $handle->file_safe_name = true;
        $handle->file_name_body_pre = 'sponsor-'.date('Y-m-d');
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