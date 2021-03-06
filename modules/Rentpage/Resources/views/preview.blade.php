@extends('page_template')
@section('content')
    @parent
<?php
 function dateFormat($tanggal)
{
    $month=["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus", "September","Oktober","Nopember","Desember"];
    $bulan=substr($tanggal, 4,2);
    $tanggal=substr($tanggal, 0,2)." ".$month[$bulan-1]." ".substr($tanggal, 6,4);
    return $tanggal;
};?>
   <div class="row">
<?php
$day=["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"]
?>
            <!-- SLIDER -->
            <div class="row">
                <div class="col-md-12 slider"></div>
            </div>            
            <!-- SLIDER CLOSE -->
	        <div class="row">
                <div class="col-md-12 content_">
                    <div class="row head_table">
                        <div class="col-md-4" style="padding-top: 0px"><h4><b>PROSES PEMESANAN</b><h4></div>
                        <div class="col-md-8" style="padding: 0;">
                             <p style="float: right;padding-top: 10px; margin-right: 10px;"> Travel | {{Session::get('DATA_RENT')['CITY_NAME']}}  | <?php  echo dateFormat(date('d-m-Y', strtotime(Session::get('DATA_RENT')['RENT_SCHEDULE_DATE'])))?></p>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 5px; height: 50px;">
                        <div class="kotak_step_travel">
                            <div class="step">
                                <h4>Isi Data<h4>
                            </div>
                        </div>
                        <div class="kotak_step_travel">
                            <div class="step_selected">
                                <h4>Review<h4>
                            </div>
                        </div>
                        <div class="kotak_step_travel">
                            <div class="step">
                                <h4>Pembayaran<h4>
                            </div>
                        </div>
                        <div class="kotak_step_travel">
                            <div class="step">
                                <h4>Konfirmasi<h4>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top:50px">
                        <!-- Info No.Pesanan Pojok Kiri Atas -->
                        <div class="col-md-4 remove_padding"  style="background-color:#eee;border: 1px solid #ddd; border-left: 4px solid #00cd00; width:320px">
                            <div class="tulisan_no_pesanan" style="padding-left:10px; padding-top:10px">
                                <p>No. Pesanan</p>
                            </div>
                            <div class="no_pesanan" style="margin-left:220px; margin-top:-28px;height:35px">
                                <p><b>{{Session::get('NO_PEMESANAN')}}</b></p>
                            </div>
                        </div>
                     </div>

                     <!-- Info Lanjut Ke Pembayaran -->
                    <div class="row">
                    </div>

                    <!-- Info Penting -->
                    <div class="row">
                        <div class="col-md-4 remove padding" style ="background-color:#5a5a5a; margin-top:15px; color:#fff; width:320px">
                            <div class="logo_penting col-md-2" style="padding-top:15px">
                                <img src="<?php echo url('assets/images/logo_info.png')?>">
                            </div>
                            <div class="tulisan_penting" style="margin-left:30px; margin-top:10px">
                                <h3>Penting</h3>
                            </div>
                            <div class="desc_penting">
                                <p>Mobil bisa dipinjam mulai dari pukul 00:00 hari tersebut dan harus dikembalikan sebelum 23:59 di hari tersebut</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notes_Harga -->
                    <div class="row">
                        <div class="col-md-4 remove_padding" style="background-color:#fff; border: 1px solid #ddd; border-left: 4px solid #00cd00;margin-top: 10px; width:320px">
                            <div class="notes_harga" style="padding:10px">
                                <p>Harga di samping telah final dan dikonfirmasi oleh pihak rental. Potongan dari kupon promo dapat digunakan di halaman pemesanan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notes_Harga -->
                    <div class="row">
                        <div class="col-md-4 remove_padding" style="background-color:#fff;border: 1px solid #ddd; border-left: 4px solid #00cd00; margin-top: 10px; width:320px">
                            <div class="notes_mata_uang" style="padding:10px">
                                <p>Anda akan membayar dalam mata uang yang Anda pilih: <b>IDR</b></p>
                            </div>
                        </div>
                    </div>

                     <div class="row" style="">
                        <!-- Rincian Travel-->
                        <div class="col-md-8" style="padding-left:30px; margin-top:-355px; margin-left:325px;">
                            <div class="tulisan_rincian_penerbangan">
                                <h2>Rincian Mobil</h2>
                            </div>
                            <!-- Kotak Data Rincian Penerbangan -->
                            <div class="row box_rincian_penerbangan" style="background-color:#fff;border: 1px solid #ddd; border-left: 4px solid #00cd00; padding:20px">
                            	<div class="row col-md-8">
                            		
                            	
                                <!-- Kotak_1 -->
	                                <div class="box_tanggal_rincian_penerbangan" style="background-color:#eee;border: 1px solid #ddd; border-left: 4px solid #00cd00; width:320px; margin-bottom:10px">
	                                    <div class="tulisan_tanggal_rincian_penerbangan" style="padding:10px">
	                                        Tanggal Penyewaaan :
	                                        <p><b> <?php echo $day[date('N',strtotime('D', strtotime(Session::get('DATA_RENT')['RENT_SCHEDULE_DATE'])))-1]; echo ", ".dateFormat(date('d-m-Y', strtotime(Session::get('DATA_RENT')['RENT_SCHEDULE_DATE'])))?></b></p>
	                                    </div>
                                        <div class="tulisan_tanggal_rincian_penerbangan" style="padding:10px">
                                            Lama Penyewaaan :
                                            <p><b> {{Session::get('duration')}} Hari</b></p>
                                        </div>
	                                </div>
	                                <!-- Penerbangan_1 -->
	                                <div class="rincian_penerbangan_1">
	                                    <div class="logo_jangkauan">
	                                        <img src="<?php echo url('assets/images/gambar_jangkauan.png')?>">
	                                    </div>
	                                    <div class="konten_rincian_penerbangan_1" style="margin-left:25px; margin-top:-85px; margin-bottom:10px">
	                                        <table class="baris_rincian_penerbangan_1">
	                                            <tbody>
	                                                <tr>
	                                                    <td class="kota_asal_1" >
	                                                        <b>{{Session::get('DATA_RENT')['VEHICLE_NAME']}}</b>
	                                                    </td>
	                                                </tr>
	                                                <tr>
	                                                    <td class="box_logo_penerbangan_asal">
	                                                        <div class="logo_penerbangan_asal">
	                                                            <img src="<?php echo url('public\Assets\vehiclePhoto/'.Session::get('DATA_RENT')['VEHICLE_PHOTO'].'')?>" width=90 height=52>
	                                                        </div>
	                                                    </td>
	                                                </tr>
	                                                <tr>
	                                                    <td class="waktu_penerbangan_tujuan_1">
	                                                        <div class="tulisan_waktu_tujuan_1">
	                                                            <b> {{Session::get('DATA_RENT')['VEHICLE_TYPE']}} </b>
	                                                        </div>
	                                                    </td>
	                                                </tr>
	                                                <tr>
	                                                    <td class="kota_tujuan_1">
	                                                        <b>{{Session::get('DATA_RENT')['ROUTE_DEST']}}</b>
	                                                    </td>
	                                                </tr>
	                                            </tbody>
	                                        </table>
	                                    </div>
	                                </div>
	                            </div>
	                            <!--Data Penumpang-->
	                            <div class="row col-md-5">
	                            	<table>
	                            		<tr>
	                            			<td>Nama Penumpang</td>
	                            			<td>:</td>
	                            			<td>{{Session::get('DATA_COSTUMER')['COSTUMER_NAME']}}</td>
	                            		</tr>
	                            		<tr>
	                            			<td>No Telepon</td>
	                            			<td>:</td>
	                            			<td>{{Session::get('DATA_COSTUMER')['nohp_prefix']}}{{Session::get('DATA_COSTUMER')['COSTUMER_TELP']}}</td>
	                            		</tr>
	                            	</table>
	                            </div>
	                                <!-- Keterangan Waktu --><!-- 
	                            <div class="row keterangan_waktu col-md-12" style="margin-left:20px; color:#bbb">
		                                <p>Semua waktu adalah waktu tempat berangkat travel</p>
		                          </div>
	                                 -->

                                <!-- Untuk Travel -->
                                <div class="box_rincian_travel">
                                    <div="">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- Rincian Harga Total -->
                        <div class="col-md-4 remove_padding"  style="background-color:#eee; margin-top: 0px; margin-left: 340px; margin-bottom:10px; width:580px">
                            <div class="tulisan_rincian_harga" style="text-align:center"><h3>Rincian Harga<h3>
                            </div>
                            <div class="rincian_harga col-md-4" style=" width:28%;padding-left:10px">
                                <div class="rincian_harga_1_a">
                                    <p><b>{{Session::get('DATA_RENT')['VEHICLE_NAME']}}</b> x {{Session::get('duration')}} Hari</p>
                                </div>
                                <div class="rincian_harga_2_a">
                                    <p>Biaya Tambahan 1</p>
                                </div>
                                <div class="rincian_harga_3" style="color:#00b400">
                                    <p>Convenience Fee</p>
                                </div>
                                <div class="pembatas_rincian_harga">
                                </div>
                                <div class="rincian_harga_4">
                                    <p>Total:</p>
                                </div>

                            </div>
                            <div class="daftar_harga_total col-md-3" style="width:25%;  border-right: 2px dashed #bbb; ">
                                <div class="harga_1_a">
                                    <span style="float:left">Rp</span><p><b>{{Session::get('DATA_RENT')['RENT_SCHEDULE_PRICE']}}</b></p>
                                </div>
                                <div class="harga_2_a">
                                    <span style="float:left">Rp</span><p><b>0</b></p>
                                </div>
                                <div class="harga_3" style="color:#00b400">
                                    <span style="float:left">Rp</span><p><b>-321</b></p>
                                </div>
                                <div class="harga_4" style="font-size:16px">
                                    <span style="float:left"><b>Rp</b></span><p><b>{{Session::get('DATA_RENT')['RENT_SCHEDULE_PRICE']*Session::get('duration')}}</b></p>
                                </div>
                            </div>
                            <!-- Tulisan Lanjut Ke Pembayaran -->
                            <div class="col-md-4 remove padding" style ="background-color:#eee; float:right; width:270px">
                            <!-- <div class="tulisan_lanjut" style="margin-top: -10px; margin-bottom:15px; ,margin-left:-5px">
                                <h3>Lanjut Ke Pembayaran</h3>
                            </div> -->
                            <div class="desc_lanjut" style="margin-bottom:15px">
                                <p>Dengan mengklik tombol di bawah, Anda menyetujui <u>Syarat & Ketentuan</u> dan <u>Kebijakan Privasi</u> Traveloka</p>
                            </div>
                            <div class="logo_lanjut" style="margin-bottom:15px">
                                <input type="image" value="submit "src="<?php echo url('assets/images/lanjut_ke_pembayaran.png')?>">
                            </div>
                        </div>
                        </div>
                    </div>
	@stop