<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
  .cd-breadcrumb.nav-tabs > li.active > a, .cd-breadcrumb.nav-tabs > li.active > a:hover, .cd-breadcrumb.nav-tabs > li.active > a:focus {
     color: #fff;
     background-color: rgb(3,169,244);
     border: 0px solid rgb(3,169,244);
     cursor: default;
 }
  .cd-breadcrumb.nav-tabs > li > a {
     margin-right: inherit;
     line-height: inherit;
     height: 38px;
     border: inherit;
     border-radius: inherit;
     border-color: #edeff0;
 }
  .cd-breadcrumb li {
     display: inline-block;
     float: left;
     margin: 0.2em 0;
 }
  .cd-breadcrumb li::after {
    /* this is the separator between items */
     display: inline-block;
     content: '\00bb';
     margin: 0 0.6em;
     color: tint(rgb(3,169,244), 50%);
 }
  .cd-breadcrumb li:last-of-type::after {
    /* hide separator after the last item */
     display: none;
 }
  .cd-breadcrumb li > * {
    /* single step */
     display: inline-block;
     font-size: 1.4rem;
     color: rgb(3,169,244);
 }
  .cd-breadcrumb li.current > * {
    /* selected step */
     color: rgb(3,169,244);
 }
  .cd-breadcrumb a:hover {
    /* steps already visited */
     color: rgb(3,169,244);
 }
  .cd-breadcrumb.custom-separator li::after {
    /* replace the default arrow separator with a custom icon */
     content: '';
     height: 12px;
     width: 16px;
     vertical-align: middle;
 }
 
  .cd-breadcrumb.triangle li > * {
     position: relative;
     padding: 0.8em 0.8em 0.7em 2.5em;
     color: #333;
     background-color: #edeff0;
    /* the border color is used to style its ::after pseudo-element */
     border-color: #edeff0;
 }
  .cd-breadcrumb.triangle li.active > * {
    /* selected step */
     color: #fff;
     background-color: rgb(3,169,244);
     border-color: rgb(3,169,244);
 }
  .cd-breadcrumb.triangle li:first-of-type > * {
     padding-left: 1.6em;
     border-radius: 4px 0 0 4px;
 }
  .cd-breadcrumb.triangle li:last-of-type > * {
     padding-right: 1.6em;
     border-radius: 0 0.25em 0.25em 0;
 }
  .cd-breadcrumb.triangle a:hover {
    /* steps already visited */
     color: #fff;
     background-color: rgb(3,169,244);
     border-color: rgb(3,169,244);
     text-decoration: none;
 }
  .cd-breadcrumb.triangle li::after, .cd-breadcrumb.triangle li > *::after {
    /* li > *::after is the colored triangle after each item li::after is the white separator between two items */
     content: '';
     position: absolute;
     top: 0;
     left: 100%;
     content: '';
     height: 0;
     width: 0;
    /* 48px is the height of the  element */
     border: 24px solid transparent;
     border-right-width: 0;
     border-left-width: 20px;
 }
  .cd-breadcrumb.triangle li::after {
    /* this is the white separator between two items */
     z-index: 1;
     -webkit-transform: translate(4px, 0);
     -ms-transform: translate(4px, 0);
     -o-transform: translate(4px, 0);
     transform: translate(4px, 0);
     border-left-color: #fff;
    /* reset style */
     margin: 0;
 }
  .cd-breadcrumb.triangle li > *::after {
    /* this is the colored triangle after each element */
     z-index: 2;
     border-left-color: inherit;
 }
  .cd-breadcrumb.triangle li:last-of-type::after, .cd-breadcrumb.triangle li:last-of-type > *::after {
    /* hide the triangle after the last step */
     display: none;
 }
  
  
</style>
<h4 class="customer-profile-group-heading"><?php echo _l('Orders'); ?></h4>
<?php if(isset($client)){ ?>
<div class="row">
   <?php
      $_where = '';
      if(!has_permission('projects','','view')){
        $_where = 'id IN (SELECT project_id FROM '.db_prefix().'project_members WHERE staff_id='.get_staff_user_id().')';
      }
      ?>
</div>
<ul class="cd-breadcrumb triangle nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#Ideate" aria-controls="ideate" role="tab" data-toggle="tab" aria-expanded="true">
                <span class="octicon octicon-light-bulb"></span>Eviction Orders
            </a>
        </li>
        <li role="presentation" class="">
            <a href="#GetValidated" aria-controls="get-validated" role="tab" data-toggle="tab" aria-expanded="false">
                <span class="octicon octicon-verified"></span>Physical Orders
            </a>
        </li>
        <li role="presentation" class="">
            <a href="#Work" aria-controls="work" role="tab" data-toggle="tab" aria-expanded="false">
                <span class="octicon octicon-tools"></span>Other Services Order
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="Ideate">
        <a href="<?php echo admin_url('order/new_order?client_id='.$client->userid); ?>" class="btn btn-info pull-right mbot25<?php if($client->active == 0){echo ' disabled';} ?>"><?php echo _l('New Orders'); ?></a>
           <?php  $this->load->view('admin/orders/table', array('class'=>'order-single-client')); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="GetValidated">
        <a href="<?php echo admin_url('order/new_physical_order?client_id='.$client->userid); ?>" class="btn btn-info pull-right mbot25<?php if($client->active == 0){echo ' disabled';} ?>"><?php echo _l('New Orders'); ?></a>
        <?php  $this->load->view('admin/orders/physical_table', array('class'=>'order-physical-single-client')); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="Work">
        <a href="<?php echo admin_url('order/new_other_order?client_id='.$client->userid); ?>" class="btn btn-info pull-right mbot25<?php if($client->active == 0){echo ' disabled';} ?>"><?php echo _l('New Orders'); ?></a>
        <?php  $this->load->view('admin/orders/other_table', array('class'=>'order-other-single-client')); ?>
        </div>
    </div>

<?php
  
}
?>
