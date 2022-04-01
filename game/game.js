
 $(document).ready(function () {


     // var audio = new Audio('ok.mp3');
     // audio.play()
     // aud.play();
     $(".correct-choice").attr("ondrop" , 'drop(event)');
     $(".game-choice").attr("ondragover" , 'allowDrop(event)')

 });


 function allowDrop(ev) {
     if($(ev.currentTarget).hasClass('correct-choice')){
         ev.preventDefault();
     }else{
         let aud = document.getElementById("myAudio");
         aud.volume = 0.5; // default 1 means 100%
         aud.play();
         shakeCorrect();

     }

 }

 function drag(ev) {
     ev.dataTransfer.setData("text", ev.target.id);
 }

 function drop(ev) {
     ev.preventDefault();
     var data = ev.dataTransfer.getData("text");
     ev.target.appendChild(document.getElementById(data));
     console.log('dropped');
 }


 function shakeCorrect() {
     $('.correct-choice').shake();
 }