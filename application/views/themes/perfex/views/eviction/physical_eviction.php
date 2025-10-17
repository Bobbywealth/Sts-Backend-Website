<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
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
<h4 class="no-margin"> <?php echo _l('Physical Eviction Order Page'); ?>  <a href="<?php echo base_url('clients/physical_import'); ?>" class="btn btn-info pull-right display-block hidden-xs"><?php echo _l('Import Orders'); ?></a></h4>
<hr class="hr-panel-heading"/>
<div id="svg_wrap"></div>
<hr class="hr-panel-heading" />
<?php echo form_open_multipart($this->uri->uri_string(''), array('id' => 'physical_eviction',)); ?>  
  
    <section id="physical_eviction_a">
        <h4 class="text-center"><?php echo _l('Owners_information') ?> </h4> <br/>
       <div class="row">
       <div class="col-md-12">
        <?php echo render_input('o_name', 'Owner/Manager name *', '', '', ['placeholder' => 'Owner/Manager name']);
        echo form_hidden('client_id',$client_id); 
        ?>
        </div>
       </div>
        <div class="row">
        <div class="col-sm-6">
        <?php echo render_input('o_email', 'Email*', '', 'email', ['placeholder' => 'Email']); ?>
        </div>
        <div class="col-sm-6">
        <?php echo render_input('o_contact', 'Phone *', '', '', ['placeholder' => 'Phone']);?>
        </div>
        </div>
    </section>

    <section id="physical_eviction_b">
        <h4 class="text-center">Eviction Information</h4> <br/>
        <div class="row">
            <div class="col-sm-12">
                <?php  echo render_input('e_case_number', 'Case Number', '', '', ['placeholder' => 'Case Number']); ?>
            </div>
        </div>
        <div class="row">
        <div class="col-md-6">
        <?php  echo render_input('e_date', 'Date of the eviction', '', 'date', ['placeholder' => 'Date of the eviction']);?>
        </div>
        <div class="col-md-6">
        <?php echo render_input('e_time', 'Time of the eviction', '', 'time', ['placeholder' => 'Time of the eviction']); ?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <?php echo render_input('e_street_address', 'Street Address of the Eviction *', '', '', ['placeholder' => 'Street Address of the Eviction']); ?>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-4">
         <?php echo render_input('e_city', 'City *', '', '', ['placeholder' => 'City*']);?>
        </div>
        <div class="col-sm-4">
         <?php echo render_input('e_state', 'State *', '', '', ['placeholder' => 'State*']); ?>
        </div>
        <div class="col-sm-4">
         <?php  echo render_input('e_zip', 'Zip Code *', '', '', ['placeholder' => 'Zip Code']); ?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <?php 
        $countries= get_all_countries();
        $customer_default_country = get_option('customer_default_country');
        echo render_select('e_country',$countries,array( 'country_id',array( 'short_name')), 'shipping_country','',array('data-none-selected-text'=>_l('dropdown_non_selected_tex')));  ?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <?php echo render_input('e_bedrooms', 'Number of Bedrooms? *', '', '', ['placeholder' => 'Number of Bedrooms']);  ?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <?php echo render_textarea('e_special_instruction',  'Special Instructions for process server (ex. gate code, call number, etc) *', '', ['placeholder' => ''], [],  '', '');  ?>
        </div>
        </div>
        <div class="row"> 
      <div class="col-md-12">
      Eviction Fees <br/>
      <input type="checkbox" name="eviction_fees[]" value="1"> Stand-In ($135.00) &nbsp; </input><br/>
      <input type="checkbox" name="eviction_fees[]" value="2"> Movers - ($70.00) &nbsp; </input><br/>
      <input type="checkbox" name="eviction_fees[]" value="3"> Truck - ($175.00) &nbsp; </input><br/>
      <input type="checkbox" name="eviction_fees[]" value="4"> Locksmith- ($125.00) &nbsp; </input><br/>
      <input type="checkbox" name="eviction_fees[]" value="5">  Install New Lock - (Per Knob $45.00) &nbsp; </input><br/>
      <input type="checkbox" name="eviction_fees[]" value="6"> Drill off Lock ($85.00) &nbsp; </input><br/>
      <input type="checkbox" name="eviction_fees[]" value="7"> (1) Box of Contractor Trash Bags - $35.00) &nbsp; </input><br/>
      <input type="checkbox" name="eviction_fees[]" value="8"> Photos & Summary Report of Property ($100.00) &nbsp; </input><br/>
      </div>
      </div><br/>
      <div class="row">
            <div class="col-sm-12">
                <?php  echo render_input('e_declear', 'Name: I do solemnly declare and affirm under the penalty of perjury that the matters and facts set forth above are true to the best of my knowledge and belief: *', '', '', ['placeholder' => '']); ?>
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
<script>
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$("#next").click(function(){
  $("#physical_eviction").validate({
    rules: {
          o_name: "required",
          o_contact: "required",
          o_email: "required",
          e_zip: "required",
          e_city: "required",
          e_street_address: "required",
          e_time: "required",
          e_date: "required",
          e_case_number: "required",
          e_country: "required",
          e_bedrooms: "required",
          e_declear: "required",
         
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
        if($("#physical_eviction").valid()){
          $("#prev").removeClass("disabled");
          if (child >= length) {
            $(this).addClass("disabled");
            $('#submit').removeClass("disabled");
            $(function() {
        $('body').on('click', 'button #submit', function() {
            $('form#physical_eviction').submit();
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
        