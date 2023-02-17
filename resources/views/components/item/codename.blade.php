<div class="mt-1 border rounded p-1">
    <table>
        <tr>
            <th>Nama</th><th>:</th>
            <td id="td_nama_item">{{ old('nama') }}</td>
        </tr>
        <tr>
            <th>Specs</th><th>:</th>
            <td id="td_specs">{{ old('specs') }}</td>
        </tr>
        <tr>
            <th>KodeBrg</th><th>:</th>
            <td id="td_kode_item">{{ old('kode_item') }}</td>
        </tr>
    </table>
    <input type="hidden" name="nama" id="nama_item" value="{{ old('nama') }}" readonly>
    <input type="hidden" name="specs" id="specs" value={{ old('specs') }} readonly>
    <input type="hidden" name="kode_item" id="kode_item" value="{{ old('kode_item') }}" readonly>
</div>
<script>
    const antings = {!! json_encode($antings,JSON_HEX_TAG) !!};
    const giwangs = {!! json_encode($giwangs,JSON_HEX_TAG) !!};
    const cincins = {!! json_encode($cincins,JSON_HEX_TAG) !!};
    const kalungs = {!! json_encode($kalungs,JSON_HEX_TAG) !!};
    const gelangrantais = {!! json_encode($gelangrantais,JSON_HEX_TAG) !!};
    const gelangbulats = {!! json_encode($gelangbulats,JSON_HEX_TAG) !!};
    const liontins = {!! json_encode($liontins,JSON_HEX_TAG) !!};
    const tipeperhiasans = {!! json_encode($tipeperhiasans,JSON_HEX_TAG) !!};
    const kodetipeperhiasans = {!! json_encode($kodetipeperhiasans,JSON_HEX_TAG) !!};
    const nomortipeperhiasans = {!! json_encode($nomortipeperhiasans,JSON_HEX_TAG) !!};
    const jenisperhiasans = {!! json_encode($jenisperhiasans,JSON_HEX_TAG) !!};

    let arr_warna_emas=[];
    let arr_warna_emas_id=[];
    let arr_tipe_barang=[];
    let arr_tipe_barang_id=[];
    let arr_range_usia=[];
    let arr_range_usia_id=[];
    let arr_mata=[];
    let arr_mata_id=[];
    let arr_mata_codename=[];
    let arr_mainan=[];
    let arr_mainan_id=[];
    let arr_mainan_codename=[];
    let arr_ukuran_id=[];
    let arr_ukuran_codename=[];
    let arr_cap=[];
    let arr_cap_id=[];
    let arr_cap_codename=[];
    let arr_kondisi=[];
    let arr_kondisi_id=[];
    let arr_kondisi_codename=[];
    let arr_kadar=[];
    let arr_kadar_id=[];
    let arr_kadar_codename=[];
    let arr_nampan_id=[];
    let arr_nampan_codename=[];
    setTimeout(() => {
        const ds_tipe_barang=specs.filter((element)=>element.kategori==='tipe_barang');
        // console.log(ds_tipe_barang);
        ds_tipe_barang.forEach(element => {
            arr_tipe_barang.push(element.nama);
            arr_tipe_barang_id.push(element.name_id);
        });
        // console.log(arr_tipe_barang,arr_tipe_barang_id);
        const data_warna_emass=specs.filter((element)=>element.kategori==='warna_emas');
        // console.log(data_warna_emass);
        data_warna_emass.forEach(element => {
            arr_warna_emas.push(element.nama);
            arr_warna_emas_id.push(element.name_id);
        });
        // console.log(arr_warna_emas,arr_warna_emas_id);
        const ds_range_usia=specs.filter((element)=>element.kategori==='range_usia');
        ds_range_usia.forEach(element => {
            arr_range_usia.push(element.nama);
            arr_range_usia_id.push(element.name_id);
        });
        // console.log(arr_range_usia,arr_range_usia_id);
        const ds_mata=specs.filter((element)=>element.kategori==='mata');
        ds_mata.forEach(element => {
            arr_mata.push(element.nama);
            arr_mata_id.push(element.name_id);
            arr_mata_codename.push(element.codename);
        });
        // console.log(arr_mata,arr_mata_codename);
        const ds_mainan=specs.filter((element)=>element.kategori==='mainan');
        ds_mainan.forEach(element => {
            arr_mainan.push(element.nama);
            arr_mainan_id.push(element.name_id);
            arr_mainan_codename.push(element.codename);
        });
        // console.log(arr_mainan,arr_mainan_codename);
        const ds_ukuran=specs.filter((element)=>element.kategori==='ukuran');
        ds_ukuran.forEach(element => {
            arr_ukuran_id.push(element.name_id);
            arr_ukuran_codename.push(element.codename);
        });
        // console.log(arr_ukuran_id,arr_ukuran_codename);
        const ds_cap=specs.filter((element)=>element.kategori==='cap');
        ds_cap.forEach(element => {
            arr_cap.push(element.nama);
            arr_cap_id.push(element.name_id);
            arr_cap_codename.push(element.codename);
        });
        // console.log(arr_cap,arr_cap_id,arr_cap_codename);
        const ds_kondisi=specs.filter((element)=>element.kategori==='kondisi');
        ds_kondisi.forEach(element => {
            arr_kondisi.push(element.nama);
            arr_kondisi_id.push(element.name_id);
            arr_kondisi_codename.push(element.codename);
        });
        // console.log(arr_kondisi,arr_kondisi_id,arr_kondisi_codename);
        const ds_kadar=specs.filter((element)=>element.kategori==='kadar');
        ds_kadar.forEach(element => {
            arr_kadar.push(element.nama);
            arr_kadar_id.push(element.name_id);
            arr_kadar_codename.push(element.codename);
        });
        // console.log(arr_kadar,arr_kadar_id,arr_kadar_codename);
        const ds_nampan=specs.filter((element)=>element.kategori==='nampan');
        ds_nampan.forEach(element => {
            arr_nampan_id.push(element.name_id);
            arr_nampan_codename.push(element.codename);
        });
        // console.log(arr_nampan_id,arr_nampan_codename);

    }, 1000);

    function generateNama() {
        // console.log(specs);
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
        const input_ukuran = document.getElementById('input-ukuran');

        const el_nama_item = document.getElementById('nama_item');
        const td_nama_item = document.getElementById('td_nama_item');
        const el_specs = document.getElementById('specs');
        const td_specs = document.getElementById('td_specs');
        const el_kode_item = document.getElementById('kode_item');
        const td_kode_item = document.getElementById('td_kode_item');

        const warna_matas = document.querySelectorAll('.warna_mata');
        const jumlah_matas = document.querySelectorAll('.jumlah_mata');

        const kadar = document.getElementById('kadar');
        const gol_kadar = document.getElementById('gol_kadar');
        const berat = document.getElementById('berat');
        const cap = document.getElementById('input-cap');
        const kondisi = document.getElementById('kondisi');

        // 1 - Tipe Barang
        let n_tipe_barang;
        let c_tipe_barang;
        if (tipe_barang.value==='Perhiasan') {
            c_tipe_barang='7';
            n_tipe_barang='';
        } else if (tipe_barang === 'LM') {
            c_tipe_barang='8';
            n_tipe_barang=' LM';
        } else {
            n_tipe_barang='tb.ERR';
            c_tipe_barang='400';
        }

        // 2 - Tipe Perhiasan
        let n_tipe_perhiasan;
        let c_tipe_perhiasan;
        if(kodetipeperhiasans.includes(tipe_perhiasan.value)){
            c_tipe_perhiasan=`${nomortipeperhiasans[kodetipeperhiasans.indexOf(tipe_perhiasan.value)]}`;
            n_tipe_perhiasan=tipe_perhiasan.value;
        } else {
            n_tipe_perhiasan=' tp.ERR';
            c_tipe_perhiasan='400';
        }

        // 3 - Range Usia
        let n_range_usia;
        let c_range_usia;
        if (arr_range_usia.includes(range_usia.value)) {
            n_range_usia = `ru.${range_usia.value}`;
            c_range_usia =`-${arr_range_usia_id[arr_range_usia.indexOf(range_usia.value)]}`;
        } else {
            n_range_usia = 'ru.ERR';
            c_range_usia = '-400';
        }

        // 4 - Jenis Perhiasan
        // console.log(jenisperhiasans);
        let n_jenis_perhiasan;
        let c_jenis_perhiasan;
        if (kodetipeperhiasans.includes(tipe_perhiasan.value)) {
            let list_jenis_perhiasan_d_tipe_perhiasan = jenisperhiasans.filter((element)=>element.kode_tipe===tipe_perhiasan.value);
            // console.log(list_jenis_perhiasan_d_tipe_perhiasan);
            let arr_jenis_perhiasan=[];
            list_jenis_perhiasan_d_tipe_perhiasan.forEach(element => {
                arr_jenis_perhiasan.push(element.nama);
            });
            if (arr_jenis_perhiasan.includes(jenis_perhiasan.value)) {
                n_jenis_perhiasan=` ${jenis_perhiasan.value}`;
                c_jenis_perhiasan=`${list_jenis_perhiasan_d_tipe_perhiasan[arr_jenis_perhiasan.indexOf(jenis_perhiasan.value)].name_id}`;
            } else {
                n_jenis_perhiasan = ' j.ERR';
                c_jenis_perhiasan = '400';
            }
        } else {
            n_jenis_perhiasan = ' j.ERR';
            c_jenis_perhiasan = '400';
        }

        // 5 - Warna Emas
        let n_warna_emas;
        let c_warna_emas;
        if (arr_warna_emas.includes(warna_emas.value)) {
            n_warna_emas = ` we.${warna_emas.value}`;
            c_warna_emas =`-${arr_warna_emas_id[arr_warna_emas.indexOf(warna_emas.value)]}`;
        } else {
            n_warna_emas = ' we.ERR';
            c_warna_emas = '-400';
        }

        // 6 - Mata


        let n_mata='';
        let s_mata='';
        let c_mata='';
        if (warna_matas.length!==0) {
            warna_matas.forEach((wama,i) => {
                if (arr_mata.includes(wama.value)) {
                    n_mata += ` ${arr_mata_codename[arr_mata.indexOf(wama.value)]}-${jumlah_matas[i].value}`;
                    c_mata +=`-${arr_mata_id[arr_mata.indexOf(wama.value)]}_${jumlah_matas[i].value}`;
                } else {
                    n_mata += ' m.ERR';
                    c_mata += '-400';
                }
            });
        } else {
            n_mata='';
            s_mata=' m.0';
            c_mata='-0';
        }

        // 7 - Mainan

        const mainans = document.querySelectorAll('.mainan');
        const jumlah_mainans = document.querySelectorAll('.jumlah_mainan');

        let n_mainan='';
        let s_mainan='';
        let c_mainan='';
        if (mainans.length!==0) {
            mainans.forEach((wama,i) => {
                if (arr_mainan.includes(wama.value)) {
                    n_mainan += ` ${arr_mainan_codename[arr_mainan.indexOf(wama.value)]}-${jumlah_mainans[i].value}`;
                    c_mainan +=`-${arr_mainan_id[arr_mainan.indexOf(wama.value)]}_${jumlah_mainans[i].value}`;
                } else {
                    n_mainan += ' mai.ERR';
                    c_mainan += '-400';
                }
            });
        } else {
            n_mainan='';
            s_mainan=' mai.0';
            c_mainan='-0';
        }

        // 8 - Plat
        const plat = document.getElementById('input-plat-0');
        let n_plat;
        let s_plat;
        let c_plat;
        if (plat!==null) {
            if (plat.value!==0) {
                n_plat=` pl.${plat.value}`;
                s_plat='';
                c_plat=`-${plat.value}`;
            } else {
                n_plat=' pl.ERR';
                s_plat=' pl.ERR';
                c_plat=`-400`;
            }
        } else {
            n_plat='';
            s_plat=' pl.0';
            c_plat='-0';
        }

        // 8 - Ukuran
        const ukuran = document.getElementById('input-ukuran');
        let n_ukuran;
        let s_ukuran;
        let c_ukuran;
        if (ukuran!==null) {
            let str_uk_value = ukuran.value.toString();
            console.log(str_uk_value);
            console.log(str_uk_value[0]);
            let s_uk='';
            for (let i = 0; i < str_uk_value.length; i++) {
                if (arr_ukuran_id.includes(parseInt(str_uk_value[i]))) {
                    s_uk+=arr_ukuran_codename[arr_ukuran_id.indexOf(parseInt(str_uk_value[i]))];
                } else {
                    s_uk+='ERR';
                }
            }
            n_ukuran='';
            s_ukuran=` uk.${s_uk}`;
            c_ukuran=`-${ukuran.value}`;
        } else {
            n_ukuran='';
            s_ukuran=' uk.0';
            c_ukuran='-0';
        }

        // 9 - Kadar
        let n_kadar;
        let s_kadar;
        let c_kadar;
        if (kadar===null || kadar.value==='') {
            n_kadar=' ERR%';
            s_kadar='';
            c_kadar='-400';
        } else {
            if (arr_kadar.includes(kadar.value)) {
                n_kadar=` ${arr_kadar[arr_kadar.indexOf(kadar.value)]}%`;
                s_kadar='';
                c_kadar=`-${arr_kadar[arr_kadar.indexOf(kadar.value)]}`;
            } else {
                n_kadar=' ERR%';
                s_kadar='';
                c_kadar='-400';
            }
        }
        // 10 - GOL. KADAR
        let gol_kadar_value;
        if (kadar.value < 70) {
            gol_kadar_value = 'MUDA';
        } else if (kadar.value < 90) {
            gol_kadar_value = 'BAGUS';
        } else if (kadar.value <= 100) {
            gol_kadar_value = 'TUA';
        }
        gol_kadar.value=gol_kadar_value;
        // console.log(gol_kadar.value);

        // 11 - Berat
        let n_berat;
        let s_berat;
        let c_berat;
        if (berat===null || berat.value==='' || berat.value == 0) {
            n_berat=' ERRg';
            s_berat='';
            c_berat='-400';
        } else {
            n_berat=` ${berat.value}g`;
            s_berat='';
            c_berat=`-${berat.value}`;
        }

        // 12 - Cap
        let s_cap;
        let c_cap;
        if (cap.value!=='') {
            if (arr_cap.includes(cap.value)) {
                s_cap = ` ${arr_cap_codename[arr_cap.indexOf(cap.value)]}`;
                c_cap =`-${arr_cap_id[arr_cap.indexOf(cap.value)]}`;
            } else {
                s_cap = ' c.ERR';
                c_cap = '-400';
            }
        } else {
            s_cap = ' c.-';
            c_cap = '-0';
        }

        // 13 - Kondisi
        let s_kondisi;
        let c_kondisi;
        if (kondisi.value!=='') {
            if (arr_kondisi.includes(kondisi.value)) {
                s_kondisi = ` ${arr_kondisi_codename[arr_kondisi.indexOf(kondisi.value)]}`;
                c_kondisi =`-${arr_kondisi_id[arr_kondisi.indexOf(kondisi.value)]}`;
            } else {
                s_kondisi = ' k.ERR';
                c_kondisi = '-400';
            }
        } else {
            s_kondisi = ' k.-';
            c_kondisi = '-0';
        }

        // 14 - NAMPAN
        let s_nampan;
        let c_nampan;
        if (nampan.value!=='') {
            if (arr_nampan_codename.includes(nampan.value)) {
                s_nampan = ` ${arr_nampan_codename[arr_nampan_codename.indexOf(nampan.value)]}`;
                c_nampan =`-${arr_nampan_id[arr_nampan_codename.indexOf(nampan.value)]}`;
            } else {
                s_nampan = ' n.ERR';
                c_nampan = '-400';
            }
        } else {
            s_nampan = ' n.-';
            c_nampan = '-0';
        }

        // PENETAPAN NAMA + CODE
        let nama_item=n_tipe_barang+n_tipe_perhiasan+n_jenis_perhiasan+n_mata+n_mainan+n_plat+n_ukuran+n_kadar+n_berat;
        let specs_item=n_range_usia+n_warna_emas+s_mata+s_mainan+s_plat+s_ukuran+s_kadar+s_berat+s_cap+s_kondisi+s_nampan;
        let codename_item=c_tipe_barang+c_tipe_perhiasan+c_jenis_perhiasan+c_range_usia+c_warna_emas+c_mata+c_mainan+c_plat+c_ukuran+c_kadar+c_berat+c_cap+c_kondisi+c_nampan;

        // console.log(tipeperhiasans)
        el_nama_item.value=nama_item;
        td_nama_item.textContent=nama_item;
        el_specs.value=specs_item;
        td_specs.textContent=specs_item;
        el_kode_item.value=codename_item;
        td_kode_item.textContent=codename_item;

    }
</script>
