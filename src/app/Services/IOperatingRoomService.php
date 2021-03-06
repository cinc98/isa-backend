<?php

namespace App\Services;

interface IOperatingRoomService
{
    function addOperatingRoom(array $operatingRoomData);
    function seeIfOpRoomBooked($id);
    function searchOperatingRooms($name, $number, $date);
    function getAppointments($id);
    function getFirstFreeDate($id);
    function getOperations($id);
    function getFirstFreeDateFromDate($id,$from,$clinic_id);

}