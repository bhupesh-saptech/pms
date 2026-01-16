<script>
    $('.select2').select2();

    var mode = "<?php if(isset($mode)) { 
                            echo $mode; 
                        } else {
                            echo '';
                        }?>";
    switch(mode) {
        case 'view':
            $('#form input'   ).prop('disabled', true);
            $('#form select'  ).prop('disabled', true);
            $('#form textarea').prop('disabled', true);
            break;
        case 'update' :
            $('#pass_wd').hide();
            $('#cpas_wd').hide();
            break;
        case 'delete':
            $('#form input').prop('readonly', true);
            break;
    }
    function btnToggle(obj,event) {
        if (obj.type === "button") {
                form = $(obj).closest('form');
                form.find("input").prop('disabled',false);
                form.find("select").prop('disabled',false);
                obj.type = "submit"; // ✅ Change to submit
                event.preventDefault();
                obj.innerHTML = '<i class="fa fa-save"></i>';
        } 
    }

</script>