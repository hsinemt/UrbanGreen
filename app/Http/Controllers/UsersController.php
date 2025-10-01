<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Kathryn Murphy',
                'email' => 'osgoodwy@gmail.com',
                'department' => 'HR',
                'designation' => 'Manager',
                'join_date' => '25 Jan 2024',
                'status' => 'active',
                'avatar' => 'user-list1.png'
            ],
            [
                'id' => 2,
                'name' => 'Annette Black',
                'email' => 'redaniel@gmail.com',
                'department' => 'Design',
                'designation' => 'UI UX Designer',
                'join_date' => '25 Jan 2024',
                'status' => 'inactive',
                'avatar' => 'user-list2.png'
            ],
            [
                'id' => 3,
                'name' => 'Ronald Richards',
                'email' => 'seannand@mail.ru',
                'department' => 'Design',
                'designation' => 'UI UX Designer',
                'join_date' => '10 Feb 2024',
                'status' => 'active',
                'avatar' => 'user-list3.png'
            ],
            [
                'id' => 4,
                'name' => 'Eleanor Pena',
                'email' => 'miyokoto@mail.ru',
                'department' => 'Design',
                'designation' => 'UI UX Designer',
                'join_date' => '10 Feb 2024',
                'status' => 'active',
                'avatar' => 'user-list4.png'
            ],
            [
                'id' => 5,
                'name' => 'Leslie Alexander',
                'email' => 'icadahli@gmail.com',
                'department' => 'Design',
                'designation' => 'UI UX Designer',
                'join_date' => '15 March 2024',
                'status' => 'inactive',
                'avatar' => 'user-list5.png'
            ],
        ];

        return view('dashboard.components.users.user', compact('users'));
    }
}
