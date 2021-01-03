<?php

use App\DataBinder\RaceData;
use App\Service\ConnectionBdClass;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class RaceDataTest extends TestCase {
    /**
     * @test
     */
    public function ajout_de_race(){
        //Etant donnée les info donnée
        $nomRace = "Humain";

        //Action que l'on va éxécuté sur le systeme
        
        $race_data = new RaceData();
        $race_data->addRace($nomRace);

        //Résultat auquel on s'attend

        //Sois que le nom de la race sois dans la liste des races 
        //Ou alors que cette race sois déja dans la base de données

        $list_race_data = $race_data->getListRace();

        $race_dans_la_list = FALSE;
        //Parcours de la liste pour voir si notre nom de race est a l'intérieur
        foreach ($list_race_data as $raceValue) {
            if ($raceValue == $nomRace) {
                $race_dans_la_list = TRUE;
            }
        }

        //Parcours les infos de la base de données pour voir si le nom de la race existait déja
        $classConn = new ConnectionBdClass();
        $conn = $classConn->getConnection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt =$conn->prepare("SELECT name FROM race");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_COLUMN,0);

        $list_fetch_race = $stmt->fetchAll();
        $race_dans_la_bd = FALSE;
        
        foreach ($list_fetch_race as $race_value ) {
            if ($race_value == $nomRace) {
                $race_dans_la_bd = TRUE;
                
            }
        }

        //Sois la race est dans la bd sois dans la classe
        $apparition_dans_une_seul_liste = ($race_dans_la_list xor $race_dans_la_bd);
        // dd($apparition_dans_une_seul_liste);
        // dd($race_dans_la_bd,$race_dans_la_list);
        assertEquals(TRUE,$apparition_dans_une_seul_liste);
    }


}