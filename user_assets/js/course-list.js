$(document).ready(function () {
    $("#sortby").click(function () {
        $(".Filter-Option1").toggleClass("Filter-Show");
        $("#sortby").toggleClass("IconUp");
    });

    $("#filterby").click(function () {
        $(".Filter-Option2").toggleClass("Filter-Show");
        $("#filterby").toggleClass("IconUp");
    });

    $("input:checkbox").on('click', function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });
});

function search_data() {
    if($("#search_course").val() == "") {
        $("#search_course").css("border-color", "#e72737");
    } else {
        var input_data = $("#search_course").val();
        var baseUrl = $("#siteURL").val();
        $.ajax({
            url: baseUrl + 'home/searchByInputValue',
            type: 'POST',
            data: {input_data: input_data},
            beforeSend: function() {
                $.blockUI({
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                    }
                });
                setTimeout($.unblockUI, 2000);
            },
            success: function(data) {
                $(".show_filter_data").html(data);
            }
        });
    }
}

function shortByChkBox (val) {
    var data = val;
    var baseUrl = $("#siteURL").val();
    $.ajax({
        url: baseUrl + 'home/searchUsingSortBy',
        type: 'POST',
        data: {sortBy_data: data},
        beforeSend: function() {
            $.blockUI({
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                }
            });
            setTimeout($.unblockUI, 2000);
        },
        success: function(data) {
            $(".show_filter_data").html(data);
        }
    });
}

function filterByChkBox (val) {
    var data = val;
    var data = val;
    var baseUrl = $("#siteURL").val();
    $.ajax({
        url: baseUrl + 'home/searchUsingFilterBy',
        type: 'POST',
        data: {filterBy_data: data},
        beforeSend: function() {
            $.blockUI({
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                }
            });
            setTimeout($.unblockUI, 2000);
        },
        success: function(data) {
            $(".show_filter_data").html(data);
        }
    });
}