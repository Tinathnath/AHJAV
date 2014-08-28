<?php
/**
 * JSONEncoder.class.php in ahjav.
 * User: Nathan
 * Date: 27/02/14
 * Time: 21:56
 */

namespace ahjav\utils;
define("UTF8_ENCODE", 1);
define("UTF8_DECODE", 2);
define("NONE", 3);

class JSONEncoder {

    private static $_instance = null;

    public static function getInstance()
    {
        if(!isset(self::$_instance))
            self::$_instance = new JSONEncoder();

        return self::$_instance;
    }

    public function encodePartenaires($partenaires, $withPromos = true)
    {
        $returnPartners = array();
        if(sizeof($partenaires) > 0)
        {
            foreach($partenaires as $partner)
            {
                if($withPromos)
                    $promos = $partner->getPromotions()->toArray();
                else
                    $promos = array();

                if($partner->image == null)
                    $imagePath = "";
                else
                    $imagePath = $partner->image;

                $returnPartners[] = array(
                   'id' => $partner->id,
                   'nom' => $partner->nom,
                   'url' => \stripslashes($partner->url),
                   'address' => $partner->address,
                   'lat' => $partner->lat,
                   'lng' => $partner->lng,
                   'promos' => $promos,
                   'image' => 'http://www.ahjav.fr.ht/web/assets/img/media/'.$imagePath
                );
            }
        }
        return json_encode($returnPartners);
    }

    public function encodePromotions($promotions)
    {
        $return = array();
        foreach($promotions as $promo)
        {
            if($promo->image == null)
                $imagePath = "";
            else
                $imagePath = $promo->image;

            $return[] = array(
              'id' => $promo->id,
              'nom' => $promo->nom,
              'categorie' => $promo->categorie,
              'image' => 'http://www.ahjav.fr.ht/web/assets/img/media/'.$imagePath
            );
        }
        return json_encode($return);
    }

    public function encodeWines($vins)
    {
        $return = array();
        if(sizeof($vins) > 0)
        {
            foreach($vins as $vin)
            {
                $return[] = array(
                  'id' => $vin->id,
                  'nom' => $vin->nom,
                  'couleur' => $vin->couleur,
                  'millesime' => $vin->millesime,
                  'region' => $vin->region,
                  'caracteristiques' => $vin->caracteristiques,
                  'met' => $vin->met,
                  'met_url' => 'http://www.ahjav.fr.ht/web/assets/img/media/'.$vin->met_url,
                  'prix' => $vin->prix,
                  'caviste' => $vin->caviste
                );
            }
        }
        return json_encode($return);
    }

    public function encodeAnecdotes($anecdotes)
    {
        $return = array();
        if(sizeof($anecdotes) > 0)
        {
            foreach($anecdotes as $anecdote)
            {
                $return[] = array(
                    'id' => $anecdote->id,
                    'titre' => $this->charEncode($anecdote->titre),
                    'texte' => $this->charEncode($anecdote->texte)
                );
            }
        }
        return json_encode($return);
    }

    public function encodeQuestions($questions)
    {
        $return = array();
        if(sizeof($questions) > 0)
        {
            foreach($questions as $question)
            {
                $return[] = array(
                    'id' => $question->id,
                    'theme' => $this->charEncode($question->theme),
                    'question' => $this->charEncode($question->question),
                    'good_answer' => $this->charEncode($question->good_answer),
                    'false_answer_1' => $this->charEncode($question->false_answer_A),
                    'false_answer_2' => $this->charEncode($question->false_answer_B),
                    'explanation' => $this->charEncode($question->explanation)
                );
            }
        }
        return json_encode($return);
    }

    public function encodeSponsors($sponsors)
    {
        $return = array();
        if(sizeof($sponsors) > 0)
        {
            foreach($sponsors as $sponsor)
            {
                $return[] = array(
                    'id' => $sponsor->id,
                    'nom' => $this->charEncode($sponsor->nom),
                    'logo_url' => \stripslashes('http://www.ahjav.fr.ht/web/assets/img/media/'.$sponsor->logo_url),
                    'website' => \stripslashes($sponsor->website)
                );
            }
        }
        return json_encode($return);
    }

    public function encodeActualite($actualites)
    {
        $return = array();
        if(sizeof($actualites) > 0)
        {
            foreach($actualites as $actu)
            {
                $return[] = array(
                    'id' => $actu->id,
                    'titre' => $this->charEncode($actu->titre),
                    'texte' => \stripslashes($actu->content),
                    'image' => \stripslashes('http://www.ahjav.fr.ht/web/assets/img/media/'.$actu->image)
                );
            }
        }
        return json_encode($return);
    }

    private function charEncode($string, $encoder=NONE)
    {
        switch($encoder)
        {
            case UTF8_ENCODE:
                return utf8_encode($string);
                break;
            case UTF8_DECODE:
                return utf8_decode($string);
            break;
            case NONE:
                return $string;
            break;
            default:
                return $string;
            break;
        }
    }
}