<?php

namespace App\Http\Controllers;
use App\Appointment;
use App\Services\IAppointmentService;
use App\Http\Requests\AppointmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class AppointmentController extends Controller
{
    public function __construct(IAppointmentService $appointmentService)
    {
        $this->_appointmentService = $appointmentService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->_appointmentService->addAppointment($request->all());
    }

    public function reserve($appointment_id)
    {
        return $this->_appointmentService->reserve($appointment_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function patientHistory($id)
    {
        return $this->_appointmentService->showPatientHistory($id);
    }

    public function requestAppointment($id, Request $request)
    {
        return $this->_appointmentService->requestAppointment($id,$request->all());

    }

    public function searchAppointment(Request $request)
    {
        return $this->_appointmentService->searchAppointment($request->input('date'),$request->input('type'));
    }

    public function confirm($encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $appointment = Appointment::findOrFail($id);
        $appointment->approved = 1;
        $appointment->save();

        return response()->json(['message' => 'Appointment confirmed!']);     
    }

    public function decline($encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $appointment = Appointment::findOrFail($id);
        $appointment->approved = -1;
        $appointment->save();

        return response()->json(['message' => 'Appointment declined!']);     
    }
}
