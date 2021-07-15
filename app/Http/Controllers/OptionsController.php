<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Options;

class OptionsController extends Controller
{
    private $optionsModel;
   public function __construct(){
       $optionsModel=new Options;
   }

    public function setOptionToAvailable($optionCode,$flag=1){

     return  $this->optionsModel->setOptionFlag($optionCode,$flag);
    }


    public function setOptionToUnAvailable($optionCode,$flag=0){

      return  $this->optionsModel->setOptionFlag($optionCode,$flag);
    }

    public function getOptionStatus()
    {
       return  $this->optionsModel->getOptionStatusForCode();
    }


    public function showAllOptions(){

    }


    public function testGetOptionStatus()
    {
       $this->optionsModel->getOptionStatus();
    }



}
