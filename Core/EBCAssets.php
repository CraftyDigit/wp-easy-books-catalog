<?php

namespace Core;

/**
 * EBC class for assets handling
 */
class EBCAssets
{
    /**
     * Add actions to enqueue all assets
     *
     * @return void
     */
    public static function enqueueAllAssets(): void
    {
        add_action('wp_enqueue_scripts', [static::class, 'enqueueFrontendAssets']);
        add_action('admin_enqueue_scripts', [static::class, 'enqueueAdminAssets']);
    }

    /**
     * Enqueue frontend scripts and styles.
     *
     * @return void
     */
    public static function enqueueFrontendAssets(): void
    {
        wp_enqueue_script(
            'ebc-frontend',
            EBCCommonData::PLUGIN_DIR_PATH . '/assets/js/frontend.js',
            ['jquery']
        );
        wp_enqueue_style(
            'ebc-frontend',
            EBCCommonData::PLUGIN_DIR_PATH . '/assets/css/frontend.css'
        );
    }

    /**
     * Enqueue admin scripts and styles.
     *
     * @return void
     */
    public static function enqueueAdminAssets(): void
    {
        wp_enqueue_script(
            'ebc-admin-js',
            EBCCommonData::PLUGIN_DIR_PATH . '/assets/js/admin.js',
            ['jquery']
        );
        wp_enqueue_style(
            'ebc-admin-css',
            EBCCommonData::PLUGIN_DIR_PATH . '/assets/css/admin.css',
        );
    }

}