{{-- <h3>Testing send email!</h3> --}}
<h3>Dears <b><?= $data['employee_name'] ?></b></h3>

<h3>transaction No. <b><?= $data['trno'] ?></b> with asset code <b><?= $data['asset_id'] ?></b> past the return date at <b><?= date('m/d/Y', strtotime($data['date_return_plan'])); ?></b></h3>
<h3>Thank you!</h3>
{{-- <h3>Harap segera dikembalikan ke IT. Terimakasih!</h3> --}}