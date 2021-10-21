<script src="<?php echo base_url(); ?>assets/preloader/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
        // pengerjaan data personal
        getData4();
        async function getData4(){
            let result1 = await fetch("http://192.168.4.25/entry/admin/laporan/kalkulasipersonal");
            let result  = await result1.json();
            var panjang = result.personal.length.toString();
            
            var pot_ontime = parseInt(result.potongan[0].rupiah_pot);
            var pot_hijau = parseInt(result.potongan[1].rupiah_pot);
            var pot_kuning = parseInt(result.potongan[2].rupiah_pot);
            var pot_merah = parseInt(result.potongan[3].rupiah_pot);
            var pot_ungu = parseInt(result.potongan[4].rupiah_pot);
            
            let datapengerjaan = "";
            for(var i=0; i<panjang; i++){
                // master 1
                totalpersonal = result.personal[i].total_personal;
                
                // master 2
                ontime = ( parseInt(result.personal[i].total_putih)*pot_ontime );
                hijau  = ( parseInt(result.personal[i].total_hijau)*pot_hijau );
                kuning = ( parseInt(result.personal[i].total_kuning)*pot_kuning );
                merah  = ( parseInt(result.personal[i].total_merah)*pot_merah );
                ungu   = ( parseInt(result.personal[i].total_ungu)*pot_ungu );
                total_telat = (hijau+kuning+merah+ungu);
                bonus  = ( ontime + total_telat);
                
                datapengerjaan += "<tr><td>"+result.personal[i].nama.toUpperCase()+" <small>("+result.personal[i].nama_divisi+")</small> "+"</td><td style='font-size: 15px;' class='text-center'>"+ontime+"</td><td style='font-size: 15px;' class='text-center'>"+hijau+"</td><td style='font-size: 15px;' class='text-center'>"+kuning+"</td><td style='font-size: 15px;' class='text-center'>"+merah+"</td><td style='font-size: 15px;' class='text-center'>"+ungu+"</td><td style='font-size: 15px; border-left: 1px solid #333; border-right: 1px solid #333;' class='text-center'><b>"+bonus+"</b></td></tr>";
            }
            document.getElementById("datapengerjaanrupiah").innerHTML = datapengerjaan;

            // datatable
            $('#pengerjaan').DataTable({
                paging: false,
                order: [[ 6, "desc" ]]
            });
        }
</script>
<table border="1px" id="pengerjaan">
    <thead>
        <tr>
            <th>Operator Produksi</th>
            <th class='text-center'>Point OnTime</th>
            <th class='text-center'>Point &#60;10Menit</th>
            <th class='text-center'>Point &#60;30Menit</th>
            <th class='text-center'>Point &#60;60Menit</th>
            <th class='text-center'>Point &#62;60Menit</th>
            <th class='text-center'>Selisih Point</th>
        </tr>
    </thead>
    <tbody id="datapengerjaanrupiah"></tbody>
</table>