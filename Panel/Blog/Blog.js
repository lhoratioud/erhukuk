
function changelabel() {
    var a = document.getElementById('fileToUpload');
    var b = document.getElementById('filelabel');
    if(a.value == "")
    {
        b.textContent = "Kapak Görseli Seçiniz";
    }
    else
    {
        var theSplit = a.value.split('\\');
        b.textContent = theSplit[theSplit.length-1];
        b.style.background = 'rgb(61 84 70)';
        b.style.color = 'white';
    }
}


function changelabeledit() {
    var a = document.getElementById('fileToUpload');
    var b = document.getElementById('filelabel');
    var c = document.getElementById('hiddenfilename');
    if(a.value == "")
    {
    }
    else
    {
        var theSplit = a.value.split('\\');
        b.textContent = theSplit[theSplit.length-1];
        c.value = theSplit[theSplit.length-1];
    }
}



//
//$(document).ready(function(){
//    $(".formish").submit(function(e) {
//
//
//    e.preventDefault(); // avoid to execute the actual submit of the form.
//
//    var form = $(this);
//    var actionUrl = "swapstatue.php";
//    
//    $.ajax({
//        type: "POST",
//        url: actionUrl,
//        data: form.serialize(), // serializes the form's elements.
//        success: function(data)
//        {
//            /*var st = "#";
//            var b = st.concat(data);
//            b = b.replace(/[\r\n]/gm, '');
//            $(`${b}`).load(location.href + " " + `${b}`);*/
//            location.reload();
//        }
//    });
//})});
//

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


$(document).ready(function() {

    $(".form-control2").select2({
        tags: true,
        disabled: true,
        width: '100%',
        tokenSeparators: [',', '']
    })

} );


$(document).ready(function() {

    $(".form-control").select2({
        tags: true,
        width: '100%',
        placeholder: 'Kendi etiketlerinizi \', (virgül)\' ile ayırarak girebilirsiniz.',
        tokenSeparators: [',', '']
    })

} );




function readURL(input) {
    document.getElementById("resimalani").style.display = 'block';
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#resimalani')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
