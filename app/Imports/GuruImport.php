<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
{
    private int $schoolId;

    // Terima school_id dari controller, bukan dari file Excel
    public function __construct(int $schoolId)
    {
        $this->schoolId = $schoolId;
    }

    public function model(array $row)
    {
        // Dengan WithHeadingRow, kolom diakses by nama bukan index
        // Format Excel cukup 3 kolom: name | email | password
        return new User([
            'name'      => $row['name'],
            'email'     => $row['email'],
            'password'  => Hash::make($row['password']),
            'role'      => 'guru',
            'school_id' => $this->schoolId, // ← otomatis dari admin login
        ]);
    }
}