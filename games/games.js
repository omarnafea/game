$("#categories_table").dataTable();


function deleteRow(element){
    $(element).parent().parent().remove();
}


$("#save_stages").click(function () {

    const stages_rows = $(".stages-row");

    let stages_array = [];

    for(let i  = 0  ; i < stages_rows.length; i++){

        let optionsContent = {};
        let correctOption;
        const options = $(stages_rows[i]).find('.option');
        const content = $(stages_rows[i]).find('.content').val();

        for(let i = 0 ; i < options.length ; i++){
            if($(options[i]).siblings('input').is(":checked")){

                console.log($(options[i]).siblings('input'));
                console.log($(options[i]));
                correctOption = $(options[i]).siblings('input').val();
            }
            optionsContent[$(options[i]).data('name')] = $(options[i]).val();
        }

        stages_array.push(
            {
                optionsContent : optionsContent,
                content : content,
                correct_answer : correctOption

            }
        );
    }

    $.ajax({
        url:"ajax/save_text_stages.php",
        method:'POST',
        data: {
            stages : stages_array,
            game_id : $("#game_id").val()
        },
        dataType : "json",
        success:function(data)
        {
            if(data.success){
                Swal.fire({
                    icon: 'success',
                    title: '',
                    text: data.message
                })
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



$(document).on('change', '.correct-option', function() {

    if ($(this).is(':checked'))
    {

        const parentRow = $(this).closest( ".stages-row");

        const checkboxes = parentRow.find('.correct-option');

        console.log(checkboxes);

        for(let i = 0; i < checkboxes.length; i++){

            if($(checkboxes[i]).val() === $(this).val()) continue;

            if( $(checkboxes[i]).is(":checked")){
                $(checkboxes[i]).prop("checked", false );
            }
        }
    }
});

$("#add_stage").click(function () {

    const stage = `<div class="row  stages-row">
             <div class="col-md-12">
                <div class="form-group">
                    <label>Content Type</label>
                     <select class="stage-content-type form-control" name="stage_content_type">
                        <option value="-1">Select Content Type</option>
                        <option value="STRING">Text</option>
                        <option value="IMAGE">Image</option>
                        <option value="VOICE">Voice</option>
                    </select>
                </div>
            </div> 
            
            <div class="col-md-12">
                <div class="form-group">
                    <label>Content</label>
                    <input type="text" class="form-control content" value="">
                </div>
            </div> 
            
            <div class="col-md-6">
                <div class="form-group">
                    <label>Option 1</label>
                    <div class="row">
                      <input type="checkbox" class="col-2 form-control correct-option" value="option_1">
                      <input type="text" data-name="option_1" class="col-10 form-control option option-1" value="">
                     </div>
                  
                </div>
            </div>
            
           <div class="col-md-6">
                <div class="form-group">
                    <label>Option 2</label>
                     <div class="row">
                        <input type="checkbox" class="col-2 form-control correct-option" value="option_2">
                        <input type="text"  data-name="option_2" class="col-10 form-control option option-2" value="">
                     </div>                
                  </div>
            </div>
            
           <div class="col-md-6">
                <div class="form-group">
                    <label>Option 3</label>
                     <div class="row">
                        <input type="checkbox" class="col-2 form-control correct-option" value="option_3">
                        <input type="text"  data-name="option_3" class="col-10 form-control option option-3" value="">
                     </div>   
                    </div>
            </div>
            
           <div class="col-md-6">
                <div class="form-group">
                    <label>Option 4</label>
                    <div class="row">
                        <input type="checkbox" class="col-2 form-control correct-option" value="option_4">
                        <input type="text"  data-name="option_4" class="col-10 form-control option option-4" value="">
                     </div>   
                </div>
            </div>

            
            <div class="col-md-3">
                <button class="btn btn-danger delete-btn" onclick="deleteRow(this)"><i class="fa fa-times-circle"></i></button>
            </div>

        </div>`;
    $('#stages').append(stage);
});
$(document).on('submit', '#add_game_form', function(event){
    event.preventDefault();

   
    let ajax_url = "ajax/add_game.php";

    if($("#game_id").val() !== '-1'){
        ajax_url = "ajax/update_game.php"
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
