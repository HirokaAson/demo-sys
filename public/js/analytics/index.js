$(function(){
    $("#select1a").change(() => {
        var select_val = $("#select1a").val();
        if(select_val === "1") {
            $("#include").css("display", "block");
        }
    });
});