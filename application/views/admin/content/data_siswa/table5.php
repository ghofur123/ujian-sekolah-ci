<script type="text/javasicript">
</script>
<style>
	.body-class {
		border:1px solid #000;
		padding:3px;
		width:250px;
		height:300px;
		float:left;
		margin:10px 10px 24px 10px;
		background:#fff;
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
		width:100%;
		text-transform: lowercase;
	}
	.span-isi{
		width:68%;
	}
	.content-class{
		border:1px solid #000;
	}
</style>
<?php foreach($tampilData as $item){ ?>
<div class='body-class'>
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
			<div>
				<font face="code39" size="10em" style="height:100px; width:200px;"><?php echo $item["nisn"]; ?></font>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<div class='clear-class'></div>