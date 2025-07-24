<x-mail::message>
## Blog "{{ $blog->title }}"

Selamat blogmu berhasil diterbitkan!

<a href="{{ route('blogs.show', $blog->slug) }}">Mari kita lihat~</a>
</x-mail::message>
