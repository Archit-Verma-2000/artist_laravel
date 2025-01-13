<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // Correct import for Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;  // For factory support

class Customer extends Authenticatable  // Extending Authenticatable for authentication
{
    use HasFactory;  // Eloquent factory support
    protected $guard='customer';
    // Define the attributes that are mass assignable
    protected $fillable = ['name', 'email', 'password'];

    // Define the attributes that should be hidden when the model is converted to an array or JSON
    protected $hidden = ['password', 'remember_token'];
}
