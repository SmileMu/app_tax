<?php
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{

         $user = User::create([
        'name' => 'Rahma',
        'email' => 'rahma@gmail.com',
        'password' => bcrypt('123456'),
        'Status' => 'مفعل',
        ]);


}
}
