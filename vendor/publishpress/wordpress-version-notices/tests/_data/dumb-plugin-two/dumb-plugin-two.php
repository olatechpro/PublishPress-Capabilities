<?php
/**
 * Plugin Name: Dumb Plugin Two
 * Plugin URI: https://publishpress.com/
 * Description: Dumb plugin for testing the library
 * Author: PublishPress
 * Author URI: https://publishpress.com
 * Version: 0.1.0
 *
 * Copyright (c) 2020 PublishPress
 *
 * GNU General Public License, Free Software Foundation <http://creativecommons.org/licenses/GPL/2.0/>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     PublishPress
 * @category    Core
 * @author      PublishPress
 * @copyright   Copyright (C) 2020 PublishPress. All rights reserved.
 */

if (!defined('DUMB_PLUGIN_TWO_LOADED')) {
    // @todo: Load only in the admin
    if (!defined('PP_VERSION_NOTICES_LOADED')) {
        require_once __DIR__ . '/vendor/publishpress/wordpress-version-notices/includes.php';
    }

    add_filter(\PPVersionNotices\Module\TopNotice\Module::SETTINGS_FILTER, function ($settings) {
        $settings['dumb-plugin-two'] = [
            'message' => 'You\'re using Dumb Plugin Two Free. Please, %supgrade to pro%s.',
            'link'    => 'http://example.com/upgrade',
            'screens' => [
                [
                    'base'      => 'edit',
                    'id'        => 'edit-page',
                    'post_type' => 'page',
                ],
            ],
        ];

        return $settings;
    });

    add_filter(\PPVersionNotices\Module\MenuLink\Module::SETTINGS_FILTER, function ($settings) {
        // Using multiple parent pages, in case the plugin has different menus based on the enabled/disabled modules.
        $settings['dumb-plugin-two'] = [
            'parent' => [
                'dummy-plugin-two-page-1',
                'dummy-plugin-two-page-2',
                'dummy-plugin-two-page-3',
            ],
            'label'  => 'Upgrade to Pro',
            'link'   => 'http://example.com/upgrade/two',
        ];

        return $settings;
    });

    // Add a menu item for testing
    add_action('admin_menu', function() {
        add_menu_page(
            'Dummy plugin Two',
            'Dummy Plugin Two',
            'read',
            'dummy-plugin-two-page-2',
            function() {
                return __return_empty_string();
            }
        );

        add_submenu_page(
            'dummy-plugin-two-page-2',
            'Dummy Plugin Two Sub 1',
            'Dummy Plugin Two Sub 1',
            'read',
            'dummy-plugin-two-sub-1',
            function() {
                return __return_empty_string();
            }
        );

        add_submenu_page(
            'dummy-plugin-two-page-2',
            'Dummy Plugin Two Sub 2',
            'Dummy Plugin Two Sub 2',
            'read',
            'dummy-plugin-two-sub-2',
            function() {
                return __return_empty_string();
            }
        );
    });

    define('DUMB_PLUGIN_TWO_LOADED', true);
}
