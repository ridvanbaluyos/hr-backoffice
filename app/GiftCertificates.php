<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftCertificates extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'perks_gift_certificates';
    //

    public function employeeInformation()
    {
        return $this->belongsTo('App\EmployeeInformation', 'employee_id');
    }
}
