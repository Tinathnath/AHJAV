<?php
/**
 *
 */

namespace ahjav\models\manager;
require_once __DIR__.'/../../utils/Upload.class.php';

class ActusManager {

    private static $_instance;

    public static function getInstance()
    {
        if(!isset(self::$_instance))
            self::$_instance = new ActusManager();

        return self::$_instance;
    }
    public function addActus($actus)
    {
        try
        {
            $actus->save();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getAllActualites($toArray=true)
    {
        $table = \Doctrine_Core::getTable('Actualite');
        if($toArray)
            return $table->findAll()->toArray();
        else
            return $table->findAll();
    }

    public function getLastActualites()
    {
        $query = \Doctrine_Query::create()
            ->from('Actualite a')
            ->orderBy('actuDate')
            ->limit(10);
        return $query->fetchArray();
    }

    public function deleteActualite($id)
    {
        try{
            $query = \Doctrine_Query::create()
                ->delete('Actualite a')
                ->where('a.id = ?')
                ->limit(1);
            $query->execute($id);
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function updateActualite(\Actualite $actualite)
    {
        try{
            $query = \Doctrine_Query::create()
                ->update('Actualite a')
                ->where('a.id = ?', $actualite->id)
                ->set(array(
                    'titre' => $actualite->titre,
                    'content' => $actualite->content,
                    'image' => $actualite->image
                ));
            $query->execute();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getActualiteById($id)
    {
        $table = \Doctrine_Core::getTable('Actualite');
        return $table->find($id);
    }

    public function handleImageUpload($fileKeyName)
    {
        $handle = new \upload($_FILES[$fileKeyName], 'fr_FR');
        $handle->file_safe_name = true;
        $handle->file_name_body_pre = 'actu-'.date('Y-m-d');
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