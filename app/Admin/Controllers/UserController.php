<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hbhz\User;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;

use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
{
    use ModelForm;

    public function userList()
    {
        return Admin::content(function (Content $content) {
            $content->header('header');
            $content->description('description');
            $content->body($this->grid());
        });
    }

    protected function grid()
    {
        return Admin::grid(User::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->username(trans('admin::lang.username'));
            $grid->nick_name();
            $grid->school()->name();
            $grid->column('gender')->display(function ($gender) {
                $gender = $gender == 1 ? '男' : '女';
                return $gender;
            });
            $grid->column('img')->display(function ($img) {
                return "<img src='$img' style='width:80px'>";
            });
            $grid->mobile_no();
            $grid->create_dttm()->sortable();
            $grid->filter(function ($filter) {
                // 设置created_at字段的范围查询
                $filter->disableIdFilter();
                $filter->between('create_dttm', 'Created Time')->datetime();
                $filter->is('gender', 'Gender')->select([1=>'men',2=>'women']);
            });

        });
    }
}
