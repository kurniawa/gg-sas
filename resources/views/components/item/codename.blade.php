<div class="mt-1 border rounded p-1">
    <table>
        <tr>
            <th>Nama</th><th>:</th>
            <td></td>
        </tr>
        <tr>
            <th>Specs</th><th>:</th>
            <td></td>
        </tr>
        <tr>
            <th>KodeBrg</th><th>:</th>
            <td></td>
        </tr>
    </table>

</div>
<script>
    const antings = {!! json_encode($antings,JSON_HEX_TAG) !!};
    const giwangs = {!! json_encode($giwangs,JSON_HEX_TAG) !!};
    const cincins = {!! json_encode($cincins,JSON_HEX_TAG) !!};
    const kalungs = {!! json_encode($kalungs,JSON_HEX_TAG) !!};
    const gelangrantais = {!! json_encode($gelangrantais,JSON_HEX_TAG) !!};
    const gelangbulats = {!! json_encode($gelangbulats,JSON_HEX_TAG) !!};
    const liontins = {!! json_encode($liontins,JSON_HEX_TAG) !!};

    function generateNama() {
        // console.log(caps);
        const tipe_barang = document.getElementById('tipe_barang');
        const tipe_perhiasan = document.getElementById('tipe_perhiasan');
        const jenis_perhiasan = document.getElementById('jenis_perhiasan');
        const range_usia = document.getElementById('range_usia');
        const warna_emas = document.getElementById('warna_emas');
        const nampan = document.getElementById('nampan');
        const input_warna_matas = document.querySelectorAll('.warna_mata');
        const input_jumlah_matas = document.querySelectorAll('.jumlah_mata');
        const input_mainans = document.querySelectorAll('.mainan');
        const input_jumlah_mainans = document.querySelectorAll('.jumlah_mainan');
        const input_plat = document.getElementById('input-plat-0');
        const input_ukuran = document.getElementById('input-ukuran-0');
        const kadar = document.getElementById('kadar');
        const berat = document.getElementById('berat');

        // console.log(tipe_barang.value);
        // console.log(warna_matas);
        // warna_matas.forEach(warna_mata => {
        //     console.log(warna_mata.value);
        // });
        // console.log(input_plat);


        //     // TIPE & JENIS PERHIASAN
        //     tipe_perhiasan = dataTipePerhiasan.find(
        //         (element: any) => element.doc_id === item.tipe_perhiasan
        //     );
        //     // console.log('tipe_perhiasan:', tipe_perhiasan);
        //     if (typeof tipe_perhiasan !== 'undefined') {
        //         item.nama += item.tipe_perhiasan;
        //         item.kode_barang += tipe_perhiasan.kode.toString();
        //         jenis_perhiasan = tipe_perhiasan.jenis.find(
        //             (element: any) => element.nama === item.jenis_perhiasan
        //         );
        //         if (typeof jenis_perhiasan !== 'undefined') {
        //             item.nama += ' ' + item.jenis_perhiasan;
        //             item.kode_barang += jenis_perhiasan.kode.toString();
        //         }
        //     }
        //     // console.log('jenis_perhiasan', jenis_perhiasan);

        //     // SPECS
        //     item.specs = '';
        //     // RANGE USIA
        //     range_usia = dataRangeUsia.find((element: any) => element.doc_id === item.range_usia);
        //     if (typeof range_usia !== 'undefined') {
        //         item.specs += range_usia.nama;
        //         item.kode_barang += '-' + range_usia.kode.toString();
        //     }
        //     // WARNA EMAS
        //     warna_emas = dataWarnaEmas.find((element: any) => element.doc_id === item.warna_emas);
        //     if (typeof warna_emas !== 'undefined') {
        //         item.specs += ' ' + warna_emas.nama;
        //         item.kode_barang += '-' + warna_emas.kode.toString();
        //     }

        //     // MATA
        //     let nama_mata = '';
        //     if (item.mata !== null && item.mata.length !== 0) {
        //         item.kode_barang += '-';
        //         item.mata.forEach((element, index) => {
        //             if (index !== 0) {
        //                 item.kode_barang += '.';
        //             }

        //             let data_mata: any = 'not_found';
        //             dataMata.forEach((element: any) => {
        //                 // NN if -> NOT NECESSARY IF
        //                 if (item.mata !== null) {
        //                     if (element.doc_id === item.mata[index].warna) {
        //                         data_mata = element;
        //                     }
        //                 }
        //             });
        //             if (data_mata !== 'not_found') {
        //                 item.kode_barang += data_mata.kode.toString() + `_${element.jumlah}`;
        //                 nama_mata += data_mata.short + `${element.jumlah}`;
        //             } else {
        //                 item.kode_barang += `400_tmata_${index}`;
        //                 nama_mata += ' mERR';
        //             }
        //         });
        //     }
        //     if (nama_mata !== '') {
        //         item.nama += ' ' + nama_mata;
        //     }
        //     if (nama_mata === '' || item.mata === null || item.mata.length === 0) {
        //         item.kode_barang += '-0';
        //     }

        //     // MAINAN
        //     let nama_mainan = '';
        //     if (item.mainan !== null && item.mainan.length !== 0) {
        //         item.kode_barang += '-';
        //         item.mainan.forEach((element, index) => {
        //             if (index !== 0) {
        //                 item.kode_barang += '.';
        //             }

        //             let data_mainan: any = 'not_found';
        //             dataMainan.forEach((element: any) => {
        //                 if (item.mainan !== null) {
        //                     // if yang NN, tapi supaya ts tidak err
        //                     if (element.doc_id === item.mainan[index].tipe_mainan) {
        //                         data_mainan = element;
        //                     }
        //                 }
        //             });
        //             if (data_mainan !== 'not_found') {
        //                 item.kode_barang += data_mainan.kode.toString() + `_${element.jumlah}`;
        //                 nama_mainan += data_mainan.nama + `${element.jumlah}`;
        //             } else {
        //                 item.kode_barang += `400_tmainan_${index}`;
        //                 nama_mainan += ' maiERR';
        //             }
        //         });
        //     }
        //     if (nama_mainan !== '') {
        //         item.nama += ' ' + nama_mainan;
        //     }
        //     if (nama_mainan === '' || item.mainan === null || item.mainan.length === 0) {
        //         item.kode_barang += '-0';
        //     }

        //     // PLAT
        //     let nama_plat = '';
        //     if (item.plat !== null) {
        //         nama_plat += `pl${item.plat}`;
        //     } else {
        //         item.kode_barang += '-0';
        //     }
        //     if (nama_plat !== '') {
        //         item.nama += ' ' + nama_plat;
        //         item.kode_barang += `-${item.plat}`;
        //     }

        //     // KADAR
        //     if (item.kadar !== null) {
        //         item.nama += ' ' + item.kadar.toString() + '%';
        //         item.kode_barang += '-' + item.kadar.toString();
        //     } else {
        //         item.kode_barang += '-0';
        //     }
        //     // BERAT
        //     if (item.berat !== null) {
        //         item.nama += ' ' + item.berat.toString() + 'g';
        //         item.kode_barang += '-' + item.berat.toString();
        //     } else {
        //         item.kode_barang += '-0';
        //     }

        //     // NAMPAN
        //     if (item.nampan !== null) {
        //         if (item.nampan !== '') {
        //             nampan = dataNampan.find((element: any) => element.doc_id === item.nampan);
        //             if (typeof nampan !== 'undefined') {
        //                 item.specs += ' ' + nampan.doc_id;
        //                 item.kode_barang += '-' + nampan.kode.toString();
        //             } else {
        //                 item.specs += ' n.err';
        //                 item.kode_barang += '-400';
        //             }
        //         } else {
        //             item.kode_barang += '-0';
        //         }
        //     } else {
        //         item.kode_barang += '-0';
        //     }
        //     // UKURAN
        //     if (item.ukuran !== null) {
        //         const string_ukuran = item.ukuran.toString();
        //         for (let i = 0; i < string_ukuran.length; i++) {
        //             ukuran = dataUkuran.find((element: any) => element.ukuran === parseInt(string_ukuran[i]));
        //             if (typeof ukuran !== 'undefined') {
        //                 if (i === 0) {
        //                     item.specs += ' uk.' + ukuran.doc_id;
        //                     item.kode_barang += '-' + ukuran.ukuran.toString();
        //                 } else {
        //                     item.specs += ukuran.doc_id;
        //                     item.kode_barang += ukuran.ukuran.toString();
        //                 }
        //             }
        //         }
        //     } else {
        //         item.kode_barang += '-0';
        //     }
        //     // CAP
        //     if (item.cap !== null) {
        //         if (item.cap !== '') {
        //             cap = dataCap.find((element: any) => element.doc_id === item.cap);
        //             if (typeof cap !== 'undefined') {
        //                 item.specs += ' ' + cap.nama;
        //                 item.kode_barang += '-' + cap.kode.toString();
        //             } else {
        //                 item.specs += ' c.err';
        //                 item.kode_barang += '-400';
        //             }
        //         } else {
        //             item.kode_barang += '-0';
        //         }
        //     } else {
        //         item.kode_barang += '-0';
        //     }

        //     // if (item.nampan!==null && item.nampan !=='') {
        //     // 	item.specs += ' ' + item.nampan;
        //     // }
        //     // console.log(item.nama);
        //     // console.log(item.kode_barang);
        // }

        // return item;
    }
</script>
