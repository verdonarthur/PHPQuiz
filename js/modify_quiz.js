$(function () {

    /**
     * TEMPLATE CLONING
     */
    var questionForm = $(".questionFormTPL").removeClass("questionFormTPL").addClass("questionForm").clone();


    $('.btnAddQuestion').click(addQuestion);
    $("textarea[name^=questionOption]").on('focusout', validateJson);

    // credits to https://github.com/dustinboston/validate-json
    function validateJson(e) {
        $(e.target).validateJSON({
            // Compress the result
            compress: true,

            // Prettify the result
            reformat: true,

            // Call on valid
            onSuccess: function (json) {
                $(e.target).removeClass('is-danger');
                $(e.target).addClass('is-success');
            },

            // Call on invalid
            onError: function (error) {
                $(e.target).removeClass('is-success');
                $(e.target).addClass('is-danger');
            }
        })
    }

    function addQuestion(){
        var ele = questionForm.clone();
        ele.removeClass("questionFormTPL");
        ele.addClass("questionForm");
        ele.find("textarea[name^=questionOption]").on('focusout', validateJson);
        $('.questionsContainer').append(ele);

    }



});
