var counterQuestion = 1;
var actualQuestion;
var score = 0;

$(function () {
    hideNotSelectedQuestion(counterQuestion);


    $("#btnCorrect").click(correctActualQuestion);
    $("#btnNextQuestion").click(goNextQuestion);
    $("#btnLastQuestion").click(goLastQuestion);


    function correctActualQuestion() {
        var inputName = "input[name=questionId" + actualQuestion.data('idquestion') + "]";
        var inputToTest = $(inputName);

        switch (inputToTest.attr('type')) {
            case 'radio':
                if (String(actualQuestion.data('answer')) === String($(inputName + ":checked").val())) {
                    goodAnswer(actualQuestion);
                } else {
                    badAnswer(actualQuestion)
                }

                break;

            case 'checkbox':
                var answers = actualQuestion.data('answer').split(",");
                var valCheckbox = [];
                $(inputName + ":checked").each(function (i) {
                    valCheckbox[i] = $(this).val();
                });

                if (JSON.stringify(valCheckbox) === JSON.stringify(answers)) {

                    goodAnswer(actualQuestion);
                } else {

                    badAnswer(actualQuestion)
                }
                break;

            case 'text':
                if (actualQuestion.data('answer') === $(inputName).val()) {
                    goodAnswer(actualQuestion);
                } else {
                    badAnswer(actualQuestion)
                }
                break;
        }

        $(inputName).prop('disabled', true);
    }

    function goodAnswer(question) {
        growUpScore();
        $('#answer' + question.data('idquestion')).text("Bravo bonne réponse !");
    }

    function badAnswer(question) {
        $('#answer' + question.data('idquestion')).text("La bonne réponse était : " + question.data('answer') + " !");
    }

    function goNextQuestion() {

        if (counterQuestion + 1 <= getNumberQuestion()) {
            hideNotSelectedQuestion(++counterQuestion);
            $("#btnLastQuestion").prop('disabled', false);

            if (counterQuestion == getNumberQuestion()) {
                $("#btnNextQuestion").text("Fin");
            }
        }
        else {
            $('#quizEnded').addClass('is-active');
            $('#quizEnded .btnWatchAnswer').click(function () {
                $('#quizEnded').removeClass('is-active');
            });
        }
    }

    function goLastQuestion() {

        if (counterQuestion - 1 >= 1) {
            $("#btnNextQuestion").text("Prochaine Question");
            hideNotSelectedQuestion(--counterQuestion);
            if (counterQuestion == 1)
                $("#btnLastQuestion").prop('disabled', true);
        } else {
            $("#btnLastQuestion").prop('disabled', true);
        }
    }

    function growUpScore() {
        score++;
        $(".score").each(function (i) {
            $(this).text(score);
        });
    }

    function hideNotSelectedQuestion(num) {
        $(".question").each(function (i, ele) {
            if ($(ele).data('order') !== num) {
                if ($(ele).is(":visible"))
                    $(ele).toggle();
            } else {
                actualQuestion = $(ele);
                if ($(ele).is(':hidden'))
                    $(ele).toggle();
            }
        });
    }

    function getNumberQuestion() {
        return $(".question:last").data('order');
    }
});