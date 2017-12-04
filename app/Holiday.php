<?php

namespace App;

class Holiday
{
    //Get holiday list from Google Calendar API - constants can be found in config/constants.php
    public function getHoliday()
    {
        $collection = json_decode(file_get_contents(config('constants.HOLIDAY_URL')),false);
        $itemsCollection = $collection->items;

        foreach ($itemsCollection as $item)
        {
            $holidaysCollection[]= array(
                "message"=>$item->summary,
                "holidayDate"=>$item->start->date,
                "holidayDateTime"=>strtotime($item->start->date)
            );
        }
        return collect($holidaysCollection);
    }

    //validate input date is in 2018
    function validateDate($date)
    {
        // Convert to timestamp
        $startDate = strtotime(config('constants.START_DATE'));
        $endDate = strtotime(config('constants.END_DATE'));

        // Check that user date is between start & end
        return ((strtotime($date) >= $startDate) && (strtotime($date) <= $endDate));
    }
}
