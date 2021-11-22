// Tambah detail

document.getElementById("btnTambah").onclick = function() {
    /** @var barang HTMLElement */
    barang = document.querySelector("#selectBarang option:checked");
    nama = barang.innerText;
    id = barang.attributes.getNamedItem("value").value;
    console.log(barang.value);
    // Harga Barang
    harga = barang.attributes.getNamedItem("harga").value;
    tabel = document.getElementById("tableDetail");
    newRow = document.createElement("tr");
    newRow.innerHTML = "<td>"+id
        +"<input type=hidden name='id[]' value='"+ id +"'</td>"
        +"<td>"+nama+"</td>"
        +"<td><input type=number class='jumlah' name='jumlah[]' min=1 required></td>"
        +"<td>"+harga+" <input type=hidden name='harga[]' value='"+harga+"'></td>"
        +"<td class='txtTotal'>0</td>"
        +"<td><button type=button class=btnDel>X</button></td>";
    tabel.append(newRow);

    jumlahs = document.getElementsByClassName("jumlah");
    for (let i = 0; i < jumlahs.length; i++) {
        const el = jumlahs[i];
        el.onchange = function (e) {
            var harga = e.target.parentElement.parentElement
            .childNodes[3].innerText;
            let total = e.target.parentElement.parentElement.childNodes[4];
            total.innerText = parseInt(harga) * el.value;
            // Itterate Jumlah - Recalculate!
            var totalAkhir = 0;
            for (let j = 0; j < jumlahs.length; j++) {
                const ej = jumlahs[j];
                console.log(ej.parentNode.parentNode
                    .childNodes[3]);
                let harga = ej.parentNode.parentNode
                        .childNodes[3].innerText;
                totalAkhir += ej.value * harga;
            }

            // Check Potongan
            var potongan = null;
            var voucher = document.querySelector("#voucher option:checked");

            if (voucher.attributes.getNamedItem("jumlah").value == "2") {
                potongan = parseInt(voucher.attributes.getNamedItem("jumlah").value);
            } else {
                potongan = parseInt(voucher.attributes.getNamedItem("jumlah").value)/100 * totalAkhir;
            }
            potongan = isNaN(potongan) ? 0 : potongan;
            document.getElementById("txtDiskon").innerHTML = potongan
                + "<input type=hidden name='potongan' value='"+potongan+"'>";
            // End Check Potongan
            totalAkhir = totalAkhir - potongan;
            console.log("======================");
            document.getElementById("txtTotal").innerHTML = totalAkhir
                + "<input type=hidden name='total' value='"+totalAkhir+"'>";
        }
    }

    document.getElementById("voucher").onchange = function() {
        document.querySelector(".jumlah")
            .dispatchEvent(new Event("change"));
    }
};

// document.getElementById("asd").attributes.getNamedItem("").value
