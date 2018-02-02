$(function () {
    /**
     * TEMPLATE CLONING
     */
    var questionForm = $(".questionForm").clone();

    /**
     * BIND FUNCTIONS ON EVENT
     */
    $('.slctCategory').change(filterQuizzes);
    $('.inSearch').keyup(filterQuizzes);
    $('.btnRemoveQuizz').click(removeQuizz);
    $('.btnAddQuestion').click(addQuestion);


    /**
     * filter Quizz
     * @param e
     */
    function filterQuizzes(e) {
        var valSlct = $('.slctCategory').val();
        var valSearch = $('.inSearch').val();

        $(".quizzesContainer .column").each(function (index) {

            if (!$(this).data('category').includes(valSlct) && valSlct !== "-1"
                || $(this).data('name').toLowerCase().search(valSearch.toLowerCase()) === -1) {
                $(this).fadeOut(800, "linear");
            } else {
                $(this).fadeIn(800, "linear");
            }
        });
    }

    /**
     * Add a quizz on management interface
     */
    function removeQuizz(e) {
        var btnRemoveQuiz = $(e.target);
        var quiz = btnRemoveQuiz.closest(".column.is-6").data();
        var modal = btnRemoveQuiz.closest(".column.is-6").find('.modal');
        modal.addClass('is-active');
        modal.find('.btnYes').on("click", function () {
            modal.removeClass('is-active');
            $(e.target).closest(".column.is-6").remove();
            // TODO : Code for remove from DB
        });
        modal.find('.btnNo').on("click", function () {
            modal.removeClass('is-active');
        });
    }

    function addQuestion(){
        $('.questionsContainer').append(questionForm.clone());

    }


});
