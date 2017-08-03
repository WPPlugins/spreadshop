<?php
function spreadShop_options(){
    wp_enqueue_style('spreadShopOptionsStyle', plugins_url('style/style.css', __FILE__));
    wp_enqueue_script('spreadShopOptionsScript', plugins_url('js/spreadshop_admin.js', __FILE__));
    ?>
    <div class="spreadShopAdminWrapper">
        <div class="settingsContainer">
            <div class="left">
                <div class="pluginHeadline"><h1>SpreadShop Settings</h1>
                </div>
            </div>
            <div class="right">
                <?php if (get_option('spreadshopInitialized') == false) {?>
                    <h1>Shop activation </h1>
                    <span>Welcome to the SpreadShop Wordpress plugin - the simplest plugin ever to integrate the Spreadshirt shop system into Wordpress. </span>
                    <form method="post" action="options.php">
                        <?php settings_fields( 'spreadshop-settings-group' ); ?>
                        <?php do_settings_sections( 'spreadshop-settings-group' ); ?>
                        <table class="shopSettingsContainer">
                            <tr>
                                <th scope="row">ShopID</th>
                                <td><input type="text" name="spreadshopID" value="<?php echo esc_attr( get_option('spreadshopID') ); ?>" /></td>
                            </tr>
                            <tr>
                                <th scope="row">Platform</th>
                                <td><select id="platform" name="spreadshopPlatform" value="<?php echo esc_attr( get_option('spreadshopPlatform') ); ?>"/><option>EU</option><option>NA</option></select> </td>
                            </tr>
                            <tr>
                                <th scope="row">Shop URL</th>
                                <td><?php echo get_site_url().'/'.get_option('spreadshopSlug');?><input type="text" id="slug" name="spreadshopSlug" value="t-shirt-shop"/> </td>
                            </tr>
                            <tr>
                                <td><input type="hidden" name="spreadshopOffsetTop" value="0" /></td>
                            </tr>


                            <input type="hidden" name="spreadshopInitialized" value="1">
                        </table>
                        <?php submit_button(); ?>
                    </form>
                    <h3>No shop yet</h3>
                    <span><a href="https://www.spreadshirt.com/start-selling-shirts-C3598">Register now!</a></span>

                <?php } else{?>
                    <h1>Your SpreadShop is ready!</h1>
                    <span>To style your shop, create and/or change products, please go to your Spreadshirt account.</span><br>
                    <div class="editable">
                        <table class="shopSettingsContainer editable">
                            <tr>
                                <th scope="row">ShopID</th>
                                <td><span> <?php echo esc_attr( get_option('spreadshopID') ); ?></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Platform</th>
                                <td><span><?php echo esc_attr( get_option('spreadshopPlatform') ); ?></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Shop URL</th>
                                <td><span><?php echo get_site_url().'/'.get_option('spreadshopSlug');?></td>
                            </tr>
                        </table>
                        <span class="btn-edit dashicons dashicons-edit" id="spreadShopChangeSettings"></span>
                    </div>
                    <a class="btn-primary" href="<?php echo(get_site_url().'/'.get_option('spreadshopSlug'));?>" target="_blank">Visit Shop</a>

                    <a class="btn-primary" href="https://partner.spreadshirt.<?php echo(get_option( 'spreadshopTLD' )); ?>" target="_blank">Create Products at Spreadshirt</a>
                    <div class="notice notice-warning is-dismissible">
                        <p><strong>Please go to your Spreadshirt account and enter <?php echo(get_site_url().'/'.get_option('spreadshopSlug'));?> in Shop Settings -> Advanced Settings -> Integrate shop in website -> Connect your Shop and Website to make this plugin work. </strong></p>
                        <button type="button" class="notice-dismiss">
                            <span class="screen-reader-text">Dismiss this notice.</span>
                        </button>
                    </div>
                    <div  class="spreadShopSettingChange" id="spreadShopSettingsEdit">
                        <form method="post" action="options.php">
                            <?php settings_fields( 'spreadshop-settings-group' ); ?>
                            <?php do_settings_sections( 'spreadshop-settings-group' ); ?>
                            <table class="">
                                <tr>
                                    <th scope="row">ShopID</th>
                                    <td><input type="text" name="spreadshopID" value="<?php echo esc_attr( get_option('spreadshopID') ); ?>" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Platform</th>
                                    <td><select id="platform" name="spreadshopPlatform" value="<?php echo esc_attr( get_option('spreadshopPlatform') ); ?>"/><option>EU</option><option>NA</option></select> </td>
                                </tr>
                                <tr>
                                    <th scope="row">Shop URL</th>
                                    <td><?php echo get_site_url().'/'.get_option('spreadshopSlug');?><input type="text" id="slug" name="spreadshopSlug" value="<?php echo get_option('spreadshopSlug');?>"/> </td>
                                </tr>
                                <tr>
                                    <th scope="row">Offset Top</th>
                                    <td><input type="numbr" name="spreadshopOffsetTop" value="<?php echo get_option('spreadshopOffsetTop')?>" /></td>
                                </tr>


                                <input type="hidden" name="spreadshopInitialized" value="1">
                            </table>

                            <?php submit_button(); ?>
                        </form>
                    </div>
                <?php };?>
            </div>
        </div>
    </div>
<?php };