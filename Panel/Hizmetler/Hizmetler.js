$(document).ready(function(){
    $(".activeform").click(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form

    var result = confirm('Seçili yazının aktiflik durumunu değiştirmek istiyor musunuz?'); 
    if (result) 
    {
        var form = $(this);
        var actionUrl = "swapstatue.php";
    
        $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            /*var st = "#";
            var b = st.concat(data);
            b = b.replace(/[\r\n]/gm, '');
            $(`${b}`).load(location.href + " " + `${b}`);*/
            location.reload();
        }
    });

    }
    else {
        return;
    }

})});


$(document).ready(function(){
    $(".deleteform").click(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form

    var result = confirm('Seçili yazıyı silmek istiyor musunuz?'); 
    if (result) 
    {
        var form = $(this);
        var actionUrl = "swapstatue.php";
    
        $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            /*var st = "#";
            var b = st.concat(data);
            b = b.replace(/[\r\n]/gm, '');
            $(`${b}`).load(location.href + " " + `${b}`);*/ 
            location.reload();
        }
    });

    }
    else {
        return;
    }

})});


