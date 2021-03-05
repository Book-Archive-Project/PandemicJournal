<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<style>
    .input-field label {
        display: block;
        font-weight: 700;
        padding-bottom: 5px;
    }
    .key-table {
        padding: 30px 0 0;
    }
    input.license-key {
        width: 100%;
        max-width: 250px;
    }
    .submit {
        text-align: left;
        max-width: 100%;
        margin-top: 0px;
        padding-top: 10px;
    }
    .folder-error-message, .folder-success-message {
        background: #fff;
        margin: 10px 0 10px 0;
        padding: 10px 10px 10px 10px;
        border-left: solid 3px #dd4b39;
    }
    .folder-success-message {
        border-left: solid 3px #00a65a;
    }
    .license-key-footer {
        font-weight: bold;
        padding-bottom: 15px;
        font-size: 16px;
        line-height: 30px;
    }
    span.error-message {
        display: inline-block;
        margin-right: 10px;
    }
    <?php if ( function_exists( 'is_rtl' ) && is_rtl() ) { ?>
    .submit {
        text-align: right;
    }
    <?php } ?>
</style>
<div class="wrap">
    <h1><?php esc_attr_e( 'Folders: License Key', WCP_FOLDER ); ?></h1>
    <?php
    $type = filter_input(INPUT_GET, 'm', FILTER_SANITIZE_STRING);
    if(isset($type) && !empty($type)) {
        switch ($type) {
            case "error": ?>
                <div class='folder-error-message'><?php esc_attr_e("Your license key is not valid",WCP_FOLDER ) ?></div>
                <?php break;
            case "valid": ?>
                <div class='folder-success-message'><?php esc_attr_e("Your license key is activated successfully",WCP_FOLDER ) ?></div>
                <?php break;
            case "unactivated": ?>
                <div class='folder-success-message'><?php esc_attr_e("Your license key is deactivated successfully",WCP_FOLDER ) ?></div>
                <?php break;
            case "expired": ?>
                <div class='folder-error-message'><?php esc_attr_e("Your license has been expired",WCP_FOLDER ) ?></div>
                <?php break;
            case "no_activations": ?>
                <div class='folder-error-message'><?php esc_attr_e("Your license was activated for another domain, please visit your ",WCP_FOLDER ) ?><a target="_blank" href="https://go.premio.io"><?php esc_attr_e("Premio account",WCP_FOLDER ) ?></a></div>
                <?php break;
        }
    }
    ?>
    <div class="key-table">
        <div class="license-key-footer">
            <?php
            $licenseKey = get_option("wcp_folder_license_key");
            $licenseData = array();
            $active_status = 0;
            delete_transient("folder_license_key_data");
            if(!empty($licenseKey)) {
                $licenseData = $this->get_license_key_data($licenseKey);
                if(!empty($licenseData)) {
                    if($licenseData['license'] == "valid") {
                        $active_status = 1;
                    } else if($licenseData['license'] == "expired") {
                        $active_status = 2;
                    }
                } else {
                    $licenseKey = "";
                }
            }
            if(!$active_status) {
                esc_attr_e("To receive updates, please enter your valid license key.", WCP_FOLDER );
            } else if ($active_status == 1 && $licenseData['expires'] == "lifetime") {
                esc_attr_e("You have a lifetime license", WCP_FOLDER);
            } else if($active_status == 1 ){
                esc_attr_e("Your license will expire on ".date("d M, Y",strtotime($licenseData['expires'])));
            } else if($active_status == 2 ){
                $url = WCP_PRO_FOLDER_API_URL.'/checkout/?edd_license_key='.$licenseKey."&download_id=".WCP_PRO_FOLDER_PR0DUCT_ID; ?>
                <span class='error-message'><?php esc_attr_e("Your license has been expired on ", WCP_FOLDER).esc_attr(date("d M, Y",strtotime($licenseData['expires']))) ?></span><a target="_blank" href="<?php echo esc_url($url) ?>" class="button button-primary" ><?php esc_attr_e("Renew Now", WCP_FOLDER ) ?></a> <?php
            }
            ?>
        </div>
        <form action="" id="license_key_form">
            <div class="input-field">
                <label for="license_key"><?php esc_attr_e("License Key", WCP_FOLDER ) ?></label>
                <input class="license-key" id="license_key" name="license_key" value="<?php echo esc_attr($licenseKey) ?>">
            </div>
            <div class="submit">
                <?php if($active_status != 0) { ?>
                    <a href="javascript:;" class="button secondary-button" id="deactivate_key"><?php esc_attr_e("Deactivate Key", WCP_FOLDER ) ?></a>
                <?php } ?>
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e("Activate Key", WCP_FOLDER ) ?>">
            </div>
        </form>
    </div>
</div>
<script>
    jQuery(document).ready(function(){
       jQuery("#license_key_form").submit(function(){
           licenseKey = jQuery.trim(jQuery("#license_key").val());
           jQuery.ajax({
               url:"<?php echo esc_url(admin_url("admin-ajax.php")) ?>",
               data: "key="+licenseKey+"&action=wcp_folder_activate_key&nonce=<?php echo wp_create_nonce("activate_folder_key") ?>",
               method: 'post',
               success: function(res){
                   window.location = '<?php echo esc_url(admin_url("admin.php")) ?>?page=wcp_folders_register&m='+res;
               }
           });
           return false;
       });
        jQuery("#deactivate_key").click(function(){
            licenseKey = jQuery.trim(jQuery("#license_key").val());
            jQuery.ajax({
                url:"<?php echo esc_url(admin_url("admin-ajax.php")) ?>",
                data: "key="+licenseKey+"&action=wcp_folder_deactivate_key&nonce=<?php echo wp_create_nonce("deactivate_folder_key") ?>",
                method: 'post',
                success: function(res){
                    window.location = '<?php echo esc_url(admin_url("admin.php")) ?>?page=wcp_folders_register&m='+res;
                }
            });
            return false;
        });
    });
</script>