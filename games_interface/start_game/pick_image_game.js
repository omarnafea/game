
$(document).ready(function () {
    $(".stage-container").click();
});

$('.start-game').click(function () {
    getFirstStage($("#game_id").val());
    $(this).hide();
});

let stageIndex = 0;

let stages = [];

let currentStage;

function getFirstStage(game_id) {

    $.ajax({
        url:"../ajax/get_stage.php",
        method:'POST',
        async: false,
        data: {
            game_id : game_id
        },
        dataType : "json",
        success:function(data)
        {
            if(data.success){
                stages = data.data;

               renderNextStage();
            }
        }
    });

}


function renderNextStage(){

    $("#progress").html(stageIndex+ 1 + '/' + stages.length);
    if(stageIndex === stages.length){

        startConfetti();

        Swal.fire({
            icon: 'success',
            title: 'Game finished',
            text:  ' '
        }).then(function () {
            window.location.href = "../index.php";
        });
        return;
    }

    currentStage = stages[stageIndex];


    console.log(currentStage);


    $.ajax({
        url:"../ajax/get_stage_options.php",
        method:'POST',
        async: false,
        data: {
            stage_id : currentStage.id
        },
        dataType : "json",
        success:function(data)
        {
            const options = data.data;

            $("#options").html('');

            for(let option of options){
               appendOption(option);

            }
        }
    });


    if(currentStage.content_type === "VOICE"){
        $("#voiceContentSource").attr( 'src' , currentStage.content);

        setTimeout(function () {
            let aud = document.getElementById("voiceContent");
            aud.load();
            aud.play();
        }, 1000);


    }else{
        $("#content").html(currentStage.content);

    }
}



function appendOption(option) {

    let isCorrectOption  = '';

    if(option.id === currentStage.correct_answer_id){
        isCorrectOption = "correct_option";
    }

    let optionHTML = `
    
    <div class='col-6'>
       <div class="col-md-6 option ${isCorrectOption}" onclick="checkOption(this)">
        <img src=" ${option.option}" class="img-fluid" height="200" width="200">
       </div>
    </div>`;

    $("#options").append(optionHTML);
}

function checkOption(option){
    if($(option).hasClass('correct_option')){

        $(option).css("background-color", "green");
        let aud = document.getElementById("correctAudio");
        aud.play();
        stageIndex++;

        setTimeout(renderNextStage, 500);
    }else{
        $(option).css("background-color", "red");
        let aud = document.getElementById("wrongAudio");
        aud.play();

         setTimeout(function () {
            $(option).css("background-color", "#d3d9df");
        }, 1000);

    }

}

