function checkMesaj() {
    const hiddenmesaj = document.getElementById("hiddenMessage");
    const mesaj = document.getElementById("MESAJ");
    if(hiddenmesaj.value.lenght == 0)
    {
        return;
    }
    if(!(hiddenmesaj.value))
    {
        return;
    }
    if(hiddenmesaj.value == "Geçersiz Kullanıcı Adı / Parola lütfen tekrar deneyiniz.")
    {
        mesaj.textContent = "Geçersiz Kullanıcı Adı / Parola lütfen tekrar deneyiniz.";
        mesaj.style.color = 'red';
    }
    else if (hiddenmesaj.value == "Giriş Başarılı !!!! Yönlendiriliyorsunuz...")
    {
        mesaj.textContent = "Giriş Başarılı !!!! Yönlendiriliyorsunuz...";
        mesaj.style.color = 'green';
    }
}

function gifstart() {
    document.getElementById("loadingimg").style.display = 'block';
}

function gifstop () {
    document.getElementById("loadingimg").style.display = 'none';
}