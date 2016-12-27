<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamManager extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'team_managers';
    //

    public function employeeInformation()
    {
        return $this->belongsTo('App\EmployeeInformation', 'employee_id');
    }

}
