<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<style>
#svg_form_time {
  height: 15px;
  max-width: 80%;
  margin: 40px auto 20px;
  display: block;
}

#svg_form_time circle,
#svg_form_time rect {
  fill: blue;
}

.button {
  background:#4C5E74;
  justify-content:flex-end;
  margin-left:auto;
  border-radius: 5px;
  padding: 10px 15px;
  display: inline-block;
  margin: 10px;
  font-weight: bold;
  color: white;
  cursor: pointer;
  box-shadow:0px 2px 5px rgb(0,0,0,0.5);
}

.disabled {
  display:none;
}

section {
  transition:transform 0.2s ease-in-out;
}

</style>
<div id="wrapper">
<div class="content">
<div class="row">
<div class="col-md-12">
<div class="panel_s">
<div class="panel-body">
<h4 class="no-margin"> <?php echo _l('Other Services'); ?></h4>
<hr class="hr-panel-heading"/>
<div id="svg_wrap"></div>
<hr class="hr-panel-heading" />
<?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'other_services',)); 
$client_id = $this->input->get('client_id', TRUE);?>  
  
    <section id="other_services_a">
        <h4 class="text-center"><?php echo _l('Owners_information') ?> </h4> <br/>
       <div class="row">
       <div class="col-md-12">
        <?php 
        if(is_null($customer_id)){
          $selected = isset($val) ? $val->client_id : '';
          echo render_select('client_id', $custumer, ['userid', 'company'], _l('Select Company *'), $selected);
        }
        if($customer_id){
          echo form_hidden('client_id',$client_id);
        }   
        $value = isset($val) ? $val->o_name : '';
        echo render_input('o_name', 'Owner/Manager name *', $value, '', ['placeholder' => 'Owner/Manager name']); 
             
       ?>
        
        </div>
       </div>
        <div class="row">
        <div class="col-sm-6">
        <?php  $value = isset($val) ? $val->o_email : '';
        echo render_input('o_email', 'Email*', $value, 'email', ['placeholder' => 'Email']); ?>
        </div>
        <div class="col-sm-6">
        <?php  $value = isset($val) ? $val->o_contact : '';
        echo render_input('o_contact', 'Phone *', $value, '', ['placeholder' => 'Phone']);?>
        </div>
        </div>
    </section>

    <section id="other_services_b">
        <h4 class="text-center">Property Information</h4> <br/>
        <div class="row">
            <div class="col-sm-12">
                <?php $value = isset($val) ? $val->p_property_name : '';
                 echo render_input('p_property_name', 'Property Name (optional)', $value, '', ['placeholder' => '']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php $value = isset($val) ? $val->p_address_one : '';
                echo render_input('p_address_one', 'Physical Address Line 1: *', $value, '', ['placeholder' => '']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php  $value = isset($val) ? $val->p_address_two : '';
                 echo render_input('p_address_two', 'Physical Address Line 2 (optional)', $value, '', ['placeholder' => '']); ?>
            </div>
        </div>
        <div class="row">
        <div class="col-sm-4">
         <?php  $value = isset($val) ? $val->P_city : '';
          echo render_input('P_city', 'City *', $value, '', ['placeholder' => 'City*']);?>
        </div>
        <div class="col-sm-4">
         <?php  $value = isset($val) ? $val->P_state : '';
          echo render_input('P_state', 'State *', $value, '', ['placeholder' => 'State*']); ?>
        </div>
        <div class="col-sm-4">
         <?php  $value = isset($val) ? $val->P_zip : '';
          echo render_input('P_zip', 'Zip Code *', $value, '', ['placeholder' => 'Zip Code']); ?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <?php 
         $countries= get_all_countries();
         $customer_default_country = get_option('customer_default_country');
         $selected = isset($val) ? $val->P_country : '';
         echo render_select( 'P_country',$countries,array( 'country_id',array( 'short_name')), 'shipping_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex'), $selected));  ?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <?php  $value = isset($val) ? $val->o_name : '';
        echo render_textarea('P_special_instruction',  'Special Instructions for process server (ex. gate code, call number, etc) *', $value, ['placeholder' => ''], [],  '', '');  ?>
        </div>
        </div>
        <div class="row"> 
      <div class="col-md-12">
      Eviction Fees <br/>
      <?php 
      $value = isset($val) ? $val->eviction_fees : '';
      $eviction = explode(",", $value);
      for ($i=1; $i <= 4; $i++) { 
          $month = $i == 1 ? " Drive by Pictures ($150) <br/>" : ($i==2 ? " Pickup keys ($150) <br/>" : ($i==3 ? "Mailing Documents to owner ($10) <br/>" : ($i==4 ? "Posting notice ($100) <br/>" : "")));
          $checked = in_array($i, $eviction) ? 'checked' : '';
          echo '<input type="checkbox" name="eviction_fees[]"  value="'.$i.'" '.$checked.'>&nbsp; '.$month.'  </input>';
      }  
      ?>
      </div>
      </div><br/>
      <div class="row">
            <div class="col-sm-12">
                <?php  $value = isset($val) ? $val->p_declear : ''; 
                echo render_input('p_declear', 'Name: I do solemnly declare and affirm under the penalty of perjury that the matters and facts set forth above are true to the best of my knowledge and belief: *', $value, '', ['placeholder' => '']); ?>

            </div>
        </div>
       
    </section>
    <div class="button" id="prev">&larr; Previous</div>
    <div class="button" id="next">Next &rarr;</div>
    <button class="button" type="submit" id="submit">Agree and send application</button>
    <?php echo form_close(); ?>
<!-- </form> -->
</div>
</div>
</div>
</div>
</div>
</div>
<?php init_tail(); ?>
<script>
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$("#next").click(function(){
  $("#other_services").validate({
    rules: {
      
          o_name: "required",
          o_contact: "required",
          o_email: "required",
          p_declear: "required",
          eviction_fees: "required",
          P_special_instruction: "required",
          P_country: "required",
          P_zip: "required",
          P_city: "required",
          p_address_one: "required",
          client_id: "required",
         
    },
  });
});

$( document ).ready(function() {
  var base_color = "rgb(230,230,230)";
  var active_color = "#4C5E74";
  var child = 1;
  var length = $("section").length - 1;
  $("#prev").addClass("disabled");
  $("#submit").addClass("disabled");
  
  $("section").not("section:nth-of-type(1)").hide();
  $("section").not("section:nth-of-type(1)").css('transform','translateX(100px)');
  
  var svgWidth = length * 200 + 24;
  $("#svg_wrap").html(
    '<svg version="1.1" id="svg_form_time" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 ' +
      svgWidth +
      ' 24" xml:space="preserve"></svg>'
    );
    
    function makeSVG(tag, attrs) {
      var el = document.createElementNS("http://www.w3.org/2000/svg", tag);
      for (var k in attrs) el.setAttribute(k, attrs[k]);
      return el;
    }
    
    for (i = 0; i < length; i++) {
      var positionX = 12 + i * 200;
      var rect = makeSVG("rect", { x: positionX, y: 9, width: 200, height: 6 });
      document.getElementById("svg_form_time").appendChild(rect);
      // <g><rect x="12" y="9" width="200" height="6"></rect></g>'
      var circle = makeSVG("circle", {
        cx: positionX,
        cy: 12,
        r: 12,
        width: positionX,
        height: 6
      });
      document.getElementById("svg_form_time").appendChild(circle);
    }
    
    var circle = makeSVG("circle", {
      cx: positionX + 200,
      cy: 12,
      r: 12,
      width: positionX,
      height: 6
    });
    document.getElementById("svg_form_time").appendChild(circle);
    
    $('#svg_form_time rect').css('fill',base_color);
    $('#svg_form_time circle').css('fill',base_color);
    $("circle:nth-of-type(1)").css("fill", active_color);
    
    
    $(".button").click(function () {
      $("#svg_form_time rect").css("fill", active_color);
      $("#svg_form_time circle").css("fill", active_color);
      var id = $(this).attr("id");
      if (id == "next") {
        if($("#other_services").valid()){
          $("#prev").removeClass("disabled");
          if (child >= length) {
            $(this).addClass("disabled");
            $('#submit').removeClass("disabled");
            $(function() {
        $('body').on('click', 'button #submit', function() {
            $('form#other_services').submit();
        });
    });
                }
                if (child <= length) {
                  child++;
                }
              }
            } else if (id == "prev") {
              $("#next").removeClass("disabled");
              $('#submit').addClass("disabled");
              if (child <= 2) {
                $(this).addClass("disabled");
              }
              if (child > 1) {
                child--;
              }
            }
            var circle_child = child + 1;
            $("#svg_form_time rect:nth-of-type(n + " + child + ")").css(
              "fill",
              base_color
            );
            $("#svg_form_time circle:nth-of-type(n + " + circle_child + ")").css(
              "fill",
              base_color
            );
            var currentSection = $("section:nth-of-type(" + child + ")");
            currentSection.fadeIn();
            currentSection.css('transform','translateX(0)');
            currentSection.prevAll('section').css('transform','translateX(-100px)');
            currentSection.nextAll('section').css('transform','translateX(100px)');
            $('section').not(currentSection).hide();
          });
          
        });
        </script>
        
        </body>
        </html>
        