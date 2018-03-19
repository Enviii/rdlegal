function hideAll() {
    document.getElementById("year_data").style.display = "none";
    document.getElementById("month_data").style.display = "none";
    document.getElementById("quarter_data").style.display = "none";
    document.getElementById("week_data").style.display = "none";
}

$( document ).ready(function() {
    hideAll();
    $("#year_data").show();

    $( "#year_btn" ).click(function() {
        hideAll();
        $("#year_data").show();
    });

    $( "#month_btn" ).click(function() {
        hideAll();
        $("#month_data").toggle();
    });

    $( "#quarter_btn" ).click(function() {
        hideAll();
        $("#quarter_data").show();
    });

    $( "#week_btn" ).click(function() {
        hideAll();
        $("#week_data").show();
    });

});
