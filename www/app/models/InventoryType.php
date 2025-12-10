<?php 

namespace App\Models;

enum InventoryType: string
{
    case NEW = 'new';
    case USED = 'used';
    case CERTIFIED = 'certified';
}