<script>
    function checkRequiredValues(className) {
       
        let response = 0;
        let value = "";
        let inputID = "";

        $("." + className).each(function() {

            value = $(this).val();

            if(value === "")
            {
                let selectContainer = $(this).next('.select2-container');

                if(selectContainer.length != 0) // CASE THE INPUT IS A SELECT 2
                {
                    selectContainer.css('border', '1px solid #f34e4e');
                    selectContainer.css('border-radius', '.25rem');
                }
                else
                    $(this).addClass("is-invalid");
                response = 1;
            }
        });

        return response;
    }

    function checkEmailFormat() {
        let inputValue = '';
        let response = 0;
        let regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
        $('.email').each(function() {
            inputValue = $(this).val();
            if (!regex.test(inputValue)) {
                $(this).addClass('is-invalid');
                response = 1;
            }
        });
        return response;
    }

    $('.focus').on('focus change', function () {
       
        $(this).removeClass('is-invalid');
    });

</script>