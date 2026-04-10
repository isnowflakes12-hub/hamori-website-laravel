@extends('layouts.app')
@section('title', 'Privacy Policy')
@section('content')
<div class="page-header"><div class="container"><h1 class="page-title">Privacy Policy</h1></div></div>
<section class="py-5"><div class="container" style="max-width:800px">
<div class="bg-white rounded-3 p-4 p-md-5 shadow-sm">
<h4>1. Pengumpulan Informasi</h4>
<p>RS Hamori mengumpulkan informasi yang Anda berikan secara langsung, seperti nama, email, nomor telepon, dan informasi kesehatan saat Anda menggunakan layanan kami.</p>
<h4>2. Penggunaan Informasi</h4>
<p>Informasi yang dikumpulkan digunakan untuk memberikan layanan kesehatan, menghubungi Anda terkait appointment, dan meningkatkan kualitas layanan kami.</p>
<h4>3. Keamanan Data</h4>
<p>Kami berkomitmen untuk melindungi informasi pribadi Anda dengan menggunakan enkripsi dan prosedur keamanan standar industri.</p>
<h4>4. Berbagi Informasi</h4>
<p>Kami tidak akan menjual, memperdagangkan, atau mentransfer informasi pribadi Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali untuk keperluan layanan medis.</p>
<h4>5. Kontak</h4>
<p>Jika Anda memiliki pertanyaan tentang kebijakan privasi ini, hubungi kami di <a href="{{ route('kontak') }}">halaman kontak</a>.</p>
</div>
</div></section>
@endsection
