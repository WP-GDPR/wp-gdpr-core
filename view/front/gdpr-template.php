<?php

if ( ! defined( 'ABSPATH' ) ) {
	return;
}
get_header();


?>
<?php use wp_gdpr\lib\Gdpr_Options_Helper; ?>
<div class="wrapper" id="wp-gdpr">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 m-b-0">
                <h1 class="display-4">
                    <center><?php _e( 'YOUR', 'wp_gdpr' ); ?>
                        <strong><?php _e( 'PRIVACY CENTER', 'wp_gdpr' ); ?></strong>
                    </center>
                </h1>
                <p class="lead m-t-0">
                <center><span
                            style="letter-spacing: 2px; font-size:16px;"><?php _e( 'ALL PERSONAL DATA LINKED TO ', 'wp_gdpr' ); ?>
                        <STRONG><?php echo $controller->email_request; ?><img class="lock"
                                                                              src="<?php echo GDPR_URL . 'assets/images/lock.svg'; ?>"
                                                                              data-toggle="tooltip"
                                                                              data-placement="right"
                                                                              title=""
                                                                              data-original-title="<?php _e( 'This is your personal data page. Only you are able to access this.', 'wp_gdpr' ); ?>"></STRONG></span>
                </center>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Hier begint de tabel -->
                <div id="accordion" role="tablist" aria-multiselectable="true" class="m-b-20">
                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">

                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                               aria-controls="collapseOne" class="waves-effect waves-light"><h5
                                        class="card-title m-0 p-t-10">
                                    <img class="address-card"
                                         src="<?php echo GDPR_URL . 'assets/images/address-card.svg'; ?>"><?php _e( 'Personal Data Entries', 'wp_gdpr' ); ?>
                                </h5>
                            </a> <span class="text-muted m-l-10 p-t-10"
                                       style="float:right;"><?php _e( 'All personal data collected through WordPress comments & other plugins', 'wp_gdpr' ); ?>
                                .</span>
                        </div>

                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne"
                             style="">
                            <div class="">

                                <div class="card-box">
                                    <ul class="nav nav-tabs tabs-bordered">
										<?php
										//Echo header from every input
										$active_pill = true;
										foreach ( apply_filters( 'gdpr_global_models', array() ) as $model ) {
											if ( ! Gdpr_Options_Helper::is_option_off( 'switch_on_comments' ) && is_a( $model, 'wp_gdpr\controller\Controller_Comments' ) ) {
												continue;
											} else {
												echo $model->get_frontend_header( $active_pill );
												$active_pill = false;
											}
										}
										?>
                                    </ul>
                                    <div class="tab-content">
										<?php
										$active_tab = true;
										//Echo header from every input
										foreach ( apply_filters( 'gdpr_global_models', array() ) as $key => $model ) {
											if ( ! Gdpr_Options_Helper::is_option_off( 'switch_on_comments' ) && is_a( $model, 'wp_gdpr\controller\Controller_Comments' ) ) {
												continue;
											} else {
												$model->show_entries( $controller->email_request, $active_tab, 'datatable-buttons' . $key );
												$active_tab = false;
											}
										}
										?>
                                        <!-- end row -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php get_footer(); ?>
