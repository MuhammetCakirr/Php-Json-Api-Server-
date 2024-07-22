<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionOperation extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // /*Roles*/
        // $librarianrole = Role::create(['name' => 'librarian']);
        // $userrole = Role::create(['name' => 'user']);
        // $managerrole = Role::create(['name' => 'manager']);
        // $analystrole = Role::create(['name' => 'analyst']);

        // /*Permissions*/
        // $seeallpermission = Permission::create(["name" => "show all"]);
        // $showdetailpermission = Permission::create(["name" => "show detail"]);
        // $showrecord = Permission::create(["name" => "show record"]);
        // $bookusermanagement = Permission::create(["name" => "userbook management"]);
        // $bookoperations = Permission::create(["name" => "book management"]);
        // $authoroperations = Permission::create(["name" => "author management"]);
        // $genreoperations = Permission::create(["name" => "genre management"]);
        // $statusoperations = Permission::create(["name" => "status management"]);
        // $rolepermissionmanagement = Permission::create(["name" => "rolepermission management"]);

        // /*Role-Permission Connection*/

        // /*Manager*/
        // $managerrole->givePermissionTo($seeallpermission);
        // $managerrole->givePermissionTo($showdetailpermission);
        // $managerrole->givePermissionTo($showrecord);
        // $managerrole->givePermissionTo($bookusermanagement);
        // $managerrole->givePermissionTo($bookoperations);
        // $managerrole->givePermissionTo($authoroperations);
        // $managerrole->givePermissionTo($genreoperations);
        // $managerrole->givePermissionTo($statusoperations);
        // $managerrole->givePermissionTo($rolepermissionmanagement);

        // $seeallpermission->assignRole($managerrole);
        // $showdetailpermission->assignRole($managerrole);
        // $showrecord->assignRole($managerrole);
        // $bookusermanagement->assignRole($managerrole);
        // $bookoperations->assignRole($managerrole);
        // $authoroperations->assignRole($managerrole);
        // $genreoperations->assignRole($managerrole);
        // $statusoperations->assignRole($managerrole);
        // $rolepermissionmanagement->assignRole($managerrole);

        // /*Librarian*/
        // $librarianrole->givePermissionTo($seeallpermission);
        // $librarianrole->givePermissionTo($showdetailpermission);
        // $librarianrole->givePermissionTo($bookusermanagement);
        // $librarianrole->givePermissionTo($bookoperations);
        // $librarianrole->givePermissionTo($authoroperations);
        // $librarianrole->givePermissionTo($genreoperations);
        // $librarianrole->givePermissionTo($statusoperations);

        // $seeallpermission->assignRole($librarianrole);
        // $showdetailpermission->assignRole($librarianrole);
        // $bookusermanagement->assignRole($librarianrole);
        // $bookoperations->assignRole($librarianrole);
        // $authoroperations->assignRole($librarianrole);
        // $genreoperations->assignRole($librarianrole);
        // $statusoperations->assignRole($librarianrole);

        // /*Analyst*/
        // $analystrole->givePermissionTo($showrecord);

        // $showrecord->assignRole($analystrole);

        /*User-Role Connection*/
        $mamicakir = User::find(5);
        $mamicakir->assignRole('manager');
        $mamicakir->assignRole('user');

        $selmanyanki = User::find(7);
        $selmanyanki->assignRole('librarian');
        $selmanyanki->assignRole('user');

        $ruyahamyapar = User::find(9);
        $ruyahamyapar->assignRole('librarian');
        $ruyahamyapar->assignRole('user');

        $anilbozar = User::find(8);
        $anilbozar->assignRole('analyst');
        $anilbozar->assignRole('user');

        $kadirbonbon = User::find(10);
        $kadirbonbon->assignRole('user');
        $sevgikumar = User::find(11);
        $sevgikumar->assignRole('user');
        $kurbanbayram = User::find(12);
        $kurbanbayram->assignRole('user');

        $ramazanbayram = User::find(13);
        $ramazanbayram->assignRole('user');

    }
}
