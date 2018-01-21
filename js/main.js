$(function () {
    $('.slctCategory').change(filterQuizzes);
    $('.inSearch').keyup(filterQuizzes);

    function filterQuizzes(e) {
        var valSlct = $('.slctCategory').val();
        var valSearch = $('.inSearch').val();

        $(".quizzesContainer .column").each(function (index) {

            if (!$(this).data('category').includes(valSlct) && valSlct !== "-1"
                || $(this).data('name').search(valSearch) === -1) {
                $(this).fadeOut(800, "linear");
            } else {
                $(this).fadeIn(800, "linear");
            }
        });
    }
});
