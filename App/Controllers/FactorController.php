<?php

use App\Interfaces\DatabaseInterface;
use App\Models\FactorModel;

class FactorController{

    public function __construct(protected DatabaseInterface $database)
    {
    $this->database->selectDatabase('projeto-esg')->selectCollection('factors');
    }
    
    public  function addFactor(FactorModel $factorModel)
    {
        try{
            $this->database->insertOne($factorModel->toArray());

        }
        catch(Exception $e){
            return $e->getMessage(); 
        }
    }
}