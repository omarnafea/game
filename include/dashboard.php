<?php
?>

<div class="admin-dashboard">
    <ul class="list-group list-group-flush">
        <li class="list-group-item pagelink">
            <a class="stretched-link text-decoration-none" href="../dashboard"><i class="fas fa-list"></i> DASHBOARD</a>
        </li>

               <li class="list-group-item pagelink">
                 <a class="stretched-link text-decoration-none" href="../users"> <i class="fas fa-users"></i> Users</a>
              </li>

               <li class="list-group-item pagelink">
                 <a class="stretched-link text-decoration-none" href="../games"> <i class="fas fa-tag"></i>  Games</a>
              </li>

               <li class="list-group-item pagelink">
                 <a class="stretched-link text-decoration-none" href="../categories"> <i class="fas fa-tag"></i>  Categories</a>
              </li>

    </ul>
</div>



<script>


    $(document).ready(function() {

        $(".dashboard-list").click(function(){
            if($(this).hasClass('close')){
                $(".admin-dashboard").css({"left": "0"});
                $(this).removeClass('close').addClass('open');
            }else{
                $(".admin-dashboard").css({"left": "-300px"});
                $(this).removeClass('open').addClass('close');
            }
        });

    });
</script>