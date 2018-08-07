/** DCRF custom scripts **/


jQuery(document).ready(function($){

	// Add More Experience
    var i = 0;
    var j = 1;
    jQuery('form.advisor_register_form .add_more_experience').on('click',function(e){
        e.preventDefault();
        i++;
        j++;
        var html = '';
        html += '<div class="column one"><label class="title">Experience '+j+'</label></div><div class="column one-third"><label>Company Name</label><span class="city"><input type="text" name="work_experience['+i+'][company_name]" value=""></span></div>';
        html += '<div class="column one-third"><label>Job Title</label><span class="city"><input type="text" name="work_experience['+i+'][job_title]" value=""></span></div>';
        html += '<div class="column one-third"><label>Year start- End Year</label><span class="city"><input type="text" name="work_experience['+i+'][duration]" value=""></span></div>';
        html += '<div class="column one office-address"><label>Office Address</label><span class="office-address"><textarea name="work_experience['+i+'][office_address]" cols="40" rows="1"></textarea></span></div>';

        jQuery('form.advisor_register_form .work_experience_wrap').append(html);
    });

}); //-> Document.ready