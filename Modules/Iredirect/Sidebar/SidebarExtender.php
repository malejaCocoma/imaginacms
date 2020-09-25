<?php

namespace Modules\Iredirect\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\User\Contracts\Authentication;

class SidebarExtender implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {

            $group->item(trans('iredirect::common.iredirect'), function (Item $item) {
                $item->icon('fa fa-random');

                $item->item(trans('iredirect::redirect.list'), function (Item $item) {
                    $item->icon('fa fa-repeat');
                    $item->weight(5);
                    $item->append('crud.iredirect.redirect.create');
                    $item->route('crud.iredirect.redirect.index');
                    $item->authorize(
                        $this->auth->hasAccess('iredirect.redirects.index')
                    );
                });

                $item->authorize(
                    $this->auth->hasAccess('iredirect.redirects.index')
                );

            });


        });

        return $menu;
    }
}
