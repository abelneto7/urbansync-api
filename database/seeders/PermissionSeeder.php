<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Support\PermissionBuilder;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $builders = [
            new PermissionBuilder('Usuários', 'UserController'),

            (new PermissionBuilder('Perfis', 'ProfileController')),

            (new PermissionBuilder('Interdições', 'InterdicaoController'))
                ->addAction('updateCoordinates'),
        ];

        $permissions = array_merge(...array_map(
            fn(PermissionBuilder $builder) => $builder->toArray(),
            $builders
        ));

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                ['module' => $permission['module']]
            );
        }
    }
}
