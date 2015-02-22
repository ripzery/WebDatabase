var max = 0;
var isInsert = false;
var isAdmin = true;
var userid = 0;
var cardno = 0;
var transno = 0;
$(document).ready(function () {
    // load home.php as default
    $.get("menus/home.php", function (data) {
        $('#page-wrapper').html(data);
    });

    //check if this user is admin or not
    $.ajax({
        type: "POST",
        async: false,
        url: "menus/php_database/admin_checker.php",
        success: function (return_value) {
            if (return_value == "admin access") {
                isAdmin = true;
                $('#search_news').show();
            } else {
                isAdmin = false;
                $('#search_news').hide();
            }
        }

    });

    // If Home is clicked then load home.php into the content section
    $("#home").on("click", function () {
        $.get("menus/home.php", function (data) {
            $('#page-wrapper').html(data);
        });
    });

    // If Home is clicked then load home.php into the content section.
    $("#profile").on("click", function () {
        $.get("menus/profile.php", function (data) {
            $('#page-wrapper').html(data);
        });
    });

    // If Card Infos is clicked then load card_info.php into the content section.
    $("#card_info").on("click", function () {
        $.get("menus/card_info.php", function (data) {
            $('#page-wrapper').html(data);
        });
    });

    // If Card Statement is clicked then load card_statement.php into the content section.
    $("#card_stat").on("click", function () {
        $.get("menus/card_statement.php", function (data) {
            $('#page-wrapper').html(data);

            //assign value to var
            userid = $('#userid').val();
            cardno = $('#cardno').val();
            transno = $('#transno').val();

            // find max transaction number
            $.ajax({
                url: "menus/php_database/total_transaction.php",
                async: false,
                success: function (return_value) {
                    max = return_value;
                }
            });

            // fix card no incorrect value
            $.ajax({
                type: "POST",
                url: "menus/php_database/card_statement_ajax.php",
                async: false,
                dataType: 'json',
                data: {
                    transno: transno
                },
                success: function (return_value) {
                    $('#cardno').val(return_value.number);
                }
            });

            $("#next").on("click", function () {
                var transno = parseInt($('#transno').val());
                setCardStateReadOnly(true);
                $.ajax({
                    type: "POST",
                    async: false,
                    url: "menus/php_database/card_statement_ajax.php",
                    dataType: 'json',
                    data: {
                        transno: transno,
                        isNext: true
                    },
                    success: function (return_value) {
                        $('#transno').val(return_value.transno);
                        $('#userid').val(return_value.uid);
                        $('#cardno').val(return_value.number);
                        $('#date').val(return_value.date);
                        $('#sellerno').val(return_value.sellerno);
                        $('#product').val(return_value.product);
                        $('#price').val(return_value.price);
                    }
                });
            });

            $("#previous").on("click", function () {
                $('#next').prop('disabled', false);
                setCardStateReadOnly(true);
                var transno = parseInt($('#transno').val());
                $.ajax({
                    type: "POST",
                    async: false,
                    url: "menus/php_database/card_statement_ajax.php",
                    dataType: 'json',
                    data: {
                        transno: transno,
                        isNext: false
                    },
                    success: function (return_value) {
                        $('#transno').val(return_value.transno);
                        $('#userid').val(return_value.uid);
                        $('#cardno').val(return_value.number);
                        $('#date').val(return_value.date);
                        $('#sellerno').val(return_value.sellerno);
                        $('#product').val(return_value.product);
                        $('#price').val(return_value.price);
                    }
                });

            });


            $("#insert").on("click", function () {
                isInsert = true;
                $('#transno').val(parseInt(max) + 1);
                setCardStateReadOnly(false);
                if (!isAdmin) {
                    $('#userid').prop('readonly', true);
                    $('#cardno').prop('readonly', true);
                }
                $('#next').prop('disabled', true);
            });

            $("#edit").on("click", function () {
                isInsert = false;
                $('#save').prop('disabled', false);
                $('#sellerno').prop("readonly", false);
                $('#product').prop("readonly", false);
                $('#price').prop("readonly", false);

            });

            $("#save").on("click", function () {
                if (isInsert) {
                    $.ajax({
                        type: "POST",
                        async: false,
                        url: "menus/php_database/insert.php",
                        data: {'sellerno': $('#sellerno').val(), 'product': $('#product').val(), 'price': $('#price').val(), 'transno': $('#transno').val(), 'cardno': $('#cardno').val(), 'userid': $('#userid').val(), 'date': $('#date').val()},
                        success: function (return_value) {
                            setCardStateReadOnly(true);
                            $('#next').prop('disabled', false);
                            alert(return_value);
                            max = (parseInt(max) + 1);
                        }
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        async: false,
                        url: "menus/php_database/savecard.php",
                        data: {'sellerno': $('#sellerno').val(), 'product': $('#product').val(), 'price': $('#price').val(), 'transno': $('#transno').val()},
                        success: function (return_value) {
                            setCardStateReadOnly(true);
                            $('#next').prop('disabled', false);
                            alert(return_value);
                        }
                    });
                }
            });


        });
    });

    $('#transaction').on('click', function () {
        $.ajax({
            async: false,
            url: "menus/php_database/transaction.php",
            success: function (return_value) {
                $.get("menus/listtransaction.php", function (data) {
                    $('#page-wrapper').html(data);
                });
            }

        });
    });

    // If Search News is clicked then load search_news.php into the content section
    $("#search_news").on("click", function () {
        $.get("menus/search_news.php", function (data) {
            $('#page-wrapper').html(data);
            $('#select_rss').on("change", function (data) {
                getFeed(this.value);
            });
        });
    });



});

// set attribute of the element in card_statement.php
function setCardStateReadOnly(isReadOnly) {
    $('#save').prop('disabled', isReadOnly);
    $('#userid').prop("readonly", isReadOnly);
    $('#cardno').prop("readonly", isReadOnly);
    $('#date').prop("readonly", isReadOnly);
    $('#sellerno').prop("readonly", isReadOnly);
    $('#product').prop("readonly", isReadOnly);
    $('#price').prop("readonly", isReadOnly);
    if (!isReadOnly) {
        if (isAdmin) {
            $('#userid').val("");
            $('#cardno').val("");
        }
        $('#date').val("");
        $('#sellerno').val("");
        $('#product').val("");
        $('#price').val("");
    }
}

function getFeed(str) {
    if (str.length == 0) {
        $('#rssOutput').innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("rssOutput").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "menus/php_database/getfeed.php?q=" + str, true);
    xmlhttp.send();
}
