var max = 0;
var isInsert = false;
var isAdmin = true;
$(document).ready(function () {
    // load home.php as default
    $.get("menus/home.php", function (data) {
        $('#page-wrapper').html(data);
    });
    
    //check if this user is admin or not
    $.ajax({
       type: "POST",
       async: false,
       url: "menus/logic/admin_checker.php",
       success: function(return_value){
           alert(return_value);
           if(return_value == "admin access"){
               isAdmin = true;
               $('#search_news').show();
           }else{
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
            
            
            $("#next").on("click", function () {
                var transno = parseInt($('#transno').val());
                setCardStateReadOnly(true);
//                transno++;
                $.ajax({
                    type: "POST",
                    async: false,
                    url: "menus/logic/card_statement_ajax.php",
                    dataType: 'json',
                    data: {
                        transno: transno,
                        isNext: true
                    },
                    success: function (return_value) {
                        if (max === 0)
                            max = return_value.max;
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
//                transno = transno > 0 ? transno - 1 : transno;
                $.ajax({
                    type: "POST",
                    async: false,
                    url: "menus/logic/card_statement_ajax.php",
                    dataType: 'json',
                    data: {
                        transno: transno,
                        isNext: false
                    },
                    success: function (return_value) {
                        if (max === 0)
                            max = return_value.max;
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
                        url: "menus/logic/insert.php",
                        data: {'sellerno': $('#sellerno').val(), 'product': $('#product').val(), 'price': $('#price').val(), 'transno': $('#transno').val(), 'cardno': $('#cardno').val(), 'userid': $('#userid').val(), 'date': $('#date').val()},
                        success: function (return_value) {
                            setCardStateReadOnly(true);
                            $('#next').prop('disabled', false);
                            alert(return_value);
                        }
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        async: false,
                        url: "menus/logic/savecard.php",
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
    
    $('#transaction').on('click',function(){
       $.ajax({
         async: false,
         url: "menus/logic/transaction.php",
         success: function (return_value){
             $.get("menus/listtransaction.php", function(data){
                    $('#page-wrapper').html(data);
             });
         }
        
       });
    });

    // If Search News is clicked then load search_news.php into the content section
    $("#search_news").on("click", function () {
        $.get("menus/search_news.php", function (data) {
            $('#page-wrapper').html(data);
            $('#select_rss').on("change",function(data){
               showRSS(this.value);
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
        $('#userid').val("");
        $('#cardno').val("");
        $('#date').val("");
        $('#sellerno').val("");
        $('#product').val("");
        $('#price').val("");
    }
}

function showRSS(str){
   if (str.length==0) { 
    document.getElementById("rssOutput").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("rssOutput").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","menus/logic/getfeed.php?q="+str,true);
  xmlhttp.send(); 
}