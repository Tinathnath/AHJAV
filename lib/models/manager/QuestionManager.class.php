<?php
/**
 * QuestionManager.class.php in ahjav.
 * User: Nathan
 * Date: 04/03/14
 * Time: 15:32
 */

namespace ahjav\models\manager;


class QuestionManager {
    private static $_instance;

    public static function getInstance()
    {
        if(!isset(self::$_instance))
            self::$_instance = new QuestionManager();

        return self::$_instance;
    }
    public function addQuestion($question)
    {
        try
        {
            $question->save();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getAllQuestions($toArray=true)
    {
        $table = \Doctrine_Core::getTable('Question');
        if($toArray)
            return $table->findAll()->toArray();
        else
            return $table->findAll();
    }

    public function deleteQuestion($id)
    {
        try{
            $query = \Doctrine_Query::create()
                ->delete('Question q')
                ->where('q.id = ?')
                ->limit(1);
            $query->execute($id);
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function updateQuestion(\Question $question)
    {
        try{
            $query = \Doctrine_Query::create()
                ->update('Question q')
                ->where('q.id = ?', $question->id)
                ->set(array(
                    'theme' => $question->theme,
                    'question' => $question->question,
                    'good_answer' => $question->good_answer,
                    'false_answer_a' => $question->false_answer_A,
                    'false_answer_b' => $question->false_answer_B,
                    'explanation' => $question->explanation
                ));
            $query->execute();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getQuestionById($id)
    {
        $table = \Doctrine_Core::getTable('Question');
        return $table->find($id);
    }

    public function getRandomQuestions()
    {
        $query = \Doctrine_Query::create()
                ->select('q.id')
                ->from('Question q');
        $results = $query->execute(array(), \Doctrine_Core::HYDRATE_SINGLE_SCALAR);
        if(sizeof($results) > 10)
        {
            $r = array();
            \shuffle($results);
            for($i=0; $i<10; $i++)
                $r[] = $results[$i];
            $results = $r;
        }
        $finalQuery = \Doctrine_Query::create()
            ->select()
            ->from('Question q')
            ->whereIn('q.id', $results);
        return $finalQuery->execute();
    }
}