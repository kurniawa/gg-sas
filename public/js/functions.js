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
    let harga_ohne_titik = harga.replace(".", "");
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

function formatNumberHargaRemoveDecimal(harga) {
    // console.log(harga);
    let harga_2 = "";
    if (harga.includes(".")) {
        let harga_1 = harga.slice(0, harga.indexOf("."));
        harga_2 = harga.slice(harga.indexOf("."), harga.length);
        // console.log(harga_1); console.log(harga_2);
        harga = harga_1;
        if (parseInt(harga_2[1]) >= 5) {
            harga = (parseInt(harga) + 1).toString();
        }
    }
    let harga_ohne_titik = harga.replace(".", "");
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
    // console.log(hargaRP);
    return hargaRP;
    // console.log(harga_2);
    // return (parseFloat(hargaRP) + harga_2).toString();
}
