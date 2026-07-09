<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;


#[
    OA\Info(
        title: 'Rest API documentation',
        version: 1.0
    ),  
    OA\PathItem(
        path: '/api/'
    )
]



abstract class Controller
{
    //
}
