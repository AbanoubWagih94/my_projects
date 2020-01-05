jQuery(document).ready(function(){
    show_div('#fl1','#fl2','#l1','#l2')                             //set login to default start page
    jQuery('#l1').click(function() {
        show_div('#fl1','#fl2','#l1','#l2');
    });
    jQuery('#l2').click(function(){
        show_div('#fl2','#fl1','#l2','#l1');
    });
   function show_div(to_show, to_hide, is_clicked, not_clicked){    //toggle forms
        $(is_clicked).addClass('selected');                         //mark selected div identicator
        $(not_clicked).removeClass('selected');                     //unmark unselected div identicator
        $(to_show).css('display', 'block');                         //show selected div
        $(to_hide).css('display', 'none');                          //hide selected div
   }
});