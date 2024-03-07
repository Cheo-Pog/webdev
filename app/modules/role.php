<?php
namespace App\Modules;

enum Role {
    case Guest = 1;
    case User = 2;
    case Admin = 3;
}