<?php
namespace App\Imports;
use App\Models\Resell;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;
class ResellImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        dd($row[0]);
//        return new Resell([
//
////            'email'    => $row['email'],
////            'password' => Hash::make($row['password']),
//        ]);
    }
}

//class ResellImport implements ToModel
//{
//    use Importable;
//
//    public function model(array $row)
//
//    {
//
//        return new Resell([
//            'id'     => $row['id'],
////            'email'    => $row['billing_acount_id'],
////            'password' => Hash::make($row['password']),
//        ]);
//    }
//}
