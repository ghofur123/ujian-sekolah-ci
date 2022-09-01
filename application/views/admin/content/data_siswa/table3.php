<script type="text/javasicript">
</script>
<style>
	.body-class-11 {
		border:1px solid #000;
		padding:3px;
		width:180px;
		float:left;
		height:260px;
		margin:10px 10px 24px 10px;
		background: rgb(34,193,195);
		background: radial-gradient(circle, rgba(34,193,195,1) 0%, rgba(253,219,45,0.9164040616246498) 100%);
		border-radius: 10px 10px 10px 10px;
	}
	.clear-class {
		clear: both;
	}
	@font-face {
                font-family: code39;
                src: url('assets/barcode/Code39Azalea.ttf');
            }
    div{text-align: center}
	.title-name {
	}
	.span-name {
		width:30%;
		text-transform: lowercase;
	}
	.span-isi{
		width:68%;
		color:#fff;
	}
</style>
<?php foreach($tampilData as $item){ ?>
<div class='body-class-11'>
	<div class='header-class'>
		SMK Nurul Mannan
	</div>
	<img src="assets/image/default_user.jpg" style='width:50%; height:70px; position:center;'>
	<div class='content-class'>
		<div class="title-name">
			<span class="span-name">Nama</span>
			<span class="span-isi">
				<?php echo strtolower($item["nama_siswa"]); ?>
			</span>
		</div>
		<div class="title-name">
			<span class="span-name">NISN</span>
			<span class="span-isi">
				<?php echo strtolower($item["nisn"]); ?>
			</span>
		</div>
		<div class="title-name">
			<span class="span-name">NIK</span>
			<span class="span-isi">
				<?php echo strtolower($item["nik"]); ?>
			</span>
		</div>
		<div class="title-name">
			<span class="span-name">Kelas</span>
			<span class="span-isi">
				<?php echo strtolower($item["nama_kelas"]); ?>
			</span>
		</div>
		<div class="title-name">
			<div>
				<font face="code39" size="6em"><?php echo $item["nisn"]; ?></font>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<div class='clear-class'></div>