<div class="isi_berita">
	<h1>
		<?= strtoupper($list_berita->judul_berita) ?> <br />
		<small>
			<?= $list_berita->waktu_post ?> | <?= $list_berita->nama_kategori ?>
		</small>
	</h1>
	<p>
		<?= $list_berita->isi_berita; ?>
	</p>
</div>
