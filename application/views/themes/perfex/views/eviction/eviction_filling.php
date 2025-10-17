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
<h4 class="no-margin"> <?php echo _l('Eviction_Filling'); ?>  <a href="<?php echo base_url('clients/import'); ?>" class="btn btn-info pull-right display-block hidden-xs"><?php echo _l('Import Orders'); ?></a></h4>
<hr class="hr-panel-heading"/>
<div id="svg_wrap"></div>
<hr class="hr-panel-heading" />
<?php echo form_open_multipart($this->uri->uri_string(''), array('id' => 'eviction_filling',));?>  
  
    <section id="eviction_filling_a">
        <h4 class="text-center"><?php echo _l('Owners_information') ?> </h4> <br/>
          <div class="col-md-6"> 
            <?php
                echo render_input('o_fname', 'Owner\'s First Name *', '', '', ['placeholder' => 'Owner\'s First Name *'],[],'','');
                echo form_hidden('client_id',$client_id); 
            ?>
          </div>
            <div class="col-md-6">
        <?php
        echo render_input('o_lname', 'Owner\'s Last Name *', '', '', ['placeholder' => 'Owner\'s Last Name *']);
        ?>
        </div>
        <div class="col-sm-6">
        <?php 
        echo render_input('o_pcontact', 'Primary Contact number *', '', '', ['placeholder' => 'Primary Contact number *']); 
        echo render_input('o_email', 'Owner\'s Email Address *', '', 'email', ['placeholder' => 'Owner\'s Email Address *']);
        echo render_input('o_city', 'City *', '', '', ['placeholder' => 'City*']);
        ?>
        </div>
        <div class="col-sm-6">
        <?php  
        echo render_input('o_scontact', 'Secondary  Contact number *', '', '', ['placeholder' => 'Secondary  Contact number *']);
        echo render_input('o_zip', 'Zip Code *', '', '', ['placeholder' => 'Zip Code *']);
        echo render_input('o_state', 'State *', '', '', ['placeholder' => 'State*']);              
        ?>
        </div>
        <div class="col-md-12">
        <?php
        echo render_textarea('o_streetaddress',  'Owner\'s Street Address  *', '', ['placeholder' => 'Owner\'s Street Address  *'], [],  '', '');
        ?>
        </div>

    </section>

    <section id="eviction_filling_b">
        <h4 class="text-center">Tenant Information</h4> <br/>
        <div class="row">
        <div class="col-md-6">
        <?php
        echo render_input('t_name_one', 'Plaintiff Name: *', '', '', ['placeholder' => 'Plaintiff Name: *']);
        echo render_input('t_contact_one', 'Tenant #1 Phone number', '', 'number', ['placeholder' => 'Tenant #1 Phone number']); 
        echo render_input('t_name_two', 'Tenant #2 Name:', '', '', ['placeholder' => 'Tenant #2 Name:']);
        echo render_input('t_contact_two', 'Tenant #2 Phone number', '', 'number', ['placeholder' => 'Tenant #2 Phone number']);
        echo render_input('t_name_three', 'Tenant #3 Name:', '', '', ['placeholder' => 'Tenant #3 Name:']);
        echo render_input('t_contact_three', 'Tenant #3 Phone number', '', 'number', ['placeholder' => 'Tenant #3 Phone number']); 
        echo render_input('t_name_four', 'Tenant #4 Name:', '', '', ['placeholder' => 'Tenant #4 Name:']);
        echo render_input('t_contact_four', 'Tenant #4 Phone number', '', 'number', ['placeholder' => 'Tenant #4 Phone number']);


        ?>
        </div>
        <div class="col-md-6">
        <?php
        echo render_input('t_dob_one', 'Tenant #1: DOB', '', 'date', ['placeholder' => 'Tenant #1: DOB']);
        echo render_input('t_email_one', 'Tenant #1 Email', '', 'email', ['placeholder' => 'Tenant #1 Email']);
        echo render_input('t_dob_two', 'Tenant #2: DOB', '', 'date', ['placeholder' => 'Tenant #2: DOB']);
        echo render_input('t_email_two', 'Tenant #2 Email', '', 'email', ['placeholder' => 'Tenant #2 Email']);
        echo render_input('t_dob_three', 'Tenant #3: DOB', '', 'date', ['placeholder' => 'Tenant #3: DOB']);
        echo render_input('t_email_three', 'Tenant #3 Email', '', 'email', ['placeholder' => 'Tenant #3 Email']);
        echo render_input('t_dob_four', 'Tenant #4: DOB', '', 'date', ['placeholder' => 'Tenant #4: DOB']);
        echo render_input('t_email_four', 'Tenant #4 Email', '', 'email', ['placeholder' => 'Tenant #4 Email']);


        ?>
        </div>
        </div>
        <div class="col-md-12">
        <?php
        echo render_textarea('t_streetaddress',  'Tenant\'s Street Address  *', '', ['placeholder' => 'Owner\'s Street Address  *'], [],  '', '');
        ?>
        </div>
        <div class="row">
        <div class="col-sm-6">
        <?php
        echo render_input('t_city', 'City *', '', '', ['placeholder' => 'City*']);
        echo render_input('t_state', 'State *', '', '', ['placeholder' => 'State*']);
        echo render_select('t_rental_license_confirm', array(['id'=>'Yes', 'name'=>'Yes'] ,['id'=>'No', 'name'=>'No']), ['id','name'], _l('Do you have a Rental License for your rental property: *'), ); 
        echo render_select('t_property_govt_confirm', array(['id'=>'Yes', 'name'=>'Yes'],['id'=>'No', 'name'=>'No']), ['id','name'], _l('Is this property Government Subsidized? '), ); 
        ?>
        </div>
        <div class="col-sm-6">
        <?php
        $countries= get_all_countries();
        $customer_default_country = get_option('customer_default_country');
        $selected =( isset($client) ? $client->country : $customer_default_country);
        echo render_input('t_zip', 'Zip Code *', '', '', ['placeholder' => 'Zip Code *']);
        echo render_select( 't_country',$countries,array( 'country_id',array( 'short_name')), 'shipping_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex')));
        echo render_input('t_rental_license', 'If yes, Enter the Current License Number:', '', '', ['placeholder' => 'If yes, Enter the Current License Number:']);
        echo render_input('t_tenant_portion', 'If yes, Enter Tenant Portion:', '', '', ['placeholder' => 'If yes, Enter Tenant Portion:']);
        ?>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-4">
        <?php  echo render_select('t_rental_property_type', array(['id'=>'Condo/Apartment', 'name'=>'Condo/Apartment'],['id'=>'Townhouse/Rowhome', 'name'=>'Townhouse/Rowhome'],['id'=>'Single Family Home', 'name'=>'Single Family Home'],['id'=>'Basement Only', 'name'=>'Basement Only'],['id'=>'Top Floor Only', 'name'=>'Top Floor Only'],['id'=>'Room', 'name'=>'Room'],['id'=>'Commercial', 'name'=>'Commercial'],['id'=>'Trailer', 'name'=>'Trailer'],['id'=>'Land', 'name'=>'Land'],['id'=>'Other', 'name'=>'Other'],), ['id','name'], _l('Type of Rental Property: * '), ); 
        echo render_textarea('t_complex',  ' Name of the Complex or Property Name: *', '', ['placeholder' => ' Name of the Complex or Property Name: '], [],  '', ''); ?>
        </div>
        <div class="col-sm-4">
        <?php echo render_input('t_bedrooms', 'Number of bedrooms: *', '', '', ['placeholder' => 'Number of bedrooms:*']);
        echo render_input('t_lease_start', 'Start Date for the Lease: *', '', 'date', ['placeholder' => 'Start Date for the Lease: *']); ?>
        </div>
        <div class="col-sm-4">
        <?php echo render_input('t_levels', ' Number of levels: *', '', '', ['placeholder' => ' Number of levels:*']);
        echo render_input('t_lease_end', 'End Date for the Lease: *', '', 'date', ['placeholder' => 'End Date for the Lease: *']); ?>
        </div>
        </div>
    </section>

    <section id="eviction_filling_c">
        <h4 class="text-center">Property Information</h4> <br/>
        <div class="row">
        <div class="col-md-12">
        <?php
        echo render_select('p_lease', array(['id'=>'Current', 'name'=>'Current'],['id'=>'Month to month', 'name'=>'Month to month'],['id'=>'Expired', 'name'=>'Expired']), ['id','name'], _l('Lease *'), );           
        echo render_select('p_property_built', array(['id'=>'Is NOT affected under 6-801, Environment Article', 'name'=>'Is NOT affected under 6-801, Environment Article'],['id'=>'Is affected under 6-801, Environment Article', 'name'=>'Is affected under 6-801, Environment Article']), ['id','name'], _l('This section is for properties built before 1950. The Property is:'), );
        echo render_select('p_mde_registered', array(['id'=>'MDE Registered', 'name'=>'MDE Registered'],['id'=>'Is not MDE Registered', 'name'=>'Is not MDE Registered']), ['id','name'], _l('The Property is:'), );
        echo render_input('p_inspection_number', 'Inspection Certificate Number:', '', '', ['placeholder' => 'Inspection Certificate Number']);
        echo render_select('p_noinspection_reason', array(['id'=>'Not applicable', 'name'=>'Not applicable'],['id'=>'Property is exempt', 'name'=>'Property is exempt'],['id'=>'Tenant refused to access or vacate','name'=>'Tenant refused to access or vacate']), ['id','name'], _l('The Owner is unable to state Certificate Number because:') );
        ?>
        </div>
        </div><br/><br/>
    </section>

    <section id="eviction_filling_d">
      <h4 class="text-center">Case Information</h4> <br/>
      <div class="row">
      <div class="col-md-4">
      <?php  echo render_input('c_monthly_rent', 'Monthly Rent Amount: *', '', '', ['placeholder' => 'Monthly Rent Amount']); ?>
      </div>
      <div class="col-md-4">
      <?php echo render_select('c_rent_due', array(['id'=>'1st', 'name'=>'1st'],['id'=>'2nd', 'name'=>'2nd'],['id'=>'3rd', 'name'=>'3rd'],['id'=>'4th', 'name'=>'4th'],['id'=>'5th', 'name'=>'5th'],['id'=>'6th', 'name'=>'6th'],['id'=>'7th', 'name'=>'7th'],['id'=>'8th', 'name'=>'8th'],['id'=>'9th', 'name'=>'9th'],['id'=>'10th', 'name'=>'10th'],['id'=>'11th', 'name'=>'11th'],['id'=>'12th', 'name'=>'12th'],['id'=>'13th', 'name'=>'13th'],['id'=>'14th', 'name'=>'14th'],['id'=>'15th', 'name'=>'15th'],['id'=>'16th', 'name'=>'16th'],['id'=>'17th', 'name'=>'17th'],['id'=>'18th', 'name'=>'18th'],['id'=>'19th', 'name'=>'19th'],['id'=>'20th', 'name'=>'20th'],['id'=>'21th', 'name'=>'21th'],['id'=>'22th', 'name'=>'22th'],['id'=>'23th', 'name'=>'23th'],['id'=>'24th', 'name'=>'24th'],['id'=>'25th', 'name'=>'25th'],['id'=>'26th', 'name'=>'26th'],['id'=>'27th', 'name'=>'27th'],['id'=>'28th', 'name'=>'28th'],['id'=>'29th', 'name'=>'29th'],['id'=>'30th', 'name'=>'30th'],['id'=>'31st', 'name'=>'31st']), ['id','name'], _l('Rent is due on *'), );   ?>
      </div>
      <div class="col-md-4">
      <?php echo render_select('c_period_type', array(['id'=>'Weekly', 'name'=>'Weekly'],['id'=>'Monthly', 'name'=>'Monthly'],['id'=>'Quarterly', 'name'=>'Quarterly'],['id'=>'Yearly', 'name'=>'Yearly']), ['id','name'], _l('Type of period*'), );?>
      </div>
      </div>
      <div class="row"> 
      <div class="col-md-12">
      Months Late: <br/>
      <input type="checkbox" name="c_month_late[]" value="1"> January &nbsp; </input>
      <input type="checkbox" name="c_month_late[]" value="2"> February &nbsp; </input>
      <input type="checkbox" name="c_month_late[]" value="3"> March &nbsp; </input>
      <input type="checkbox" name="c_month_late[]" value="4"> April &nbsp; </input>
      <input type="checkbox" name="c_month_late[]" value="5"> May &nbsp; </input>
      <input type="checkbox" name="c_month_late[]" value="6"> June &nbsp; </input>
      <input type="checkbox" name="c_month_late[]" value="7"> July &nbsp; </input>
      <input type="checkbox" name="c_month_late[]" value="8"> August &nbsp; </input>
      <input type="checkbox" name="c_month_late[]" value="9"> September &nbsp; </input>
      <input type="checkbox" name="c_month_late[]" value="10"> October &nbsp; </input>
      <input type="checkbox" name="c_month_late[]" value="11"> November &nbsp;</input>
      <input type="checkbox" name="c_month_late[]" value="12"> December</input>
      </div>
      </div><br/>
      <div class="row">
      <div class="col-md-6">
      <?php echo render_input('c_total_rent_due', 'Total Amount of Rent Due: *', '', '', ['placeholder' => 'Total Amount of Rent Due: *']); ?>
      </div>
      <div class="col-md-6">
      <?php echo render_input('c_total_rent_fee', 'Total Amount of Late Fees Accrued: *', '', '', ['placeholder' => 'Total Amount of Late Fees Accrued: *']); ?>
      </div>
      </div>
      <div class="row">
      <div class="col-md-12">
      <?php 
      echo render_input('c_future_rent', 'The Landlord requests future rent between the date of complaint and date of judgment in the amount of $: * ', '', 'number', []);
      echo render_input('c_prior_judge', 'List any prior judgments against the tenant: *', '', '', []);
      echo render_select('c_tenant_complain', array(['id'=>'Yes, I will explain in comments', 'name'=>'Yes, I will explain in comments'],['id'=>'No', 'name'=>'No'],['id'=>'I dont know', 'name'=>'I dont know']), ['id','name'], _l(' Are there any outstanding repairs the tenant can complain about in court? * '), ); 
      echo render_select('c_military_service', array(['id'=>'The tenant is not in military service', 'name'=>'The tenant is not in military service'],['id'=>'The tenant is in military service', 'name'=>'The tenant is in military service']), ['id','name'], _l('Military Service *'), ); 
      echo render_select('c_listed_tenant_confirm', array(['id'=>'Yes', 'name'=>'Yes'],['id'=>'No', 'name'=>'No']), ['id','name'], _l('Are all the tenants on the lease listed above *'), ); 
      echo render_input('c_comment', ' Comment: (you can also email us your comment)', '', '', []);
      ?>
      </div>
      </div>
      <div class="row">
      <div class="col-md-6">
      <?php echo render_input('c_lease_agreement', ' Lease Agreement', '', 'file', []);
      echo render_input('c_rental_history', ' Rental History/Statement', '', 'file', []); ?>
      </div>
      <div class="col-md-6">
      <?php echo render_input('c_rental_license', ' Rental License', '', 'file', []);
      echo render_input('c_other', ' Other', '', 'file', []); ?>
      </div>
      </div>
      <div class="row">
      <div class="col-sm-12">
      <input type="checkbox" required name="c_declearation" value="decleared"> I do solemnly declare and affirm under the penalty of perjury that the matters and facts set forth above are true to the best of my knowledge and belief.</input>
      </div>
      </div>
      <div class="row">
      <div class="col-md-6">
      <?php echo render_select('c_title', array(['id'=>'Owner', 'name'=>'Owner'],['id'=>'Property Manager', 'name'=>'Property Manager'],['id'=>'Attorney', 'name'=>'Attorney'],['id'=>'Relative', 'name'=>'Relative']
      ,['id'=>'Other', 'name'=>'Other']), ['id','name'], _l('Title *'), );  ?>
      </div>
      <div class="col-md-6">
      <?php echo render_input('c_today_date', ' Today\'s Date *', '', 'date', []); ?>
      </div>
      </div>
      <div class="row">
      <div class="col-md-12">
      <?php echo render_input('c_how_you_hear', 'How did you hear about us:', '', '', []); ?>
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
  $("#eviction_filling").validate({
    rules: {
       o_fname: "required",
           o_lname: "required",
           o_pcontact: "required",
           o_email: "required",
           o_city: "required",
           o_scontact: "required",
           o_zip: "required",
           o_state: "required",
           o_streetaddress: "required",
           m_rent_amount: "required",
           t_name_one: "required",
           t_dob_one: "required",
           t_email_one: "required",
           t_streetaddress: "required",
           t_country: "required",
           t_zip: "required",
           t_property_govt_confirm: "required",
           t_rental_license: "required",
           t_state: "required",
           t_city: "required",
           t_lease_end: "required",
           t_levels: "required",
           t_lease_start: "required",
           t_bedrooms: "required",
           t_complex: "required",
           t_rental_property_type: "required",
           c_monthly_rent: "required",
         t_rent_due: "required",
         t_late_fee: "required",
         c_future_rent: "required",
         c_prior_judge: "required",
         c_tenant_complain: "required",
         c_military_service: "required",
         c_listed_tenant_confirm: "required",
         c_comment: "required",
         c_title: "required",
         c_today_date: "required",
         c_how_you_hear: "required",
      
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
        if($("#eviction_filling").valid()){
          $("#prev").removeClass("disabled");
          if (child >= length) {
            $(this).addClass("disabled");
            $('#submit').removeClass("disabled");
            $(function() {
        $('body').on('click', 'button #submit', function() {
            $('form#eviction_filling').submit();
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
        