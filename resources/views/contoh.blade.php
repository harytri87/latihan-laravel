<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>

	{{-- Cara PHP echo --}}
	Contoh 1:
	<br />

	@php
		$str = "This is <b>bold</b> <br> garis baru \r\n lagi";
		echo $str;
	@endphp
	<br />
	<br />
	<br />

	{{-- Cara Laravel buat echo dengan escape string biar ga jadi element html --}}
	Contoh 2:
	<br />
	 {{ $str }}

	<br />
	<br />
	<br />

	{{-- Cara Laravel buat echo tanpa escape --}}
	Contoh 3:
	<br />
	 {!! $str !!}

	<br />
	<br />
	<br />

	{{-- Fungsi htmlspecialchars() itu bawaan dari PHP murni buat escape string --}}
	Contoh 4:
	<br />
	 {!! htmlspecialchars($str) !!}

	<br />
	<br />
	<br />

	{{-- Fungsi e() itu dari Laravel, cuma mendekin nama fungsi PHP di atas --}}
	Contoh 5:
	<br />
	 {!! (e($str)) !!}
	 
	<br />
	<br />
	<br />

	{{-- Fungsi nl2br() itu dari PHP murni, new line to break, \r atau \n atau \r\n bakal jadi <br> --}}
	Contoh 6:
	<br />
	 {!! nl2br((e($str))) !!}
	 
	<br />
	<br />
	<br />
	
	Contoh 7:
	<br />
	@php
		echo nl2br($str);
	@endphp

</body>
</html>