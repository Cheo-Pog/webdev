<?php
namespace App\Modules;

enum Role {
    case Guest = 0;
    case User = 1;
    case Admin = 2;
}