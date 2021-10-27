<?php

namespace App\Http\Dtos;

use Illuminate\Http\Request;

interface DtoInterface
{
    /**
     * @param Request $request
     * @return void
     */
    public function setProperties(Request $request): void;
}
