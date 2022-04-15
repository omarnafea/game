$("#categories_table").dataTable();


$(document).on('submit', '#add_game_form', function(event){
    event.preventDefault();

   
    let ajax_url = "ajax/add_game.php";

    if($("#game_id").val() !== '-1'){
        ajax_url = "ajax/update_game.php"
    }

    if($("#category_id").val() === '-1'){
        Swal.fire({
            icon: 'warning',
            title: 'Invalid Inputs',
            text: "Please select game category"
        })
        return false;
    }

    if($("#type").val() === '-1'){
        Swal.fire({
            icon: 'warning',
            title: 'Invalid Inputs',
            text: "Please select game type"
        })
        return false;
    }


    $.ajax({
        url:ajax_url,
        method:'POST',
        data: new FormData(this),
        contentType:false,
        processData:false,
        dataType : "json",
        success:function(data)
        {
           if(data.success){
               Swal.fire({
                   icon: 'success',
                   title: '',
                   text: data.message
               }).then(function () {

                   const gameType = $("#type").val();

                   if(gameType === "TEXT_QUESTIONS")
                         window.location.href = "add_text_stages.php?game_id=" + data.game_id;
                   else if (gameType === "PICK_IMAGE")
                       window.location.href = "add_pick_image_stages.php?game_id=" + data.game_id;
               });

           }else{
            Swal.fire({
                icon: 'warning',
                title: '',
                text: data.message
            })
           }
        }
    });

});
