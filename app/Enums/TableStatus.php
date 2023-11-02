<?php

namespace App\Enums;

enum TableStatus: String{
    case Pending = "pending";
    case Avaliable = "avaliable";
    case Unavaliable = "unavaliable";
}
