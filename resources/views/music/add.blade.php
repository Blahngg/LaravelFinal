<x-app>
    <x-slot:title>Add Music</x-slot:title>

    <form action="{{ route( 'music.store') }}" method="POST">
        @csrf
        <input type="file" name="cover_photo" id="">
        <input type="submit" value="add" name="add">
    </form>
</x-app>
