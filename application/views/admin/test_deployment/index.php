<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h1 class="tw-text-4xl tw-font-bold tw-text-center tw-mb-8">
                            🚀 Test Deployment Page
                        </h1>
                        <div class="alert alert-success tw-text-center">
                            <h3>✅ Auto-Deployment is Working!</h3>
                            <p class="tw-text-lg">If you can see this page, it means changes from the Git repository are successfully deploying to the live site.</p>
                            <hr>
                            <p><strong>Deployment Test Time:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>

