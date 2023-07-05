<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create([
            'name' => 'employee.menu',
            'guard_name' => 'web',
            'group_name' => 'employee'
        ]);
        Permission::create([
            'name' => 'employee.all',
            'guard_name' => 'web',
            'group_name' => 'employee'
        ]);
        Permission::create([
            'name' => 'employee.add',
            'guard_name' => 'web',
            'group_name' => 'employee'
        ]);
        Permission::create([
            'name' => 'employee.edit',
            'guard_name' => 'web',
            'group_name' => 'employee'
        ]);
        Permission::create([
            'name' => 'employee.delete',
            'guard_name' => 'web',
            'group_name' => 'employee'
        ]);
        Permission::create([
            'name' => 'customer.menu',
            'guard_name' => 'web',
            'group_name' => 'customer'
        ]);
        Permission::create([
            'name' => 'customer.all',
            'guard_name' => 'web',
            'group_name' => 'customer'
        ]);
        Permission::create([
            'name' => 'customer.add',
            'guard_name' => 'web',
            'group_name' => 'customer'
        ]);
        Permission::create([
            'name' => 'customer.edit',
            'guard_name' => 'web',
            'group_name' => 'customer'
        ]);
        Permission::create([
            'name' => 'customer.delete',
            'guard_name' => 'web',
            'group_name' => 'customer'
        ]);
        Permission::create([
            'name' => 'supplier.menu',
            'guard_name' => 'web',
            'group_name' => 'supplier'
        ]);
        Permission::create([
            'name' => 'supplier.all',
            'guard_name' => 'web',
            'group_name' => 'supplier'
        ]);
        Permission::create([
            'name' => 'supplier.add',
            'guard_name' => 'web',
            'group_name' => 'supplier'
        ]);
        Permission::create([
            'name' => 'supplier.edit',
            'guard_name' => 'web',
            'group_name' => 'supplier'
        ]);
        Permission::create([
            'name' => 'supplier.delete',
            'guard_name' => 'web',
            'group_name' => 'supplier'
        ]);
        Permission::create([
            'name' => 'salary.menu',
            'guard_name' => 'web',
            'group_name' => 'salary'
        ]);
        Permission::create([
            'name' => 'salary.add',
            'guard_name' => 'web',
            'group_name' => 'salary'
        ]);
        Permission::create([
            'name' => 'salary.all',
            'guard_name' => 'web',
            'group_name' => 'salary'
        ]);
        Permission::create([
            'name' => 'salary.pay',
            'guard_name' => 'web',
            'group_name' => 'salary'
        ]);
        Permission::create([
            'name' => 'salary.paid',
            'guard_name' => 'web',
            'group_name' => 'salary'
        ]);
        Permission::create([
            'name' => 'attendence.menu',
            'guard_name' => 'web',
            'group_name' => 'attendence'
        ]);
        Permission::create([
            'name' => 'category.menu',
            'guard_name' => 'web',
            'group_name' => 'category'
        ]);
        Permission::create([
            'name' => 'product.menu',
            'guard_name' => 'web',
            'group_name' => 'product'
        ]);
        Permission::create([
            'name' => 'role&permission.menu',
            'guard_name' => 'web',
            'group_name' => 'roles'
        ]);
        Permission::create([
            'name' => 'expense.menu',
            'guard_name' => 'web',
            'group_name' => 'expense'
        ]);
        Permission::create([
            'name' => 'stock.menu',
            'guard_name' => 'web',
            'group_name' => 'stock.menu'
        ]);
        Permission::create([
            'name' => 'add.advance',
            'guard_name' => 'web',
            'group_name' => 'salary'
        ]);
        Permission::create([
            'name' => 'pos.menu',
            'guard_name' => 'web',
            'group_name' => 'pos'
        ]);
        Permission::create([
            'name' => 'admin.all',
            'guard_name' => 'web',
            'group_name' => 'roles'
        ]);
        Permission::create([
            'name' => 'admin.add',
            'guard_name' => 'web',
            'group_name' => 'roles'
        ]);
        Permission::create([
            'name' => 'product.all',
            'guard_name' => 'web',
            'group_name' => 'product'
        ]);
        Permission::create([
            'name' => 'prodcut.add',
            'guard_name' => 'web',
            'group_name' => 'product'
        ]);
        Permission::create([
            'name' => 'product.import',
            'guard_name' => 'web',
            'group_name' => 'product'
        ]);
        Permission::create([
            'name' => 'order.menu',
            'guard_name' => 'web',
            'group_name' => 'order'
        ]);


        $suAdmin = Role::create(['name' => 'Super Admin']);
        $suAdmin->givePermissionTo(Permission::all());

    }

}
