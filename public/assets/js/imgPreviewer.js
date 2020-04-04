(function() {
    function readURL(input, previewStorage, sizeStorage) {

        if (input.files && input.files[0]) {
            var thisFile = input.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                $(previewStorage).css({
                    'background': 'url(' + e.target.result + ')',
                });
                thisFSize = thisFile.size;
                fileSizeinKB = ((thisFSize - (thisFSize % 1024)) / 1024) + 1;
                $(sizeStorage).html(fileSizeinKB + "kb");
            }
            ;

            reader.readAsDataURL(thisFile);
        } else {
            $(previewStorage).removeAttr("style");
			$(sizeStorage).html("No File Selected");
        }
    }
    
    $("input[type='file'].show_imgpreview").change(function(){
        readURL(this, $(this).attr("data-previewbox"), $(this).attr("data-sizebox"));
    });
}
)();
