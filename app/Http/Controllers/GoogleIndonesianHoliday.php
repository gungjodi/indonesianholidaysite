<?php

namespace App\Http\Controllers;

class GoogleIndonesianHoliday extends Controller
{
    public function getEvent($date)
    {
        $holidayModel = new \App\Holiday();
        $holidaysCollection = $holidayModel->getHoliday();

        if(!$holidayModel->validateDate($date))
        {
            $holiday['status']='OUT_OF_RANGE';
            $holiday['message']='ERROR | DATE OF OUT RANGE';
            return $holiday;
        }

        $holiday = $holidaysCollection->where('holidayDateTime','=',strtotime($date))->first();

        if(!empty($holiday))
        {
            $holiday['isHoliday']=1;
        }
        else
        {
            $holiday['isHoliday']=0;
            $holiday['message']="NOT A HOLIDAY :(";
        }
        $holiday['status']='OK';



        return $holiday;
    }

    public function index()
    {
        return view('index');
    }
}
