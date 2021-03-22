<?php


namespace App\Http\Classes;


class RoleType
{
    public const USER='user';
    public const DOCTOR='doctor';

    public const ROLE_TYPE=[
        self::USER,
        self::DOCTOR
    ];

}
