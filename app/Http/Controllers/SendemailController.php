<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Models\Borrow;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class SendemailController extends Controller
{
    function sendEMail()
    {
        $lateReturn = Borrow::join('employees', 'borrows.employee_id_borrow', '=', 'employees.employee_id')
            ->where('borrows.employee_id_return', '=', NULL)
            ->where('borrows.date_return', '=', NULL)->get(['employees.employee_name', 'borrows.trno', 'borrows.asset_id', 'borrows.date_return_plan', 'borrows.employee_id_borrow']);

        foreach ($lateReturn as $d) { //looping all data borrow status not yet return
            $today = date('Y-m-d');

            // dd($d->date_return_plan, ' ', $today);
            if ($d->date_return_plan < $today) { //if found data late, do this step and send email
                $data = [
                    'trno' => $d->trno,
                    'employee_name' => $d->employee_name,
                    'asset_id' => $d->asset_id,
                    'date_return_plan' => $d->date_return_plan
                ];

                $email = Email::where('employee_id', '=', $d->employee_id_borrow)->get(); //looking for email that have late return asset

                foreach ($email as $e) {
                    $e->email;
                    // Mail::to([$e->email])->cc(['syifa.dwi@sht.ssbshoes.com', 'teguh.mulyadi@sht.ssbshoes.com'])->send(new ContactForm($data)); //ContactForm is template to send email
                    if (Mail::to([$e->email])->cc(['syifa.dwi@sht.ssbshoes.com', 'teguh.mulyadi@sht.ssbshoes.com'])->send(new ContactForm($data)) == true) {
                        // Mail::to([$e->email])->cc(['syifa.dwi@sht.ssbshoes.com', 'teguh.mulyadi@sht.ssbshoes.com'])->send(new ContactForm($data));
                        echo "Success send Email to : " . $e->email;
                        echo "<br>";
                    } else {
                        echo "Failed send Email to : " . $e->email . "Please Check!!!!";
                        echo "<br>";
                    }
                }
            } else {
                echo "no late data borrow " . $d->trno;
                echo "<br>";
            }
        }
    }
}
