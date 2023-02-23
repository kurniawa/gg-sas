function toggleNavCart() {
    $("#nav_cart").toggle(350);
    $("#nav_cart_close_layer").show();
}

function hideNavCart() {
    $("#nav_cart").hide(350);
    $("#nav_cart_close_layer").hide();
}

function formatHarga(harga) {
    // console.log(harga);
    harga_ohne_titik = harga.replace(".", "");
    if (harga_ohne_titik.length < 4) {
        return harga;
    }
    let hargaRP = "";
    let akhir = harga_ohne_titik.length;
    let posisi = akhir - 3;
    let jmlTitik = Math.ceil(harga_ohne_titik.length / 3 - 1);
    // console.log(jmlTitik);
    for (let i = 0; i < jmlTitik; i++) {
        hargaRP = "." + harga_ohne_titik.slice(posisi, akhir) + hargaRP;
        // console.log(hargaRP);
        akhir = posisi;
        posisi = akhir - 3;
    }
    hargaRP = harga_ohne_titik.slice(0, akhir) + hargaRP;
    return hargaRP;
}

function formatNumber(number, element) {
    // console.log(element);
    var formatted_number = formatHarga(number.toString());
    if (element == null) {
        return formatted_number;
    } else {
        element.textContent = formatted_number;
        return true;
    }
}

function formatCurrencyRp(number, element) {
    // console.log(element);
    var formatted_number = formatHarga(number.toString());
    if (element == null) {
        return formatted_number;
    } else {
        element.innerHTML = `<div><div class="d-flex justify-content-between"><span>Rp</span><span>${formatted_number},-</span></div></div>`;
        // console.log(element);
        return true;
    }
}

function formatNumberK(number, element) {
    // console.log(element);
    number = Math.ceil(number / 1000);
    // console.log(number);
    var formatted_number = formatHarga(number.toString());
    if (element == null) {
        return formatted_number;
    } else {
        element.textContent = formatted_number + "k";
        return true;
    }
}
