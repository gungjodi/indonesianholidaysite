<?php

namespace App\Http\Controllers;

class HolidayController extends Controller
{
    public function getEvent($date)
    {
        //retrieve collection from Holiday Model
        $holidayModel = new \App\Holiday();
        $holidaysCollection = $holidayModel->getHoliday();

        //validate input date
        if(!$holidayModel->validateDate($date))
        {
            $holiday['status']='OUT_OF_RANGE';
            $holiday['message']='ERROR | DATE OF OUT RANGE';
            return $holiday;
        }

        //get holiday and compare to date input by user
        $holiday = $holidaysCollection->where('holidayDateTime','=',strtotime($date))->first();

        //if the collection is not empty, that means it is a holiday
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

    //for index view
    public function index()
    {
        return view('index');
    }
}
