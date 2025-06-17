<?php
namespace Bojosxtu\BojosTube;

use Elgg\DefaultPluginBootstrap;
use Elgg\Menu\MenuItems;

class Bootstrap extends DefaultPluginBootstrap {
    public function init() {
        $this->registerHooks();
        $this->registerEntities();
        $this->registerMenuItems();
    }
    
    protected function registerHooks() {
        elgg_register_plugin_hook_handler('register', 'menu:owner_block', [$this, 'addChannelToOwnerBlock']);
    }
    
    protected function registerEntities() {
        // Se registran automáticamente en elgg-plugin.php
    }
    
    protected function registerMenuItems() {
        elgg_register_menu_item('site', [
            'name' => 'bojostube',
            'text' => elgg_echo('bojostube'),
            'href' => elgg_generate_url('collection:object:bojostube_video:all'),
            'icon' => 'video-camera'
        ]);
    }
    
    public function addChannelToOwnerBlock($hook, $type, $items, $params) {
        $user = $params['entity'];
        if ($user instanceof \ElggUser) {
            $items[] = \ElggMenuItem::factory([
                'name' => 'bojostube_channel',
                'text' => elgg_echo('bojostube:channel'),
                'href' => elgg_generate_url('view:object:bojostube_channel', [
                    'username' => $user->username
                ])
            ]);
        }
        return $items;
    }
}