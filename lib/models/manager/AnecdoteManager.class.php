<?php
/**
 * AnecdoteManager.class.php in ahjav.
 * User: Nathan
 * Date: 02/03/14
 * Time: 18:12
 */

namespace ahjav\models\manager;


class AnecdoteManager {

    private static $_instance;

    public static function getInstance()
    {
        if(!isset(self::$_instance))
            self::$_instance = new AnecdoteManager();

        return self::$_instance;
    }
    public function addAnecdote($anecdote)
    {
        try
        {
            $anecdote->save();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getAllAnecdotes($toArray=true)
    {
        $table = \Doctrine_Core::getTable('Anecdote');
        if($toArray)
            return $table->findAll()->toArray();
        else
            return $table->findAll();
    }

    public function getLastAnecdotes()
    {
        $query = \Doctrine_Query::create()
               ->from('Anecdote a')
               ->limit(10);
        return $query->fetchArray();
    }

    public function deleteAnecdote($id)
    {
        try{
            $query = \Doctrine_Query::create()
                ->delete('Anecdote a')
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

    public function updateAnecdote(\Anecdote $anecdote)
    {
        try{
            $query = \Doctrine_Query::create()
                ->update('Anecdote a')
                ->where('a.id = ?', $anecdote->id)
                ->set(array(
                    'titre' => $anecdote->titre,
                    'texte' => $anecdote->texte
                ));
            $query->execute();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getAnecdoteById($id)
    {
        $table = \Doctrine_Core::getTable('Anecdote');
        return $table->find($id);
    }
}