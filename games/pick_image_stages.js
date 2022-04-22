
function deleteRow(element){
    $(element).parent().parent().remove();
}


$("#save_stages").click(function () {

    const stages_rows = $(".stages-row");
    let stages_array = [];

    let formData = new FormData();

    formData.append('game_id', $("#game_id").val());


    for(let i  = 0  ; i < stages_rows.length; i++){

        let optionsContent = {};
        let correctOption;
        const options = $(stages_rows[i]).find('.option');

        const contentType = $("#content_type").val();
        formData.append('content_type' , contentType);

        let content = '';

        if(contentType === 'IMAGE' || contentType === 'VOICE') {
            formData.append("contents[]",$(stages_rows[i]).find('.content').prop('files')[0]);
        }else{
            content = $(stages_rows[i]).find('.content').val();
            formData.append('stage' + (i+1) + 'content' , content);
        }

        for(let k = 0 ; k < options.length ; k++){
            if($(options[k]).siblings('input').is(":checked")){
                formData.append('stage' + (i+1) + 'correct' , k +1);
                }

            formData.append("file[]",$(options[k]).prop('files')[0]);
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
        url:"ajax/save_pick_image_stages.php",
        method:'POST',
        data: formData,
        processData: false,
        contentType: false,
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

    let content = `
     <div class="col-md-12">
                <div class="form-group">
                    <label>Content</label>
                    <input type="text" class="form-control content" value="">
                </div>
            </div>`;


    if($("#content_type").val() === 'IMAGE'){
         content = `
     <div class="col-md-12">
                <div class="form-group">
                    <label>Content</label>
                    <input type="file" class="form-control content" accept=".jpg , .png , .jpeg">
                </div>
            </div>`;
    }else if($("#content_type").val() === 'VOICE'){
        content = `
     <div class="col-md-12">
                <div class="form-group">
                    <label>Content</label>
                    <input type="file" class="form-control content" accept=".mp3">
                </div>
            </div>`;
    }

    const stage = `<div class="row  stages-row">
            ${content}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Option 1</label>
                    <div class="row">
                      <input type="checkbox" class="col-2 form-control correct-option" value="option_1">
                      <input type="file" accept=".jpg , .png , .jpeg" data-name="option_1" class="col-10 form-control option option-1">
                     </div>
                  
                </div>
            </div>
            
           <div class="col-md-6">
                <div class="form-group">
                    <label>Option 2</label>
                     <div class="row">
                        <input type="checkbox" class="col-2 form-control correct-option" value="option_2">
                        <input type="file" accept=".jpg , .png , .jpeg"  data-name="option_2" class="col-10 form-control option option-2">
                     </div>                
                  </div>
            </div>
            
           <div class="col-md-6">
                <div class="form-group">
                    <label>Option 3</label>
                     <div class="row">
                        <input type="checkbox" class="col-2 form-control correct-option" value="option_3">
                        <input type="file" accept=".jpg , .png , .jpeg" data-name="option_3" class="col-10 form-control option option-3">
                     </div>   
                    </div>
            </div>
            
           <div class="col-md-6">
                <div class="form-group">
                    <label>Option 4</label>
                    <div class="row">
                        <input type="checkbox" class="col-2 form-control correct-option" value="option_4">
                        <input type="file" accept=".jpg , .png , .jpeg"  data-name="option_4" class="col-10 form-control option option-4">
                     </div>   
                </div>
            </div>

            
            <div class="col-md-3">
                <button class="btn btn-danger delete-btn" onclick="deleteRow(this)"><i class="fa fa-times-circle"></i></button>
            </div>

        </div>`;
    $('#stages').append(stage);
});
