<x-mail::message>
## Akun Blogmu Telah Dihapus

Akunmu di website **{{ config('app.name') }}**:  
Nama: {{ $userData['name'] }}  
Username: {{ $userData['username'] }}  
telah dihapus.

Semua blog dan data lain terkait akunmu juga terhapus.
</x-mail::message>
