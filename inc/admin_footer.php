        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">
        <p>
         &copy; <?php echo date("Y"); ?> IsDB Round-5 All Rights Reserved.
        </p>
    </div>

    <script type="text/javascript">

        
        function emptValid(id, show, type = null){
            var valid = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            var user = /[^a-z0-9]/;
            var getValue = $("#"+id).val();

            if (type == null) {
                if (getValue == "") {
                $("#"+id).attr("style","border:2px solid red !important");
                 $("#"+show).html("Field must not be empty.").css("color","red");
                }else{
                    $("#"+id).attr("style","border:");
                     $("#"+show).html("").css("color","");
                }
            }


            if (type == "email") {
                if (getValue == "") {
                    $("#"+id).attr("style","border:2px solid red !important");
                    $("#"+show).html("Field must not be empty.").css("color","red");
                }else if(!valid.test(getValue)){
                    $("#"+id).attr("style","border:2px solid red !important");
                    $("#"+show).html("Email address invalid.").css("color","red");
                }else{
                    $("#"+id).attr("style","border:");
                     $("#"+show).html("").css("color","");
                }
            }


            if (type == "username") {
                if (getValue == "") {
                    $("#"+id).attr("style","border:2px solid red !important");
                    $("#"+show).html("Field must not be empty.").css("color","red");
                }else if(user.test(getValue)){
                    $("#"+id).attr("style","border:2px solid red !important");
                    $("#"+show).html("Username is invalid.").css("color","red");
                }else{
                    $("#"+id).attr("style","border:");
                     $("#"+show).html("").css("color","");
                }
            }

            if (type == "password") {
                if (getValue == "") {
                    $("#"+id).attr("style","border:2px solid red !important");
                    $("#"+show).html("Field must not be empty.").css("color","red");
                }else if(getValue.length < 6){
                    $("#"+id).attr("style","border:2px solid red !important");
                    $("#"+show).html("Password too short.").css("color","red");
                }else{
                    $("#"+id).attr("style","border:");
                     $("#"+show).html("").css("color","");
                }
            }

            if (type == "select") {
                if (getValue == "") {
                    $("#"+id).attr("style","border:2px solid red !important");
                    $("#"+show).html("Please select any option.").css("color","red");
                }else{
                    $("#"+id).attr("style","border:");
                     $("#"+show).html("").css("color","");
                }
            }

        }

    </script>
</body>
</html>
