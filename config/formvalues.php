<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Form Select Option Values
    |--------------------------------------------------------------------------
    |
    | Kindly check the database table schema. Some column values may be using
    | an enum data type. So any changes here, there should also be an alter table
    | on the specified table (eg. employee_information)
    |
    */

    // Gender
    'gender' => [
        'Male' => 'Male',
        'Female' => 'Female',
    ],

    // Marital Status
    'marital_status' => [
        'Single' => 'Single',
        'Married' => 'Married',
        'Separated' => 'Separated by Law',
        'Widowed' => 'Widow/Widower',
    ],

    // Employee Status
    'employee_status' => [
        'Trainee' => 'Trainee',
        'Probationary' => 'Probationary',
        'Regular' => 'Regular',
        'Officer' => 'Officer',
        'Freelance' => 'Freelance',
        'Terminated' => 'Terminated',
        'Resigned' => 'Resigned',
        'Contractual' => 'Contractual',
        'Retired' => 'Retired',
        'End of Contract' => 'End of Contract',
        'Consultant' => 'Consultant',
        'Project' => 'Project',
        'Transferred' => 'Transferred',
        'Deceased' => 'Deceased',
    ],

    // HR Backoffice Roles
    'backoffice_roles' => [
        'User' => 'User',
        'Admininstrator' => 'Admininstrator',
    ],

    // Tax Status
    'tax_status' => [
        'S' => 'S',
        'S1' => 'S1',
        'S2' => 'S2',
        'S3' => 'S3',
        'S4' => 'S4',
        'ME' => 'ME',
        'ME1' => 'ME1',
        'ME2' => 'ME2',
        'ME3' => 'ME3',
        'ME4' => 'ME4',
        'Z' => 'Z',
    ],

    // Withholding Tax (in %)
    'withholding_tax' => [
        '2' => '2%',
        '10' => '10%',
        '15' => '15%',
    ],
];
