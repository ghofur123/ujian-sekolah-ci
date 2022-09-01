
	<table class="table">
		<thead>
		  <tr>
			<th>No</th><th>nama siswa</th><th>nisn</th><th>ttd</th>
		  </tr>
		</thead>
		<tbody>
			
			<?php 
			$no=0;
			foreach($tampilData as $item){ 
			$no++;
			?>
			<tr>
				<td><?php echo $no; ?></td>
				<td>
				<?php echo "$item[nama_siswa]"; ?>
				</td>
				<td>
				<?php echo "$item[nisn]"; ?>
				</td>
				<td>..............................
				</td>
			</tr>
			<?php } ?>
		</tbody>
	  </table>
		