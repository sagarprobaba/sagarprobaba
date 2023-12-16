<?php

namespace App\Imports;

use App\Models\Verification;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
class VerifyDocument implements ToModel, WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (Session()->get('verificationType')=="aV") {
            return new Verification([
            'brandId' =>Session()->get('brandid'),
            'checkID' =>$row[0],
            'employeeID' =>$row[1],
            'candidateName' =>$row[2],
            'mobileNo' =>$row[3],
            'fatherName' =>$row[4],
            'dateOfBirth' =>$row[5],
            'periOdofStay' =>$row[6],
            'address' =>$row[7],
            'city' =>$row[8],
            'state' =>$row[9],
            'pinCode' =>$row[10],
            'landMark' =>$row[11],
            'clientName' =>$row[12],
            'caseInitiatedDate' =>date('d F Y, h:i:s A'),
            'status' =>"O",
            'reportGeneratedDate' =>date('d F Y, h:i:s A'),
            'overdueStatus' =>"abcd",
            'gsAllocated' =>1,
            'verificationType' =>Session()->get('verificationType')

        ]);
        }
        if(Session()->get('verificationType')=="cV")
        {
            return new Verification([
                'brandId' =>Session()->get('brandid'),
                'checkID' =>$row[0],
                'companyName' =>$row[1],
                'address' =>$row[2],
                'city' =>$row[3],
                'state' =>$row[4],
                'pinCode' =>$row[5],
                'landMark' =>$row[6],
                'clientName' =>$row[7],
                'existingSince' =>$row[8],
                'mobileNo' =>$row[9],
                'caseInitiatedDate' =>date('d F Y, h:i:s A'),
                'status' =>"O",
                'reportGeneratedDate' =>date('d F Y, h:i:s A'),
                'overdueStatus' =>"abcd",
                'gsAllocated' =>1,
                'verificationType' =>Session()->get('verificationType')
            ]);
        }
        if(Session()->get('verificationType')=="eV")
        {
            return new Verification([
                'brandId' =>Session()->get('brandid'),
                'checkID' =>$row[0],
                'companyName' =>$row[1],
                'address' =>$row[2],
                'city' =>$row[3],
                'state' =>$row[4],
                'pinCode' =>$row[5],
                'landMark' =>$row[6],
                'clientName' =>$row[7],                
                'employeeID' =>$row[8],
                'empName' =>$row[9],
                'mobileNo' =>$row[10],
                'designation' =>$row[11],
                'reportingManagersName' =>$row[12],
                'lastDrawnSalary' =>$row[13],
                'periodOfWork' =>$row[14],
                'caseInitiatedDate' =>date('d F Y, h:i:s A'),
                'status' =>"O",
                'reportGeneratedDate' =>date('d F Y, h:i:s A'),
                'overdueStatus' =>"abcd",
                'gsAllocated' =>1,
                'verificationType' =>Session()->get('verificationType')
            ]);
        }
    }
    
}
