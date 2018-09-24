<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 生成数据集合
        // make() is creating seed data
        // create() is creating and saving seed data (consume more resource)
        $users = factory(User::class,10) -> make();
                        

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');
        $user->name = 'dickens';
        $user->email = 'dickensdjj@gmail.com';
        $user->avatar = 'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200';
        $user->save();
        
        // 将 2 号用户指派为『管理员』
        $user = User::find(2);
        $user->assignRole('Maintainer');
        $user->save();

    }
}
