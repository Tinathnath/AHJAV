<?php

/**
 * AnecdoteTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AnecdoteTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object AnecdoteTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Anecdote');
    }
}