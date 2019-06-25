// dashboard js settings
$(document).ready(function()
{
    // div show/hide
    $('#carriers').on('change', function() {

        if ( this.value == '7')
        {
            $("#new_carrier_div").show();
            $('#new_carrier').focus();
        } else {
            $("#new_carrier_div").hide();
            $('#new_carrier').val('');
        }
    });
    
    
    // marketing seo form controller

    $('input[name=site_question]').click(function () {
        if (this.id == "question1") {
        $("#author_site_div").show();
        } else {
            $("#author_site_div").hide();
            $('#question3').prop('checked', false);
            $('#question4').prop('checked', false);
            $("#site_link_div").hide();
        }
    });

    $('input[name=linkback]').click(function () {
        if (this.id == "question3") {
            $("#site_link_div").show();
            $('#author_website').focus();
        } else {
            $("#site_link_div").hide();
            $('#author_website').val('');
        }
    });

    $('input[name=blog_question]').click(function () {
        if (this.id == "question5") {
            $("#blog_link_div").show();
            $('#author_blog').focus();
        } else {
            $("#blog_link_div").hide();
            $('#author_blog').val('');
        }
    });

    $('input[name=blog_question]').click(function () {
        if (this.id == "question6") {
            $("#ourblog_div").show();
        } else {
            $("#ourblog_div").hide();
        }
    });

    // social media links controller
    $('#facebook').change(function(){
        if(this.checked) {
            $('#facebook_div').show();
            $('#facebook_link').focus();
        } else {
            $('#facebook_div').hide();
            $('#facebook_link').val('');
        }

    });

    $('#twitter').change(function(){
        if(this.checked) {
            $('#twitter_div').show();
            $('#twitter_link').focus();
        } else {
            $('#twitter_div').hide();
            $('#twitter_link').val('');
        }

    });

    $('#linkedin').change(function(){
        if(this.checked) {
            $('#linkedin_div').show();
            $('#linkedin_link').focus();
        } else {
            $('#linkedin_div').hide();
            $('#linkedin_link').val('');
        }

    });

    $('#instagram').change(function(){
        if(this.checked) {
            $('#instagram_div').show();
            $('#instagram_link').focus();
        } else {
            $('#instagram_div').hide();
            $('#instagram_link').val('');
        }

    });

    $('#goodreads').change(function(){
        if(this.checked) {
            $('#goodreads_div').show();
            $('#goodreads_link').focus();
        } else {
            $('#goodreads_div').hide();
            $('#goodreads_link').val('');
        }

    });

    $('#pinterest').change(function(){
        if(this.checked) {
            $('#pinterest_div').show();
            $('#pinterest_link').focus();
        } else {
            $('#pinterest_div').hide();
            $('#pinterest_link').val('');
        }

    });

	// end social media and marketing tweaks

});
