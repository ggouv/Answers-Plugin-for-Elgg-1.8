$(document).ready(function(){
        $('a.collapsibleboxlink').click(function () {
                $(this.parentNode.parentNode).children(".collapsible_box").slideToggle("fast");
                return false;
        });
});